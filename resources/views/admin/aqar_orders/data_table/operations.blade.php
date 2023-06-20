<span style="display: inline-flex">
@if($aqarOrder->status == 'published')
        <h5><span class="badge badge-success">{{__('published')}}</span></h5>

    @elseif($aqarOrder->status == 'rejected')
        <h5><span class="badge badge-danger text-lg-center">{{__('Rejected')}}</span></h5>
    @else

        @if (auth()->user()->hasPermission('accept_aqar_orders'))
            <form class="mb-4" action="{{ route('admin.aqar-orders.accept', $aqarOrder->id) }}" method="post"
                  style=" display: inline-block; {{app()->getLocale() == 'ar' ? 'margin-right: 10px;' : 'margin-left:10px; ' }}">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-success btn-sm mb-4"><i class="fa fa-check"></i>
                </button>
            </form>
        @endif

        @if (auth()->user()->hasPermission('reject_aqar_orders'))
            <form action="{{ route('admin.aqar-orders.reject', $aqarOrder->id) }}" method="post"
                  style=" display: inline-block; {{app()->getLocale() == 'ar' ? 'margin-right: 10px;' : 'margin-left:10px; ' }}">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                </button>
            </form>
        @endif

    @endif
</span>
