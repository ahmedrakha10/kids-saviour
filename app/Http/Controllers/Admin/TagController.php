<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_tags')->only(['index']);
        $this->middleware('permission:create_tags')->only(['create', 'store']);
        $this->middleware('permission:update_tags')->only(['edit', 'update']);
        $this->middleware('permission:delete_tags')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.tags.index');

    }// end of index

    public function data()
    {
        $tags = Tag::select();
        return DataTables::of($tags)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.tags.data_table.record_select')
                         ->editColumn('name', function (Tag $tag) {
                             return $tag->name;
                         })
                         ->editColumn('created_at', function (Tag $tag) {
                             return $tag->created_at ?  $tag->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.tags.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.tags.create');

    }// end of create

    public function store(TagRequest $request)
    {
        $requestData = $request->validated();

        Tag::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.tags.index');

    }// end of store

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));

    }// end of edit

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.tags.index');

    }// end of update

    public function destroy(Tag $tag)
    {
        $this->delete($tag);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $tag = Tag::FindOrFail($recordId);
            $this->delete($tag);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Tag $tag)
    {
        $tag->delete();

    }// end of delete

}//end of controller
