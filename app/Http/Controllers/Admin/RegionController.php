<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegionRequest;
use App\Models\Region;
use App\Models\City;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_regions')->only(['index']);
        $this->middleware('permission:create_regions')->only(['create', 'store']);
        $this->middleware('permission:update_regions')->only(['edit', 'update']);
        $this->middleware('permission:delete_regions')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index($id)
    {
        $city = City::findOrFail($id);
        return view('admin.regions.index', compact('city'));

    }// end of index

    public function data($id)
    {
        $city = City::find($id);
        $regions = Region::where('city_id', $city->id)->select();
        return DataTables::of($regions)
                         ->addColumn('record_select', 'admin.regions.data_table.record_select')
                         ->editColumn('name', function (Region $region) {
                             return $region->name;
                         })
                         ->editColumn('created_at', function (Region $region) {
                             return $region->created_at ? $region->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', function (Region $region) use ($city) {
                             return view('admin.regions.data_table.actions', compact('region', 'city'));
                         })
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create(City $city)
    {
        return view('admin.regions.create', compact('city'));

    }// end of create

    public function store($id, RegionRequest $request)
    {
        $city = $request->segment(3);
        $reg = Region::where('city_id', $city)->where('name', request('name'))->first();
        //dd($reg);

        if ($reg == null) {
            $requestData = $request->validated();
            $city = City::find($id);
            $city->regions()->create($requestData);

            session()->flash('success', __('Added successfully'));
            return redirect()->route('admin.cities.regions.index', $city->id);
        } else {
            session()->flash('error', __('The name is already existed'));
            return back();
        }
    }// end of store

    public function edit($id, $regionId)
    {
        $city = City::find($id);
        $region = $city->regions()->findOrFail($regionId);
        return view('admin.regions.edit', compact('region', 'city'));

    }// end of edit

    public function update(RegionRequest $request, $cityId, $regionId)
    {
        $city = City::find($cityId);
        $region = $city->regions()->findOrFail($regionId);
        $reg = Region::where('city_id', $city->id)->where('name', request('name'))->first();
        //dd($reg);
        if ($reg == null || $reg->id == $region->id) {
            $region->update($request->validated());
            session()->flash('success', __('Updated successfully'));
            return redirect()->back();
        } else {
            session()->flash('error', __('The name is already existed'));
            return back();
        }

    }// end of update

    public function destroy($id, $regionId)
    {

        $region = Region::find($regionId);
        $region->delete();
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $region = Region::FindOrFail($recordId);
            $this->delete($region);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Region $region)
    {
        $region->delete();

    }// end of delete

}//end of controller
