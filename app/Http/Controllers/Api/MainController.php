<?php

namespace App\Http\Controllers\Api;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddAqarRequest;
use App\Http\Requests\ChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Resources\AqarAdditionResource;
use App\Http\Resources\AqarCategoryResource;
use App\Http\Resources\AqarDetailsResource;
use App\Http\Resources\AqarKindResource;
use App\Http\Resources\AqarResource;
use App\Http\Resources\AqarStatisticsResource;
use App\Http\Resources\AqarTypeResource;
use App\Http\Resources\ChildrenResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\CompanyDetailsResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\FinishingTypeResource;
use App\Http\Resources\NormalResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectsResource;
use App\Http\Resources\RegionAqarDetailsResource;
use App\Http\Resources\RegionResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SpecialResource;
use App\Models\AdsType;
use App\Models\Aqar;
use App\Models\AqarAddition;
use App\Models\AqarCategory;
use App\Models\AqarKind;
use App\Models\AqarType;
use App\Models\City;
use App\Models\Comment;
use App\Models\CommentReport;
use App\Models\FinishingType;
use App\Models\Kid;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\my_helper\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class   MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('search');
    }

    public function addChild(ChildRequest $request)
    {
        $user = auth('api')->user();

        $child = $user->kids()->create($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $child, 'image', 'kids/images');
        }

        if ($request->hasFile('birth_certificate')) {
            $image = $request->file('birth_certificate');
            MyHelper::addPhoto($image, $child, 'birth_certificate', 'kids/birth_certificates');
        }

        return api_response(null, 'تم إضافة طفلك بنجاح');

    }

    public function myChildren()
    {
        $user = auth('api')->user();
        $myChildren = $user->kids()->get();

        return api_response(ChildrenResource::collection($myChildren), 'list of children', 1);
    }

    public function lostChild($id)
    {
        $user = auth('api')->user();
        $child = Kid::whereUserId($user->id)->find($id);
        if (!$child) {
            return api_response(null, 'incorrect id', 0);
        }
        $child->update([
            'is_lost' => 1,
        ]);
        return api_response(null, 'تم التبليغ عن الطفل بنجاح', 1);
    }

    public function findChild($id)
    {
        $user = auth('api')->user();
        $child = Kid::whereUserId($user->id)->find($id);
        if (!$child) {
            return api_response(null, 'incorrect id', 0);
        }
        $child->update([
            'is_lost' => 0,
        ]);
        return api_response(null, 'تم العثور على الطفل بنجاح', 1);
    }

    public function updateChild(UpdateChildRequest $request, $id)
    {
        $user = auth('api')->user();
        $child = Kid::whereUserId($user->id)->find($id);
        if (!$child) {
            return api_response(null, 'incorrect id of child', 0);
        }

        $child->update(Arr::except($request->validated(), ['image', 'birth_certificate']));

        if ($request->hasFile('image')) {
            $old_file = optional($child)->image;
            if (file_exists(public_path($old_file))) File::delete(public_path($old_file));
            $image = $request->file('image');
            MyHelper::updatePhoto($image, $child, 'image', 'kids/images');
        }

        if ($request->hasFile('birth_certificate')) {
            $old_file = optional($child)->birth_certificate;
            if (file_exists(public_path($old_file))) File::delete(public_path($old_file));
            $certificate = $request->file('birth_certificate');
            MyHelper::updatePhoto($certificate, $child, 'birth_certificate', 'kids/birth_certificates');
        }


        return api_response(new ChildrenResource($child), 'تم تعديل بيانات الطفل بنجاح', 1);
    }

    public function deleteChild($id)
    {
        $user = auth('api')->user();

        $child = Kid::whereUserId($user->id)->find($id);
        if (!$child) {
            return api_response(null, 'incorrect id of child', 0);
        }

        $child->delete();
        return api_response(null, 'تم حذف الطفل بنجاح', 1);
    }


    public function home()
    {
        $children = Kid::where('is_lost', 1)->latest()->get();

        return api_response(ChildrenResource::collection($children), 'list of children', 1);
    }

    public function childInfo($id)
    {
        $child = Kid::where('is_lost', 1)->find($id);
        if (!$child) {
            return api_response(null, 'incorrect id of child', 0);
        }
        return api_response(new ChildrenResource($child), 'Child info', 1);
    }

    public function search()
    {
//        $imagePath = public_path('uploads/kids/images/');
//        $files = File::allFiles($imagePath);
//        $images = [];
//        foreach ($files as $file) {
//            $images[] = asset('uploads/kids/images/' . '/' . $file->getFilename());
//        }
//        dd($images);
        $python_script = 'app/Helper/initialization.py';
        $folder_url =public_path('uploads/kids/images/');
        //dd($folder_url);
        $command = "python $python_script $folder_url";
        $output = shell_exec($command);
        $face_encodings = json_decode($output);
        dd($face_encodings);
//
//        $url = asset('/uploads/images');
//        $output = shell_exec("python $python_script $url");
//        dd($output);
//// parse the output of the Python script
//        $output = implode("\n", $result);
//        dd($output);
//        $variables = json_decode($output, true);
//         //dd($variables);
//
//       // access the variables returned by the Python script
//        $variable1 = $variables['variable1'];
//        $variable2 = $variables['variable2'];

    }
}

?>
