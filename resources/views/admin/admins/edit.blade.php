@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Supervisors')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">{{__('Supervisors')}}</a></li>
        <li class="breadcrumb-item">{{__('Edit')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.admins.update', $admin->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--first name--}}
                    <div class="form-group">
                        <label>{{__('First Name')}}<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" value="{{ $admin->first_name}}" required
                               autofocus>
                    </div>

                    {{--last name--}}
                    <div class="form-group">
                        <label>{{__('Last Name')}}<span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" value="{{ $admin->last_name}}" required
                               autofocus>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>{{__('Email')}}<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                    </div>

                    {{--role_id--}}
                    <div class="form-group">
                        <label>{{__('Role')}} <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control select2" required>
                            <option value="">{{__('Choose role')}}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Update')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
