<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['general']);

    }// end of __construct

    public function general()
    {
        return view('admin.settings.general');

    }// end of index

    public function store(Request $request)
    {
        $request->validate([
                               'email'         => 'sometimes|nullable|email',
                               'phone'         => 'required|numeric',
                               'facebook_url'  => 'sometimes|nullable|url',
                               'instagram_url' => 'sometimes|nullable|url',
                               'tiktok_url'    => 'sometimes|nullable|url',
                               'youtube_url'   => 'sometimes|nullable|url',
                           ]);

        $requestData = $request->except(['_token', '_method']);

        if ($request->logo) {
            Storage::disk('local')->delete('public/uploads/' . setting('logo'));
            $request->logo->store('public/uploads');
            $requestData['logo'] = $request->logo->hashName();
        }

        if ($request->fav_icon) {
            Storage::disk('local')->delete('public/uploads/' . setting('fav_icon'));
            $request->fav_icon->store('public/uploads');
            $requestData['fav_icon'] = $request->fav_icon->hashName();
        }

        setting($requestData)->save();

        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of store

}//end of controller


