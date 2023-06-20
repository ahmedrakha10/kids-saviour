<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentReport;
use Yajra\DataTables\DataTables;

class ReportCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_report_comments')->only(['index']);
        $this->middleware('permission:create_report_comments')->only(['create', 'store']);
        $this->middleware('permission:update_report_comments')->only(['edit', 'update']);
        $this->middleware('permission:delete_report_comments')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.report_comments.index');

    }// end of index

    public function data()
    {
        $report = CommentReport::latest();
        return DataTables::of($report)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.report_comments.data_table.record_select')
                         ->addColumn('user', function (CommentReport $report) {
                             return view('admin.report_comments.data_table.user', compact('report'));
                         })
                         ->addColumn('comment', function (CommentReport $report) {
                             return view('admin.report_comments.data_table.comment', compact('report'));
                         })
                         ->addColumn('aqar', function (CommentReport $report) {
                             return view('admin.report_comments.data_table.aqar', compact('report'));
                         })
                         ->editColumn('created_at', function (CommentReport $report) {
                             return $report->created_at ? $report->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.report_comments.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data


    public function destroy(CommentReport $commentReport)
    {
        $this->delete($commentReport);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $report = CommentReport::FindOrFail($recordId);
            $this->delete($report);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(CommentReport $commentReport)
    {
        $commentReport->delete();

    }// end of delete

}//end of controller
