<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Branch;
use App\Models\Company;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_branches')->only(['index']);
        $this->middleware('permission:create_branches')->only(['create', 'store']);
        $this->middleware('permission:update_branches')->only(['edit', 'update']);
        $this->middleware('permission:delete_branches')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.branches.index', compact('company'));

    }// end of index

    public function data($id)
    {
        $company = Company::find($id);
        $branches = Branch::where('company_id', $company->id)->select();
        return DataTables::of($branches)
                         ->addColumn('record_select', 'admin.branches.data_table.record_select')
                         ->addColumn('add_job_title', function (Branch $branch) use ($company){
                             return view('admin.branches.data_table.add_job_title', compact('company','branch'));
                         })
                         ->editColumn('created_at', function (Branch $branch) {
                             return $branch->created_at->format('Y-m-d');
                         })
                         ->addColumn('actions', function (Branch $branch) use ($company) {
                             return view('admin.branches.data_table.actions', compact('branch', 'company'));
                         })
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create(Company $company)
    {
        return view('admin.branches.create', compact('company'));

    }// end of create

    public function store($id, BranchRequest $request)
    {
        $requestData = $request->validated();
        $company = Company::find($id);
        $company->branches()->create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.companies.branches.index', $company->id);

    }// end of store

    public function edit($id, $branchId)
    {
        $company = Company::find($id);
        $branch = $company->branches()->findOrFail($branchId);
        return view('admin.branches.edit', compact('branch', 'company'));

    }// end of edit

    public function update(BranchRequest $request, $companyId, $branchId)
    {
        $company = Company::find($companyId);
        $branch = $company->branches()->findOrFail($branchId);

        $branch->update($request->validated());
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy($companyId, $id)
    {
        $company = Company::findOrFail($companyId);
        $branch = $company->branches()->findOrFail($id);
        $branch->delete();
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $branch = Branch::FindOrFail($recordId);
            $this->delete($branch);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Branch $branch)
    {
        $branch->delete();

    }// end of delete

}//end of controller
