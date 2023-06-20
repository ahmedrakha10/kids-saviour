<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\AqarTips;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_articles')->only(['index']);
        $this->middleware('permission:create_articles')->only(['create', 'store']);
        $this->middleware('permission:update_articles')->only(['edit', 'update']);
        $this->middleware('permission:delete_articles')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.articles.index');

    }// end of index

    public function data()
    {
        $articles = Article::latest();
        return DataTables::of($articles)
                         ->addIndexColumn()
                         ->addColumn('record_select', 'admin.articles.data_table.record_select')
                         ->editColumn('name', function (Article $article) {
                             return $article->name;
                         })
                         ->addColumn('category', function (Article $article) {
                             return view('admin.articles.data_table.category', compact('article'));
                         })
                         ->addColumn('image', function (Article $article) {
                             return view('admin.articles.data_table.image', compact('article'));
                         })
                         ->editColumn('created_at', function (Article $article) {
                             return $article->created_at ? $article->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.articles.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {

        $aqarTips = AqarTips::all();
        $tags = [];
        $values = Tag::get(['name', 'id']);
        foreach ($values as $item)
            $tags[$item->id] = $item->getOriginal('name')[app()->getLocale()];
        return view('admin.articles.create', compact('aqarTips', 'tags'));

    }// end of create

    public function store(ArticleRequest $request)
    {
        $requestData = $request->validated();

        $article = Article::create($requestData);

        if ($request->has('tags_list')) {
            $article->tags()->attach($request->tags_list);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            MyHelper::addPhoto($image, $article, 'image', 'articles');
        }
        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.articles.index');

    }// end of store

    public function edit(Article $article)
    {
        $aqarTips = AqarTips::all();
        $tags = [];
        $values = Tag::get(['name', 'id']);
        foreach ($values as $item)
            $tags[$item->id] = $item->getOriginal('name')[app()->getLocale()];
        return view('admin.articles.edit', compact('article', 'aqarTips','tags'));

    }// end of edit

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update(Arr::except($request->validated(), ['image','tags_list']));

        if ($request->has('tags_list')) {
            $article->tags()->sync($request->tags_list);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldFile = optional($article)->image;

            if (file_exists(public_path($oldFile))) {
                File::Delete(public_path($oldFile));
            }
            MyHelper::updatePhoto($image, $article, 'articles');
        }
        session()->flash('success', __('Updated successfully'));
        return redirect()->back();

    }// end of update

    public function destroy(Article $article)
    {
        $this->delete($article);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $article = Article::FindOrFail($recordId);
            $this->delete($article);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(Article $article)
    {
        // Delete  image  from server

        $photo = $article->image;
        if (file_exists(public_path($photo))) {
            File::Delete(public_path($photo));
        }

        $article->delete();

    }// end of delete

}//end of controller
