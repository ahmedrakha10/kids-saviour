{{--@if (auth()->user()->hasPermission('update_regions'))--}}
    <a href="{{url('admin/regions/'.$region->id.'/cities')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> {{__('Add city')}}</a>
{{--@endif--}}
