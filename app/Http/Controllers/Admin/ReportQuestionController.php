<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Report;
use Yajra\DataTables\DataTables;

class ReportQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_report_questions')->only(['index']);
        $this->middleware('permission:create_report_questions')->only(['create', 'store']);
        $this->middleware('permission:update_report_questions')->only(['edit', 'update']);
        $this->middleware('permission:delete_report_questions')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.report_questions.index');

    }// end of index

    public function data()
    {
        $report = Report::latest();
        return DataTables::of($report)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.report_questions.data_table.record_select')
                         ->addColumn('user', function (Report $report) {
                             return view('admin.report_questions.data_table.user', compact('report'));
                         })
                         ->addColumn('answer', function (Report $report) {
                             return view('admin.report_questions.data_table.answer', compact('report'));
                         })
                         ->addColumn('question', function (Report $report) {
                             return view('admin.report_questions.data_table.question', compact('report'));
                         })
                         ->editColumn('created_at', function (Report $report) {
                             return $report->created_at ? $report->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.report_questions.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data


    public function destroy(Report $reportQuestion)
    {
        $this->delete($reportQuestion);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $report = Report::FindOrFail($recordId);
            $this->delete($report);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Report $reportQuestion)
    {
        $reportQuestion->delete();

    }// end of delete

}//end of controller
