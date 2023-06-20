
@if (auth()->user()->hasPermission('update_jobTitles'))
    <a href="{{ route('admin.companies.branches.job-titles.edit', [$company,$branch->id,$jobTitle->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
@endif

@if (auth()->user()->hasPermission('delete_jobTitles'))
    <form action="{{ route('admin.companies.branches.job-titles.destroy', [request()->segment(3) , $branch->id,$jobTitle->id]) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
