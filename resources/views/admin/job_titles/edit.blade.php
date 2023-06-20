@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Branches')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" style="font-weight: bold; color: #009688">{{__('Company ')}}( {{$company->name}})</li>
        <li class="breadcrumb-item" style="font-weight: bold; color: #009688">{{__('Branch ')}}( {{$branch->name}})</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.companies.index') }}">{{__('Job titles')}}</a></li>
        <li class="breadcrumb-item">{{__('Edit')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.companies.branches.job-titles.update', [$company->id,$branch->id,$jobTitle->id]) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>{{__('Name')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $jobTitle->name) }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>{{__('Cost Center')}}<span class="text-danger">*</span></label>
                        <input type="text" name="center_cost" class="form-control" value="{{ old('name', $jobTitle->center_cost) }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Update')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

