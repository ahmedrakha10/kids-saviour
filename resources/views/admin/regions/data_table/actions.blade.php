
@if (auth()->user()->hasPermission('update_regions'))
    <a href="{{ route('admin.cities.regions.edit', [$city,$region->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
@endif

@if (auth()->user()->hasPermission('delete_regions'))
    <form action="{{ route('admin.cities.regions.destroy', [request()->segment(3) , $region->id]) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
