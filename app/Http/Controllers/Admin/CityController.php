<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_cities')->only(['index']);
        $this->middleware('permission:create_cities')->only(['create', 'store']);
        $this->middleware('permission:update_cities')->only(['edit', 'update']);
        $this->middleware('permission:delete_cities')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.cities.index');

    }// end of index

    public function data()
    {
        $cities = City::select();

        return DataTables::of($cities)
                         ->addColumn('record_select', 'admin.cities.data_table.record_select')
                         ->editColumn('name', function (City $city) {
                             return $city->name;
                         })
                        ->addColumn('add_region', function (City $city) {
                            return view('admin.cities.data_table.add_region', compact('city'));
                        })
                         ->editColumn('created_at', function (City $city) {
                          return $city->created_at ?  $city->created_at->format('Y-m-d') : '';
                        })
                         ->addColumn('actions', 'admin.cities.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.cities.create');

    }// end of create

    public function store(CityRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        City::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.cities.index');

    }// end of store

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));

    }// end of edit

    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.cities.index');

    }// end of update

    public function destroy(City $city)
    {
        if ($city->regions()->count()) {
            session()->flash('error', __('Can not delete'));
            return response(['text' => __('Can not delete'), 'status' => 0]);
        }
        $this->delete($city);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully'), 'status' => 1]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $city = City::FindOrFail($recordId);
            if ($city->regions()->count()) {
                session()->flash('error', __('Can not delete'));
                return response(['text' => __('Can not delete'), 'status' => 0]);
            }
            $this->delete($city);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(City $city)
    {
        $city->delete();

    }// end of delete

}//end of controller
