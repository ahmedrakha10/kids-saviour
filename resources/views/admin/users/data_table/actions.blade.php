@if (auth()->user()->hasPermission('read_users'))
    <a href="{{ route('admin.users.show', $id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>
        {{__('Show')}}</a>
@endif

@if (auth()->user()->hasPermission('delete_users'))
    <form action="{{ route('admin.users.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
