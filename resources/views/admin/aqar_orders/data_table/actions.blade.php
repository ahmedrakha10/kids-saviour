<span style="display: inline-flex">
    @if (auth()->user()->hasPermission('update_aqar_orders'))
        <a href="{{ route('admin.aqar-orders.edit', $id) }}" class="btn btn-warning btn-sm mb-4"><i
                class="fa fa-edit"></i>
        </a>
    @endif

    @if (auth()->user()->hasPermission('delete_aqar_orders'))
        <form action="{{ route('admin.aqar-orders.destroy',  $id) }}" class="my-1 my-xl-0" method="post"
              style=" display: inline-block; {{app()->getLocale() == 'ar' ? 'margin-right: 10px;' : 'margin-left:10px; ' }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
        </form>
    @endif
</span>
