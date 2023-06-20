<?php

namespace App\Http\Controllers\Api;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AqarResource;
use App\Http\Resources\UserResource;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'signup', 'social_login', 'activate', 'forget_password',
            'resetPassword', 'verifyCode');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:150',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|max:50|unique:users,email',
            'password' => 'required|min:7|max:15',
            'address' => 'required|max:150|min:3',
        ]);
        $data = $validator->validated();
        $data['password'] = bcrypt($request->password);
        $data['status'] = 1;
        $user = User::create($data);
        $user->access_token = auth('api')->login($user);
        $message = __('you have successfully registered');
        return api_response(new UserResource($user), $message);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return api_response(null, $validator->errors()->first(), 0);
        }

        $user = auth('api')->attempt($request->only(['email', 'password'])) ||
            auth('api')->attempt(['phone' => $request->email, 'password' => $request->password]);
        if ($user) {
            $user = auth('api')->user();
            $user->access_token = auth('api')->login($user);
            return api_response(new UserResource($user));
        }
        return api_response(null, __('Invalid credentials'), 0);
    }

    public function social_login(Request $request)
    {
        $user = User::where([
            'social_id' => $request->social_id,
            'social_type' => $request->social_type,
        ])->first();
        $this->validate($request, [
            'social_id' => 'required',
            'social_type' => 'required|in:facebook,gmail',
        ]);

        if ($user) {
            $this->validate($request, [
                'email' => 'nullable|unique:users,email,' . $user->id,
            ]);
        }
        if (!$user) {
            $user = new User();
            $user->social_id = $request->social_id;
            $user->social_type = $request->social_type;
            $user->email = $request->email ?? '';
            $user->first_name = $request->name ?? '';
            $user->type = 'user';
            $user->status = 1;
            $user->save();
            $user->access_token = auth('api')->login($user);
            return api_response(new UserResource($user));
        }
        $user->update([
            'social_id' => request('social_id'),
            'social_type' => request('social_type'),
            'email' => request('email')
        ]);
        $user->access_token = auth('api')->login($user);
        return api_response(new UserResource($user));
    }


    public function activate(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'code' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user && $code = $user->code()->where('code', $request->code)->first()) {
            $user->active = 'yes';
            $user->save();
            $code->delete();
            $user->access_token = auth('api')->login($user);
            return api_response(new UserResource($user), __("Your account activated successfully"));
        }
        return api_response(null, __('Invalid code'), 0);
    }


    public function forget_password(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return api_response(null, __('This user not found'), 0);
        }

        $code = rand(1000, 9999);
        $user->update(['code' => $code]);
        try {
            Mail::to($user->email)
                ->bcc('mahmoudamgad005@gmail.com')
                ->send(new ResetPassword($user));
        } catch (\Exception $e) {
            return api_response(null, $e->getMessage());
        }
        return api_response(['Email' => $user->email, 'code' => $code], __("Reset password code sent to your phone"));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::where('code', $request->code)->where('code', '!=', null)->first();

        if ($user) {
            $update = $user->update(['password' => bcrypt($request->password), 'code' => null]);
            if ($update) {
                return api_response(null, __('Password changed successfully'));
            } else {
                return api_response(null, __('An error occurred, try again'));
            }
        } else {
            return api_response(null, __('Invalid reset code'));
        }
    }

    public function verifyCode(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required'
        ]);
        $user = User::where('code', $request->code)->where('code', '!=', null)->where('email', $request->email)->first();
        if ($user) {
            return api_response(['email' => $user->email, 'code' => $user->code], __('Please enter your new password'));
        }
        return api_response(null, __('Invalid reset code'));
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'current_password' => 'required'
        ]);


        $user = auth('api')->user();

        if ($user) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->password);
                if ($user->save()) {
                    return api_response(null, __('Password changed successfully'));
                } else {
                    return api_response(null, __('An error occurred, try again'));
                }
            } else {
                return api_response(null, __('Current password is not correct'));
            }
        } else {
            return api_response(null, __('An error occurred, try again'));
        }
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|unique:users,phone,' . $user->id,
            'name' => 'max:50',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);


        //update user data if not try to update phone
        $data = $request->except('image');
        $user->update($data);
        if ($request->hasFile('image')) {
            $old_file = optional($user)->image;
            if (file_exists(public_path($old_file))) File::delete(public_path($old_file));
            $image = $request->file('image');
            MyHelper::updatePhoto($image, $user, 'image', 'kids/personal_images');
        }


        $data = new UserResource($user);

        $user->access_token = auth('api')->login($user);
        return api_response($data, __('Profile has been updated successfully'));
    }

    public function showProfile()
    {
        $user = auth('api')->user();
        if(!$user){
            return api_response(null, __('This user not found'),0);
        }
        $user->access_token = auth('api')->login($user);
        $data['user'] = new UserResource($user);
        return api_response($data, 'success');
    }
}

?>
