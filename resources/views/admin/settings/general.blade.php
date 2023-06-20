@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Settings')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('General settings')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @include('admin.partials._errors')

                    <div class="row g-3">
                        {{--logo--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Settings logo')}}</label>
                            <input type="file" name="logo" class="form-control load-image">
                            <img src="{{ Storage::url('uploads/' . setting('logo')) }}" class="loaded-image" alt=""
                                 style="display: {{ setting('logo') ? 'block' : 'none' }}; width: 100px; margin: 10px 0;">
                        </div>

                        {{--fav_icon--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Settings fav icon')}}</label>
                            <input type="file" name="fav_icon" class="form-control load-image">
                            <img src="{{ Storage::url('uploads/' . setting('fav_icon')) }}" class="loaded-image" alt=""
                                 style="display: {{ setting('fav_icon') ? 'block' : 'none' }}; width: 50px; margin: 10px 0;">
                        </div>

                        {{--title--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Title in arabic')}}</label>
                            <input type="text" name="title[ar]" class="form-control" value="{{ setting('title.ar') }}">
                        </div>

                        {{--title--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Title in english')}}</label>
                            <input type="text" name="title[en]" class="form-control" value="{{ setting('title.en') }}">
                        </div>

                        {{--keywords--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Keywords')}}</label>
                            <input type="text" name="keywords" class="form-control" value="{{ setting('keywords') }}">
                        </div>

                        {{--email--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Email')}}</label>
                            <input type="text" name="email" class="form-control" value="{{ setting('email') }}">
                        </div>

                        {{--Phone--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Phone')}}</label>
                            <input type="number" name="phone" class="form-control" value="{{ setting('phone') }}">
                        </div>

                        {{--Businees address--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Business address')}}</label>
                            <input type="text" name="business_address" class="form-control" value="{{ setting('business_address') }}">
                        </div>

                        {{--facebook--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Facebook url')}}</label>
                            <input type="text" name="facebook_url" class="form-control" value="{{ setting('facebook_url') }}">
                        </div>

                        {{--instagram--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Instagram url')}}</label>
                            <input type="text" name="instagram_url" class="form-control" value="{{ setting('instagram_url') }}">
                        </div>

                        {{--tiktok--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Tiktok url')}}</label>
                            <input type="text" name="tiktok_url" class="form-control" value="{{ setting('tiktok_url') }}">
                        </div>

                        {{--youtube--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Youtube url')}}</label>
                            <input type="text" name="youtube_url" class="form-control" value="{{ setting('youtube_url') }}">
                        </div>


                        {{--description--}}
                        <div class="col-md-12 form-group">
                            <label>{{__('Description in arabic')}}</label>
                            <textarea name="description[ar]"
                                      class="ckeditor form-control">{{ setting('description.ar') }}</textarea>
                        </div>

                        {{--description--}}
                        <div class="col-md-12 form-group">
                            <label>{{__('Description in english')}}</label>
                            <textarea name="description[en]"
                                      class="ckeditor form-control">{{ setting('description.en') }}</textarea>
                        </div>

                        {{--meta description ar--}}
                        <div class="col-md-12 form-group">
                            <label>{{__('Meta Description in arabic')}}</label>
                            <textarea name="meta_description[ar]"
                                      class="ckeditor form-control">{{ setting('meta_description.ar') }}</textarea>
                        </div>

                        {{--meta description en--}}
                        <div class="col-md-12 form-group">
                            <label>{{__('Meta Description in english')}}</label>
                            <textarea name="meta_description[en]"
                                      class="ckeditor form-control">{{ setting('meta_description.en') }}</textarea>
                        </div>

                    </div>
                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Update')}}
                        </button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
