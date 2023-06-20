
@if (auth()->user()->hasPermission('update_branches'))
    <a href="{{ route('admin.companies.branches.edit', [$company,$branch->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
@endif

@if (auth()->user()->hasPermission('delete_branches'))
    <form action="{{ route('admin.companies.branches.destroy', [request()->segment(3) , $branch->id]) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
