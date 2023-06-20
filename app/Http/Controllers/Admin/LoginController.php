<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        if (Auth::Check()) {
            return redirect('admin');
        }
        return view('auth.login');
    }

    public function postLogin()
    {
        $inputs = Request()->all();

        $remember = FALSE;
        if (isset($inputs['remember'])) {
            $remember = TRUE;
        }
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password'], 'type' => ['admin','super_admin']], true)) {
            return redirect()->intended('admin/home');
        } else {
            throw ValidationException::withMessages([
                                                        'email' => __('auth.failed'),
                                                    ]);
            return back()->withInput()->withError(trans('admin.wrong_login'));
        }
    }

}//end of controller

