{{--@if (auth()->user()->hasPermission('update_regions'))--}}
    <a href="{{url('admin/companies/'.$company->id.'/branches/'.$branch->id.'/job-titles')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> {{__('Add Job title')}}</a>
{{--@endif--}}
