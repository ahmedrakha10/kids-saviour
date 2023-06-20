<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Models\Package;
use Yajra\DataTables\DataTables;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_packages')->only(['index']);
        $this->middleware('permission:create_packages')->only(['create', 'store']);
        $this->middleware('permission:update_packages')->only(['edit', 'update']);
        $this->middleware('permission:delete_packages')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.packages.index');

    }// end of index

    public function data()
    {
        $packages = Package::latest();

        return DataTables::of($packages)
                         ->addColumn('record_select', 'admin.packages.data_table.record_select')
                         ->editColumn('name', function (Package $package) {
                             return $package->name;
                         })
                         ->editColumn('type', function (Package $package) {
                             return __($package->type);
                         })
                         ->editColumn('price', function (Package $package) {
                             return $package->price == 0 ? __('Free') : $package->price;
                         })
                         ->editColumn('period', function (Package $package) {
                             return $package->period;
                         })
                         ->editColumn('views_number', function (Package $package) {
                             return $package->views_number;
                         })
                         ->editColumn('created_at', function (Package $package) {
                             return $package->created_at ? $package->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.packages.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.packages.create');

    }// end of create

    public function store(PackageRequest $request)
    {
        $requestData = $request->validated();
        Package::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.packages.index');

    }// end of store

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));

    }// end of edit

    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.packages.index');

    }// end of update

    public function destroy(Package $package)
    {
        $this->delete($package);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully'), 'status' => 1]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $package = Package::FindOrFail($recordId);
            $this->delete($package);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Package $package)
    {
        $package->delete();

    }// end of delete

}//end of controller
