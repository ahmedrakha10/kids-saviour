<?php


namespace App\Helper;


use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class MyHelper
{

    static function notifyByFirebase($title, $body, $tokens, $data = [])        // paramete 5 =>>>> $type
    {

        $registrationIDs = $tokens;

        $fcmMsg = array(
            'body'  => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority'         => 'high',
            'notification'     => $fcmMsg,
            'data'             => $data
        );
        $headers = array(
            'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    ///
    //////////////////////////////////////////////////////////////////////

    static function generateCode($model)
    {
        if ($model == 'customer') {
            $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

            $customer = Customer::where('referal_code', $code)->first();

            if ($customer) {
                self::generateCode($model);
            } else {
                return $code;
            }
        }
    }

    //////////////////////////////////////////////////////////////////////
    ///
    //////////////////////////////////////////////////////////////////////

    static function generateToken($user)
    {
        $email = str_split($user->email, 3);
        $phone = str_split($user->phone, 1);
        $token = Str::random(5);

        foreach ($email as $value) {
            $token .= $value . Str::random(20);
        }

        $token .= '.' . Str::random(5);

        foreach ($phone as $value) {
            $token .= $value . Str::random(4);
        }

        $token .= '.' . Str::random(20);

        return $token;


    }

    //////////////////////////////////////////////////////////////////////
    ///
    static function generateCouponCode()
    {
        $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

        $record = Cobon::where('code', $code)->first();

        if ($record) {
            self::generateCobonCode();
        } else {
            return $code;
        }
    }

    static function generateInvoiceCode()
    {
        $code = rand('1000', '9999') . rand('1000', '9999') . rand('1000', '9999');

        $record = Invoice::where('code', $code)->first();

        if ($record) {
            self::generateCobonCode();
        } else {
            return $code;
        }
    }

    static function ResetPassword($model, $password)
    {
        $model->password = Hash::make($password);
        $model->save();
        return true;
    }


    static function removeToken($token)
    {
        Token::where('token', $token)->delete();
        return true;
    }

    static function addIdCard($photo, $folder, $model)
    {

        $path = \Storage::disk('public_uploads')->put($folder, $photo);

        $model->id_card = $path;
        $model->save();
    }


    static function is_read($model)
    {
        if ($model->is_read == 0) {
            $model->is_read = 1;
            $model->save();
            return true;
        } else {
            return false;
        }
    }


    static function convertDateTime($dateTime)
    {
        $date = Carbon::parse($dateTime)->format('Y-m-d 00:00:00');

        return $date;
    }


    static function coupon_activation($model, $name = 'is_active')
    {
        if ($model->$name == 1) {
            $model->$name = 0;
            $model->save();

        } else {
            return false;
        }

        return true;
    }

    static function activation($model, $name = 'is_active')
    {
        if ($model->$name == 1) {
            $model->$name = 0;
            $model->save();

        } else {
            $model->$name = 1;
            $model->save();
        }

        return true;
    }


    static function offer($model)
    {
        if ($model->is_offered == 1) {
            $model->is_offered = 0;
            $model->save();

        } else {
            $model->is_offered = 1;
            $model->save();
        }

        return true;
    }


    static function activationView($model, $url, $on_red = 'الغاء التفعيل', $on_blue = 'تفعيل')
    {
        $onclick = 'onclick="myFunction(' . $model->id . ')"';
        if ($model->is_active == 1 && $on_blue != 'قبول') {
            return '<a class="btn btn-danger" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                         ' . $on_red . '
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                        ' . $on_blue . '
                    </a>';
        }
    }

    static function isOffer($model, $url)
    {
        if ($model->is_offered == 1) {
            return '<a class="btn btn-danger" href="' . $url . '" >
                         الغاء التفعيل
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '">
                        تفعيل
                    </a>';
        }
    }


    static function addPhoto($file, $model, $column, $folder_name)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $model->$column = 'uploads/' . $folder_name . '/' . $name;
        $model->save();
    }

    static function addPhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->$relation()->create(['url'  => 'uploads/' . $folder_name . '/' . $name,
                                     'type' => 'slider']);
    }


    static function updatePhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $model->$relation()->create(['url'  => 'uploads/' . $folder_name . '/' . $name,
                                     'type' => 'slider']);

        //File::delete(public_path() . '/uploads/' . $folder_name . '/' . $name);
    }

    static function updateScreenPhotos($file, $model, $folder_name, $relation)
    {
        $image = $file;
        $destinationPath = public_path() . '/uploads/thumbnails/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = 'original' . time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given


        $image_400 = '400-' . time() . '' . rand(11111, 99999) . '.' . $extension;

        $resize_image = Image::make($destinationPath . $name);

        $resize_image->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . $image_400, 100);

        $model->$relation()->create(['video_screen' => 'uploads/thumbnails/' . $folder_name . '/' . $image_400,

                                     'type' => 'video_screen']);

        File::delete(public_path() . '/uploads/thumbnails/' . $folder_name . '/' . $name);
    }


    static function addVideos($file, $model, $folder_name, $relation)
    {
        $video = $file;
        $destinationPath = public_path() . '/uploads/videos/' . $folder_name . '/';
        $extension = $video->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $video->move($destinationPath, $name); // uploading file to given
        $model->$relation()->create(['video_url' => 'uploads/videos/' . $folder_name . '/' . $name,
                                     'type'      => 'video']);
    }

    static function updateVideos($file, $model, $folder_name, $relation)
    {
        $video = $file;
        $destinationPath = public_path() . '/uploads/videos/' . $folder_name . '/';
        $extension = $video->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $video->move($destinationPath, $name); // uploading file to given
        $model->$relation()->create(['video_url' => 'uploads/videos/' . $folder_name . '/' . $name,
                                     'type'      => 'video']);
    }

    static function updatePhoto($file, $model,$column ,$folder_name)
    {

        $image = $file;
        $destinationPath = public_path() . '/uploads/' . $folder_name . '/';
        $extension = $image->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
        $image->move($destinationPath, $name); // uploading file to given

        $model->update([$column => 'uploads/' . $folder_name . '/' . $name]);

    }


    static function deletePhoto($model, $relation = null)
    {
        $photo = $model->photo;

        File::delete(public_path() . '/' . $photo->name);


        if ($relation == 'photos') {
            $model->photos()->delete();
        } else {

            $model->photo()->delete();
        }

    }

    static function deletePhotoV2($model, $relation)
    {
        $image = $model->$relation;

        File::delete(public_path() . '/' . optional($image)->photo);

        $model->$relation()->delete();

    }

    static function deletePhotos($model, $relation)
    {
        $image = $model->$relation;
        foreach ($image as $photo) {
            File::delete(public_path() . '/' . optional($photo)->photo_url);
        }

        $model->$relation()->delete();

    }

    static function deleteVideos($model, $relation)
    {
        $videos = $model->$relation;
        foreach ($videos as $video) {
            File::delete(public_path() . '/' . optional($video)->video_url);
        }

        $model->$relation()->delete();

    }


    static function select($name, $options = [], $selected = null, $attributes = [], $disabled = [])
    {
        $html = '<select name="' . $name . '"';
        foreach ($attributes as $attribute => $value) {
            $html .= ' ' . $attribute . '="' . $value . '"';
        }
        $html .= '>';

        foreach ($options as $value => $text) {
            $html .= '<option value="' . $value . '"' .
                     ($value == $selected ? ' selected="selected"' : '') .
                     (in_array($value, $disabled) ? ' disabled="disabled"' : '') . '>' .
                     $text . '</option>';
        }

        $html .= '</select>';

        return $html;
    }

    static function status($val)
    {

        if ($val >= 85) {
            return [
                'average' => $val,
                'key'     => __('high'),
            ];
        } elseif ($val > 85 && $val < 60) {
            return [
                'average' => $val,
                'key'     => __('average'),
            ];
        } else {
            return [
                'average' => $val,
                'key'     => __('low'),
            ];
        }
    }


}
