<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AqarFeatureRequest;
use App\Models\AqarAddition;
use App\Models\AqarFeature;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;


class AqarFeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_aqar_features')->only(['index']);
        $this->middleware('permission:create_aqar_features')->only(['create', 'store']);
        $this->middleware('permission:update_aqar_features')->only(['edit', 'update']);
        $this->middleware('permission:delete_aqar_features')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.aqar_features.index');
    }// end of index

    public function data()
    {
        $aqar_features = AqarAddition::latest();

        return DataTables::of($aqar_features)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.aqar_features.data_table.record_select')
                         ->editColumn('name', function (AqarAddition $aqarFeature) {
                             return $aqarFeature->name;
                         })
                         ->addColumn('image', function (AqarAddition $aqarFeature) {
                             return view('admin.aqar_features.data_table.image', compact('aqarFeature'));
                         })
                         ->editColumn('created_at', function (AqarAddition $aqarFeature) {
                             return $aqarFeature->created_at ? $aqarFeature->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.aqar_features.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.aqar_features.create');
    }// end of create

    public function store(AqarFeatureRequest $request)
    {
        $requestData = $request->validated();
        $aqarFeature = AqarAddition::create($requestData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $aqarFeature, 'aqar_features');
        }
        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.aqar-features.index');

    }// end of store~

    public function edit(AqarAddition $aqarFeature)
    {

        return view('admin.aqar_features.edit', compact('aqarFeature'));

    }// end of edit

    public function update(AqarFeatureRequest $request, AqarAddition $aqarFeature)
    {
        $aqarFeature->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldFile = optional($aqarFeature)->image;

            if (file_exists(public_path($oldFile))) {
                File::Delete(public_path($oldFile));
            }
            MyHelper::updatePhoto($image, $aqarFeature, 'aqar_features');
        }


        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.aqar-features.index');

    }// end of update

    public function destroy(AqarAddition $aqarFeature)
    {
        $this->delete($aqarFeature);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $aqarFeature = AqarFeature::FindOrFail($recordId);
            $this->delete($aqarFeature);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(AqarAddition $aqarFeature)
    {
        // Delete  image  from server

        $photo = $aqarFeature->image;
        if (file_exists(public_path($photo))) {
            File::Delete(public_path($photo));
        }

        $aqarFeature->delete();

    }// end of delete


}//end of controller
