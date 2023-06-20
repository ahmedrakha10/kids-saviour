@if (auth()->user()->hasPermission('update_articles'))
    <a href="{{ route('admin.articles.edit', $id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
        {{__('Edit')}}</a>
@endif

@if (auth()->user()->hasPermission('delete_articles'))
    <form action="{{ route('admin.articles.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
