@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Sliders')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">{{__('Sliders')}}</a></li>
        <li class="breadcrumb-item">{{__('Edit')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.sliders.update', $slider->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')


                    {{-- Choose type--}}
                    <div class="form-group">
                        <label>{{__('Choose type')}}<span class="text-danger">*</span></label>
                        <select name="type" class="form-control select2" required>
                            <option value="">{{__('Choose type')}}</option>
                            <option value="normal"
                                    @if($slider->type == 'normal') selected @endif>{{__('normal')}}</option>
                            <option value="special"
                                    @if($slider->type == 'special') selected @endif>{{__('special')}}</option>
                            <option value="vip"
                                    @if($slider->type == 'vip') selected @endif>{{__('vip')}}</option>

                        </select>
                    </div>

                    {{--sort--}}
                    <div class="form-group">
                        <label>{{__('sort')}}</label>
                        <input type="number" class="form-control" name="sort" value="{{$slider->sort}}">
                    </div>




                    {{-- image--}}
                    <div class="form-group">
                        <label>{{__('Image')}}<span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control load-image">
                        <img src="{{ asset(optional($slider)->image) }}" class="loaded-image" alt=""
                             style="display: block; width: 200px; margin: 10px 0;">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Update')}}
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

