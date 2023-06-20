<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderService;
use Yajra\DataTables\DataTables;

class ServiceOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_service_orders')->only(['index']);
        $this->middleware('permission:create_service_orders')->only(['create', 'store']);
        $this->middleware('permission:update_service_orders')->only(['edit', 'update']);
        $this->middleware('permission:delete_service_orders')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.service_orders.index');

    }// end of index

    public function data()
    {
        $orderServices = OrderService::latest();
        return DataTables::of($orderServices)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.service_orders.data_table.record_select')
                         ->addColumn('service', function (OrderService $orderService) {
                             return view('admin.service_orders.data_table.service', compact('orderService'));
                         })
                         ->editColumn('created_at', function (OrderService $orderService) {
                             return $orderService->created_at ? $orderService->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.service_orders.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function destroy(OrderService $serviceOrder)
    {

        $this->delete($serviceOrder);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $orderService = OrderService::FindOrFail($recordId);
            $this->delete($orderService);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(OrderService $serviceOrder)
    {
        $serviceOrder->delete();

    }// end of delete

}//end of controller
