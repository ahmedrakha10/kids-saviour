@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Aqar orders')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('Aqar orders')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">


                        @if (auth()->user()->hasPermission('delete_aqar_orders'))
                            <form method="post" action="{{ route('admin.aqar-orders.bulk_delete') }}"
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

                            <table class="table datatable" id="aqarOrders-table" style="width: 100%;">
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
{{--                                    <th>#</th>--}}
                                    <th>{{__('Aqar title')}}</th>
                                    <th>{{__('Code')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Aqar status')}}</th>
                                    <th>{{__('Package')}}</th>
                                    <th>{{__('Period')}}</th>
                                    <th>{{__('Published date')}}</th>
                                    <th>{{__('Ended date')}}</th>
                                    {{--                                    <th>{{__('Aqar type')}}</th>--}}
                                    {{--                                    <th>{{__('Aqar category')}}</th>--}}
                                    {{--                                    <th>{{__('Image')}}</th>--}}
                                    <th>{{__('Accept or Reject ?')}}</th>
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

        let aqarOrdersTable = $('#aqarOrders-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.aqar-orders.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                // {data: 'DT_RowIndex', name: '', searchable: false, sortable: false},
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'status', name: 'status'},
                {data: 'user', name: 'user' ,width: '5%'},
                {data: 'aqar_kind', name: 'aqar_kind', width: '10%'},
                {data: 'package', name: 'package' , width: '20%'},
                {data: 'period', name: 'period',width: '20%'},
                {data: 'published_at', name: 'published_at'},
                {data: 'ended_at', name: 'ended_at',searchable: false},
                // {data: 'aqar_type', name: 'aqar_type'},
                // {data: 'aqar_category', name: 'aqar_category'},
                // {data: 'image', name: 'image'},
                {data: 'operations', name: 'operations', searchable: false, width: '10%'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '1%'},
            ],
            order: [[2, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            aqarOrdersTable.search(this.value).draw();
        })
    </script>

@endpush
