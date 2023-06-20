@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Aqar Features')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.aqar-features.index') }}">{{__('Aqar Features')}}</a></li>
        <li class="breadcrumb-item">{{__('Edit')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.aqar-features.update', $aqarFeature->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--arabic name--}}
                    <div class="form-group">
                        <label>{{__('Name in arabic')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name[ar]" class="form-control" value="{{ $aqarFeature->getOriginal('name')['ar'] }}" required
                               autofocus>
                    </div>

                    {{--english name--}}
                    <div class="form-group">
                        <label>{{__('Name in english')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name[en]" class="form-control" value="{{ $aqarFeature->getOriginal('name')['en'] }}" required
                               autofocus>
                    </div>


                    {{-- image--}}
                    <div class="form-group">
                        <label>{{__('Image')}}<span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control load-image" onchange="previewFile(this)">
                        <img src="{{ asset(optional($aqarFeature)->image) }}" class="loaded-image"   id="previewImg"
                             style="display: block; width: 200px; margin: 10px 0;">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Update')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

