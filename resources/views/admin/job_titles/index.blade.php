@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Job Titles')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" style="font-weight: bold; color: #009688">{{__('Company ')}}( {{$company->name}})</li>
        <li class="breadcrumb-item" style="font-weight: bold; color: #009688">{{__('Branch ')}}( {{$branch->name}})</li>
        <li class="breadcrumb-item">{{__('Job Titles')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">
                        @if (auth()->user()->hasPermission('create_branches'))
                            <a href="{{url('admin/companies/'.$company->id.'/branches/'.$branch->id.'/job-titles/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                {{__('Create')}}</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_branches'))
                            <form method="post" action="{{ route('admin.job-titles.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> {{__('Bulk delete')}}</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="{{__('Search')}}">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="branchesTable-table" style="width: 100%;">
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
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Cost Center')}}</th>
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

        let branchesTableTable = $('#branchesTable-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.job-titles.data',[$company->id,$branch->id]) }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'name', name: 'name'},
                {data: 'center_cost', name: 'center_cost'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[3, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            branchesTableTable.search(this.value).draw();
        })
    </script>

@endpush
