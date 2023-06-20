<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;


class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_services')->only(['index']);
        $this->middleware('permission:create_services')->only(['create', 'store']);
        $this->middleware('permission:update_services')->only(['edit', 'update']);
        $this->middleware('permission:delete_services')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.services.index');
    }// end of index

    public function data()
    {
        $services = Service::latest();

        return DataTables::of($services)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.services.data_table.record_select')
                         ->editColumn('name', function (Service $service) {
                             return $service->name;
                         })
                         ->addColumn('image', function (Service $service) {
                             return view('admin.services.data_table.image', compact('service'));
                         })
                         ->editColumn('created_at', function (Service $service) {
                             return $service->created_at ? $service->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.services.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.services.create');
    }// end of create

    public function store(ServiceRequest $request)
    {
        $requestData = $request->validated();
        $service = Service::create($requestData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $service, 'services');
        }
        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.services.index');

    }// end of store~

    public function edit(Service $service)
    {

        return view('admin.services.edit', compact('service'));

    }// end of edit

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldFile = optional($service)->image;

            if (file_exists($oldFile)) {
                File::Delete(public_path($oldFile));
            }
            MyHelper::updatePhoto($image, $service, 'services');
        }


        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.services.index');

    }// end of update

    public function destroy(Service $service)
    {
        $this->delete($service);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $service = Service::FindOrFail($recordId);
            $this->delete($service);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Service $service)
    {
        // Delete  image  from server

        $photo = $service->image;
        if (file_exists(public_path($photo))) {
            File::Delete(public_path($photo));
        }

        $service->delete();

    }// end of delete


}//end of controller
