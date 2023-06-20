@if (auth()->user()->hasPermission('delete_service_orders'))
    <form action="{{ route('admin.service-orders.destroy',  $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
    </form>
@endif
