<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AqarRequest;
use App\Models\AdsType;
use App\Models\Aqar;
use App\Models\AqarCategory;
use App\Models\AqarOrder;
use App\Models\AqarType;
use App\Models\FinishingType;
use App\Models\PaymentMethod;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class AqarOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_aqar_orders')->only(['index']);
        $this->middleware('permission:create_aqar_orders')->only(['create', 'store']);
        $this->middleware('permission:update_aqar_orders')->only(['edit', 'update']);
        $this->middleware('permission:delete_aqar_orders')->only(['delete', 'bulk_delete']);
        $this->middleware('permission:accept_aqar_orders')->only(['acceptOrder']);
        $this->middleware('permission:reject_aqar_orders')->only(['rejectOrder']);

    }// end of __construct

    public function index()
    {
        return view('admin.aqar_orders.index');

    }// end of index

    public function data()
    {
        $aqarOrder = Aqar::latest();
        return DataTables::of($aqarOrder)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.aqar_orders.data_table.record_select')
                         ->editColumn('name', function (Aqar $aqarOrder) {
                             return $aqarOrder->name;
                         })
                         ->editColumn('status', function (Aqar $aqarOrder) {
                             return view('admin.aqar_orders.data_table.status', compact('aqarOrder'));
                         })
                         ->addColumn('user', function (Aqar $aqarOrder) {
                             return view('admin.aqar_orders.data_table.user', compact('aqarOrder'));
                         })
                         ->editColumn('published_at', function (Aqar $aqarOrder) {
                             return $aqarOrder->published_at ? Carbon::parse($aqarOrder->published_at)->format('Y-m-d') : '---';
                         })
                         ->editColumn('ended_at', function (Aqar $aqarOrder) {
                             return $aqarOrder->published_at != null ? Carbon::parse($aqarOrder->ended_at)->format('Y-m-d') : '---';
                         })
                         ->addColumn('package', function (Aqar $aqarOrder) {
                             return view('admin.aqar_orders.data_table.package', compact('aqarOrder'));
                         })
                         ->addColumn('period', function (Aqar $aqarOrder) {
                             return view('admin.aqar_orders.data_table.period', compact('aqarOrder'));
                         })
                         ->addColumn('aqar_kind', function (Aqar $aqarOrder) {
                             return view('admin.aqar_orders.data_table.aqar_kind', compact('aqarOrder'));
                         })
//                         ->addColumn('aqar_type', function (Aqar $aqarOrder) {
//                             return view('admin.aqar_orders.data_table.aqar_type', compact('aqarOrder'));
//                         })
//                         ->addColumn('aqar_category', function (Aqar $aqarOrder) {
//                             return view('admin.aqar_orders.data_table.aqar_category', compact('aqarOrder'));
//                         })
//                         ->addColumn('image', function (Aqar $aqarOrder) {
//                             return view('admin.aqar_orders.data_table.image', compact('aqarOrder'));
//                         })
                         ->addColumn('operations', function (Aqar $aqarOrder) {
                return view('admin.aqar_orders.data_table.operations', compact('aqarOrder'));
            })
                         ->addColumn('actions', 'admin.aqar_orders.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function edit(Aqar $aqarOrder)
    {
        $adsTypes = AdsType::all();
        $finishingTypes = FinishingType::all();
        $aqarTypes = AqarType::all();
        $paymentMethods = PaymentMethod::all();
        $aqarCategories = AqarCategory::all();
        $regions = Region::all();
        return view('admin.aqar_orders.edit', compact('aqarOrder', 'adsTypes', 'finishingTypes', 'aqarTypes'
            , 'paymentMethods', 'aqarCategories', 'regions'));

    }// end of edit

    public function update(AqarRequest $request, Aqar $aqarOrder)
    {
        $aqarOrder->update(Arr::except($request->validated(), 'image'));

        //Upload slider images of aqar
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                MyHelper::addPhotos($image, $aqarOrder, 'aqars', 'images');
            }
        }
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(Aqar $aqarOrder)
    {

        $this->delete($aqarOrder);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $aqarOrder = Aqar::FindOrFail($recordId);
            $this->delete($aqarOrder);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Aqar $aqarOrder)
    {
        $aqarOrder->delete();

    }// end of delete

    public function acceptOrder($id)
    {
        $aqarOrder = Aqar::findOrFail($id);
        if ($aqarOrder) {
            $aqarOrder->update([
                                   'published_at' => Carbon::now()->format('Y-m-d'),
                                   'status'       => 'published',
                               ]);
        }
        session()->flash('success', __('Order has benn accepted successfully'));
        return redirect()->back();
    }

    public function rejectOrder($id)
    {
        $aqarOrder = Aqar::findOrFail($id);
        if ($aqarOrder) {
            $aqarOrder->update([
                                   'published_at' => null,
                                   'status'       => 'rejected',
                               ]);
        }
        session()->flash('success', __('Order has benn rejected successfully'));
        return redirect()->back();
    }

    public function changePackage(Request $request, $id)
    {
        $aqarOrder = Aqar::findOrFail($id);
        $aqarOrder->ads_type_id = $request->ads_type_id;
        $aqarOrder->save();
        $data['ads_type_id'] = $request->ads_type_id;
        $data['message'] = __('Updated successfully');
        return response()->json($data);
    }

    public function changePeriod(Request $request, $id)
    {
        $aqarOrder = Aqar::findOrFail($id);
        $aqarOrder->period = $request->period;
        $aqarOrder->save();
        if ($aqarOrder->published_at != null) {
            $aqarOrder->update([
                                   'aqar_ended_at' => Carbon::parse($aqarOrder->published_at)->addDays($request->period)
                               ]);
        }
        $data['period'] = $request->period;
        $data['message'] = __('Updated successfully');
        return response()->json($data);
    }


}//end of controller
