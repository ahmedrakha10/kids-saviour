@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Articles')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">{{__('Articles')}}</a></li>
        <li class="breadcrumb-item">{{__('Create')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- choose category--}}
                    <div class="form-group">
                        <label>{{__('Choose category')}}<span class="text-danger">*</span></label>
                        <select name="aqar_tip_id" class="form-control select2" required>
                            <option value="">{{__('Choose category')}}</option>
                            @foreach ($aqarTips as $aqarTip)
                                <option
                                    value="{{ $aqarTip->id }}" {{ $aqarTip->id == old('aqar_tip_id') ? 'selected' : '' }}>{{ $aqarTip->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--arabic name--}}
                    <div class="form-group">
                        <label>{{__('Name in arabic')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name[ar]" class="form-control" value="{{ old('name.ar') }}" required
                               autofocus>
                    </div>

                    {{--english name--}}
                    <div class="form-group">
                        <label>{{__('Name in english')}}<span class="text-danger">*</span></label>
                        <input type="text" name="name[en]" class="form-control" value="{{ old('name.en') }}" required
                               autofocus>
                    </div>

                    {{--arabic description--}}
                    <div class="form-group">
                        <label>{{__('Description in arabic')}}<span class="text-danger">*</span></label>
                        <textarea name="description[ar]" class="ckeditor form-control"
                                  required autofocus>
                        </textarea>
                    </div>

                    {{--english description--}}
                    <div class="form-group">
                        <label>{{__('Description in english')}}<span class="text-danger">*</span></label>
                        <textarea name="description[en]" class="ckeditor form-control"
                                  required autofocus>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="tags_list">{{__('Tags')}}</label>
                        {!! Form::select('tags_list[]',$tags,null,[

                        'class' => 'form-control select2',
                        'multiple' => 'multiple',
                        'required' => 'required'
                     ]) !!}
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


