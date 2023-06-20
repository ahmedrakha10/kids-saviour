<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AqarAdditionResource;
use App\Http\Resources\AqarResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\NormalResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PrivacyResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SpecialResource;
use App\Models\Aqar;
use App\Models\AqarAddition;
use App\Models\AqarCategory;
use App\Models\City;
use App\Models\Page;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{

    public function contactUs(Request $request)
    {
        $contactUs = Setting::first();

        return api_response(new ContactUsResource($contactUs), 'contact us page');
    }


    public function paymentMethods()
    {
        return api_response(PaymentMethodResource::collection(PaymentMethod::all()));
    }

    public function privacy()
    {
        return api_response(new PrivacyResource(Page::find(1)));
    }

    public function aqarAdditions()
    {
        return api_response(AqarAdditionResource::collection(AqarAddition::all()));
    }

    public function aqarCategories(Request $request)
    {
        $aqarCategories = AqarCategory::where(function ($q) use ($request) {
            if ($request->has('aqar_type_id')) {
                $q->where('aqar_type_id', $request->aqar_type_id);
            }
        })->get();
        return response()->json($aqarCategories);
    }

    public function cities()
    {
        return api_response(CityResource::collection(City::with('regions')->get()));
    }

}

?>
