<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_payment_methods')->only(['index']);
        $this->middleware('permission:create_payment_methods')->only(['create', 'store']);
        $this->middleware('permission:update_payment_methods')->only(['edit', 'update']);
        $this->middleware('permission:delete_payment_methods')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.payment_methods.index');

    }// end of index

    public function data()
    {
        $paymentMethod = PaymentMethod::select();
        return DataTables::of($paymentMethod)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.payment_methods.data_table.record_select')
                         ->editColumn('name', function (PaymentMethod $paymentMethod) {
                             return $paymentMethod->name;
                         })
                         ->editColumn('created_at', function (PaymentMethod $paymentMethod) {
                             return $paymentMethod->created_at ?  $paymentMethod->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.payment_methods.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.payment_methods.create');

    }// end of create

    public function store(PaymentMethodRequest $request)
    {
        $requestData = $request->validated();

        PaymentMethod::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.payment-methods.index');

    }// end of store

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment_methods.edit', compact('paymentMethod'));

    }// end of edit

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(PaymentMethod $paymentMethod)
    {
        $this->delete($paymentMethod);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $paymentMethod = PaymentMethod::FindOrFail($recordId);
            $this->delete($paymentMethod);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

    }// end of delete

}//end of controller
