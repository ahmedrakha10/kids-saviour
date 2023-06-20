@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Users')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{__('Users')}}</a></li>
        <li class="breadcrumb-item">{{__('Show')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <div class="row g-3">
                    {{--first name--}}
                    <div class="col-md-6 form-group">
                        <label>{{__('First name')}}</label>
                        <input type="text" name="first_name" class="form-control"
                               disabled value="{{ old('first_name', $user->first_name) }}">
                    </div>

                    {{--last name--}}
                    <div class="col-md-6 form-group">
                        <label>{{__('Last name')}}</label>
                        <input type="text" name="last_name" class="form-control"
                               disabled value="{{ old('last_name', $user->last_name) }}">
                    </div>


                    {{--email--}}
                    <div class="col-md-6 form-group">
                        <label>{{__('Email')}}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                               disabled >
                    </div>

                    {{--phone--}}
                    <div class="col-md-6 form-group">
                        <label>{{__('Phone')}}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}"
                               disabled >
                    </div>

                    {{--wallet--}}
                    <div class="col-md-6  form-group">
                        <label>{{__('Wallet')}}</label>
                        <input type="text" class="form-control" value="{{ $user->wallet  ?? 0 }}"
                               disabled >
                    </div>

                    {{--points--}}
                    <div class="col-md-6  form-group">
                        <label>{{__('Points')}}</label>
                        <input type="text" class="form-control" value="{{ $user->points ?? 0 }}"
                               disabled >
                    </div>

                    {{--package--}}
                    <div class="col-md-6  form-group">
                        <label>{{__('Package')}}</label>
                        <input type="text" class="form-control"
                               value="{{ optional($user->package)->name ?? __('Not subscribed to package yet') }}"
                               disabled >
                    </div>

                    {{--membership level--}}
                    <div class="col-md-6  form-group">
                        <label>{{__('Type')}}</label>
                        <input type="text" class="form-control" value="{{ __($user->membership_level) }}"
                               disabled >
                    </div>

                    {{--status--}}
                    <div class="col-md-6  form-group">
                        <label>{{__('Status')}}</label>
                        <input type="text" class="form-control"
                               value="{{ $user->status) == 1 ? __('Active'): __('De-active' }}"
                               disabled="" >
                    </div>

                </div>
                    {{-- image--}}
                    <div class="col-md-6 form-group">
                        <label>{{__('Image')}}</label>
                        <img src="{{ asset(optional($user)->image) }}" class="loaded-image" alt=""
                             style="display: block; width: 200px; margin: 10px 0;">
                    </div>

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

