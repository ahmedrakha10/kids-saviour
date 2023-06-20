@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Sliders')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">{{__('Sliders')}}</a></li>
        <li class="breadcrumb-item">{{__('Create')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- Choose type--}}
                    <div class="form-group">
                        <label>{{__('Choose type')}}<span class="text-danger">*</span></label>
                        <select name="type" class="form-control select2" required>
                            <option value="">{{__('Choose type')}}</option>
                            <option value="normal" >{{__('normal')}}</option>
                            <option value="special"  >{{__('special')}}</option>
                            <option value="vip"  >{{__('vip')}}</option>
                        </select>
                    </div>



                    {{--sort--}}
                    <div class="form-group">
                        <label>{{__('sort')}}</label>
                        <input type="number" class="form-control" name="sort">
                    </div>

                    {{--Image--}}
                    <div class="form-group">
                        <label class="form-label">{{__('Image')}}</label>
                        <input type="file" name="image" class="form-control" onchange="previewFile(this)">
                        <img id="previewImg" style="max-width:130px;margin-top:20px;">
                    </div>

                    <div class="form-group">
                        <button type="submit" onclick="submitForm(this)" class="btn btn-primary"><i
                                class="fa fa-plus"></i>{{__('Create')}}
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection


