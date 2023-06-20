<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AqarOrder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_orders')->only(['index']);
        $this->middleware('permission:create_orders')->only(['create', 'store']);
        $this->middleware('permission:update_orders')->only(['edit', 'update']);
        $this->middleware('permission:delete_orders')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.orders.index');

    }// end of index

    public function data()
    {
        $orders = AqarOrder::with('aqar_kind', 'aqar_type', 'user', 'region')->latest();
        //$concat = "CONCAT(users.first_name, ' ', users.last_name)";
        return DataTables::of($orders)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.service_orders.data_table.record_select')
                         ->addColumn('user', function (AqarOrder $order) {
                             return view('admin.orders.data_table.user', compact('order'));
                         })
                         ->filterColumn('user', function ($query, $keyword) {
                             $sql = "CONCAT(users.first_name,' ',users.last_name)  like ?";
                             $query->whereHas('user', function ($q) use ($sql, $keyword) {
                                 $q->whereRaw($sql, ["%{$keyword}%"]);
                             });
                         })
                         ->addColumn('aqar_kind', function (AqarOrder $order) {
                             return view('admin.orders.data_table.aqar_kind', compact('order'));
                         })
                         ->addColumn('aqar_type', function (AqarOrder $order) {
                             return view('admin.orders.data_table.aqar_type', compact('order'));
                         })
                         ->filterColumn('aqar_type', function ($query, $keyword) {
                             $query->whereHas('aqar_type', function ($q) use ($keyword) {
                                 $q->where('name->ar', 'LIKE', ["%{$keyword}%"])
                                   ->orWhere('name->en', 'LIKE', ["%{$keyword}%"]);
                             });
                         })
                         ->addColumn('region', function (AqarOrder $order) {
                             return view('admin.orders.data_table.region', compact('order'));
                         })
                         ->filterColumn('region', function ($query, $keyword) {
                             $query->whereHas('region', function ($q) use ($keyword) {
                                 $q->where('name->ar', 'LIKE', ["%{$keyword}%"])
                                   ->orWhere('name->en', 'LIKE', ["%{$keyword}%"]);
                             });
                         })
                         ->addColumn('payment_method', function (AqarOrder $order) {
                             return view('admin.orders.data_table.payment_method', compact('order'));
                         })
                         ->addColumn('rent_type', function (AqarOrder $order) {
                             return view('admin.orders.data_table.rent_type', compact('order'));
                         })
                         ->editColumn('created_at', function (AqarOrder $order) {
                             return $order->created_at ? $order->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.orders.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function destroy(AqarOrder $orderAqar)
    {

        $this->delete($orderAqar);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $orderAqar = AqarOrder::FindOrFail($recordId);
            $this->delete($orderAqar);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(AqarOrder $orderAqar)
    {
        $orderAqar->delete();

    }// end of delete

}//end of controller
