<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AqarTipsRequest;
use App\Models\AqarTips;
use Yajra\DataTables\DataTables;

class AqarTipsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_aqar_tips')->only(['index']);
        $this->middleware('permission:create_aqar_tips')->only(['create', 'store']);
        $this->middleware('permission:update_aqar_tips')->only(['edit', 'update']);
        $this->middleware('permission:delete_aqar_tips')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.aqar_tips.index');

    }// end of index

    public function data()
    {
        $aqarTips = AqarTips::select();
        return DataTables::of($aqarTips)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.aqar_tips.data_table.record_select')
                         ->editColumn('name', function (AqarTips $aqarTip) {
                             return $aqarTip->name;
                         })
                         ->editColumn('created_at', function (AqarTips $aqarTip) {
                             return $aqarTip->created_at ?  $aqarTip->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.aqar_tips.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.aqar_tips.create');

    }// end of create

    public function store(AqarTipsRequest $request)
    {
        $requestData = $request->validated();

        AqarTips::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.aqar-tips.index');

    }// end of store

    public function edit(AqarTips $aqarTip)
    {
        return view('admin.aqar_tips.edit', compact('aqarTip'));

    }// end of edit

    public function update(AqarTipsRequest $request, AqarTips $aqarTip)
    {
        $aqarTip->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.aqar-tips.index');

    }// end of update

    public function destroy(AqarTips $aqarTip)
    {
        $this->delete($aqarTip);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $aqarTip = AqarTips::FindOrFail($recordId);
            $this->delete($aqarTip);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(AqarTips $aqarTip)
    {
        $aqarTip->delete();

    }// end of delete

}//end of controller
