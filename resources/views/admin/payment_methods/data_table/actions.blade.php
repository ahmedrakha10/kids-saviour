@if (auth()->user()->hasPermission('update_payment_methods'))
    <a href="{{ route('admin.payment-methods.edit', $id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
        {{__('Edit')}}</a>
@endif
