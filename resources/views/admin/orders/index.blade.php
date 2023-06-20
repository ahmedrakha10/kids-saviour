@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Orders')}} ( {{__('Order your aqar')}} )</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('Orders')}} ( {{__('Order your aqar')}} )</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">


                        @if (auth()->user()->hasPermission('delete_orders'))
                            <form method="post" action="{{ route('admin.order-aqar.bulk_delete') }}"
                                  style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i>
                                    {{__('Bulk delete')}}</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus
                                   placeholder="{{__('Search')}}">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="orders-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Aqar kind')}}</th>
                                    <th>{{__('Aqar type')}}</th>
                                    <th>{{__('Region')}}</th>
                                    <th>{{__('Payment method')}}</th>
                                    <th>{{__('Price from')}}</th>
                                    <th>{{__('Price to')}}</th>
                                    <th>{{__('Width from')}}</th>
                                    <th>{{__('Width to')}}</th>
                                    <th>{{__('Rent type')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        let ordersTable = $('#orders-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            deferRender: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.order-aqar.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'DT_RowIndex', name: '', searchable: false, sortable: false},
                {data: 'user', name: 'user'},
                {data: 'aqar_kind', name: 'aqar_kind.name'},
                {data: 'aqar_type', name: 'aqar_type'},
                {data: 'region', name: 'region'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'price_from', name: 'price_from'},
                {data: 'price_to', name: 'price_to'},
                {data: 'width_from', name: 'width_from', width: '1%'},
                {data: 'width_to', name: 'width_to', width: '1%'},
                {data: 'rent_type', name: 'rent_type'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '1%'},
            ],
            order: [[11, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            ordersTable.search(this.value).draw();
        })
    </script>

@endpush
