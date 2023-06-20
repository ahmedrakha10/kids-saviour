<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Http\Requests\Admin\JobTitleRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\JobTitle;
use Yajra\DataTables\DataTables;

class JobTitleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_jobTitles')->only(['index']);
        $this->middleware('permission:create_jobTitles')->only(['create', 'store']);
        $this->middleware('permission:update_jobTitles')->only(['edit', 'update']);
        $this->middleware('permission:delete_jobTitles')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index($id, $branch_id)
    {
        $company = Company::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('admin.job_titles.index', compact('company', 'branch'));

    }// end of index

    public function data($id, $branch_id)
    {
        $company = Company::find($id);
        $branch = Branch::find($branch_id);
        $jobTitles = $branch->jobTitles()->select();
        return DataTables::of($jobTitles)
                         ->addColumn('record_select', 'admin.job_titles.data_table.record_select')
                         ->editColumn('created_at', function (JobTitle $jobTitles) {
                             return $jobTitles->created_at->format('Y-m-d');
                         })
                         ->addColumn('actions', function (JobTitle $jobTitle) use ($branch, $company) {
                             return view('admin.job_titles.data_table.actions', compact('jobTitle', 'company', 'branch'));
                         })
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create(Company $company, Branch $branch)
    {
        return view('admin.job_titles.create', compact('company', 'branch'));

    }// end of create

    public function store($id, $branch_id, JobTitleRequest $request)
    {
        $requestData = $request->validated();
        $company = Company::find($id);
        $branch = Branch::find($branch_id);
        $branch->jobTitles()->create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.companies.branches.job-titles.index', [$company->id, $branch->id]);

    }// end of store

    public function edit(Company $company, $branchId,$id)
    {
        $branch = Branch::find($branchId);
        $jobTitle = $branch->jobTitles()->findOrFail($id);
        return view('admin.job_titles.edit', compact('branch', 'company','jobTitle'));

    }// end of edit

    public function update(JobTitleRequest $request, Company $company, $branchId,$id)
    {
        $branch = Branch::find($branchId);
        $jobTitle = $branch->jobTitles()->findOrFail($id);

        $jobTitle->update($request->validated());
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(Company $company, $branchId,$id)
    {
        $branch = Branch::findOrFail($branchId);
        $jobTitle = $branch->jobTitles()->findOrFail($id);
        $jobTitle->delete();
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $jobTitle = JobTitle::FindOrFail($recordId);
            $this->delete($jobTitle);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(JobTitle $jobTitle)
    {
        $jobTitle->delete();

    }// end of delete

}//end of controller
