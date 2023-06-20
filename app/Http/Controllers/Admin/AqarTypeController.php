<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AqarTypeRequest;
use App\Models\AqarType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class AqarTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_aqar_types')->only(['index']);
        $this->middleware('permission:create_aqar_types')->only(['create', 'store']);
        $this->middleware('permission:update_aqar_types')->only(['edit', 'update']);
        $this->middleware('permission:delete_aqar_types')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.aqar_types.index');

    }// end of index

    public function data()
    {
        $aqar_types = AqarType::select();
        return DataTables::of($aqar_types)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.aqar_types.data_table.record_select')
                         ->editColumn('name', function (AqarType $aqarType) {
                             return $aqarType->name;
                         })
                         ->addColumn('image', function (AqarType $aqarType) {
                             return view('admin.aqar_types.data_table.image', compact('aqarType'));
                         })
                         ->editColumn('created_at', function (AqarType $aqarType) {
                             return $aqarType->created_at ? $aqarType->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.aqar_types.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.aqar_types.create');

    }// end of create

    public function store(AqarTypeRequest $request)
    {
        $requestData = $request->validated();

        $aqarType = AqarType::create($requestData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $aqarType, 'aqar_types');
        }
        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.aqar-types.index');

    }// end of store

    public function edit(AqarType $aqarType)
    {
        return view('admin.aqar_types.edit', compact('aqarType'));

    }// end of edit

    public function update(AqarTypeRequest $request, AqarType $aqarType)
    {
        $aqarType->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldFile = optional($aqarType)->image;

            if (file_exists($oldFile)) {
                File::Delete(public_path($oldFile));
            }
            MyHelper::updatePhoto($image, $aqarType, 'aqar_types');
        }
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(AqarType $aqarType)
    {
        $this->delete($aqarType);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $aqarType = AqarType::FindOrFail($recordId);
            $this->delete($aqarType);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(AqarType $aqarType)
    {
        // Delete  image  from server

        $photo = $aqarType->image;
        if (file_exists(public_path($photo))) {
            File::Delete(public_path($photo));
        }

        $aqarType->delete();

    }// end of delete

}//end of controller
