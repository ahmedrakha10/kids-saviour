<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\AqarTips;
use App\Models\Slider;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_sliders')->only(['index']);
        $this->middleware('permission:create_sliders')->only(['create', 'store']);
        $this->middleware('permission:update_sliders')->only(['edit', 'update']);
        $this->middleware('permission:delete_sliders')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.sliders.index');

    }// end of index

    public function data()
    {
        $sliders = Slider::latest();
        return DataTables::of($sliders)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.sliders.data_table.record_select')
                         ->addColumn('image', function (Slider $slider) {
                             return view('admin.sliders.data_table.image', compact('slider'));
                         })
                         ->addColumn('type', function (Slider $slider) {
                             return view('admin.sliders.data_table.type', compact('slider'));
                         })
                         ->editColumn('created_at', function (Slider $slider) {
                             return $slider->created_at ? $slider->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.sliders.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.sliders.create');
    }// end of create

    public function store(SliderRequest $request)
    {
        $requestData = $request->validated();

        $silder = Slider::create($requestData);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $silder, 'image', 'sliders');
        }
        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.sliders.index');

    }// end of store

    public function edit(Slider $slider)
    {

        return view('admin.sliders.edit', compact('slider'));

    }// end of edit

    public function update(SliderRequest $request, Slider $slider)
    {
        $slider->update(Arr::except($request->validated(), 'image'));


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldFile = optional($slider)->image;

            if (file_exists(public_path($oldFile))) {
                File::Delete(public_path($oldFile));
            }
            MyHelper::updatePhoto($image, $slider, 'sliders');
        }
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(Slider $slider)
    {
        $this->delete($slider);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $slider = Slider::FindOrFail($recordId);
            $this->delete($slider);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Slider $slider)
    {
        // Delete  image  from server

        $photo = $slider->image;
        if (file_exists(public_path($photo))) {
            File::Delete(public_path($photo));
        }

        $slider->delete();

    }// end of delete

}//end of controller
