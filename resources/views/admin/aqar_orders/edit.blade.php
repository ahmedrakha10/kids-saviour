@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Aqar orders')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{__('Aqar orders')}}</a></li>
        <li class="breadcrumb-item">{{__('Show')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <form method="post" action="{{ route('admin.aqar-orders.update', $aqarOrder->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row g-3">

                        {{-- choose ads_type--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Choose ads type')}}<span class="text-danger">*</span></label>
                            <select name="ads_type_id" class="form-control select2" required>
                                <option value="">{{__('Choose ads type')}}</option>
                                @foreach ($adsTypes as $adsType)
                                    <option
                                        value="{{ $adsType->id }}" {{ $adsType->id == $aqarOrder->adsType->id ? 'selected' : '' }}>{{ $adsType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- update status--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Update status')}}<span class="text-danger">*</span></label>
                            <select name="status" class="form-control select2" required>
                                <option value="">{{__('Update status')}}</option>
                                <option value="draft"
                                        @if($aqarOrder->status == 'draft') selected @endif>{{__('draft')}}</option>
                                <option value="published"
                                        @if($aqarOrder->status == 'published') selected @endif>{{__('published')}}
                                <option value="pending"
                                        @if($aqarOrder->status == 'pending') selected @endif>{{__('pending')}}
                                <option value="rejected"
                                        @if($aqarOrder->status == 'rejected') selected @endif>{{__('rejected')}}
                                <option value="unavailable"
                                        @if($aqarOrder->status == 'unavailable') selected @endif>{{__('unavailable')}}
                                </option>
                            </select>
                        </div>

                        {{--name in arabic--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Name in arabic')}}</label>
                            <input type="text" class="form-control" name="name[ar]"
                                   value="{{  $aqarOrder->getOriginal('name')['ar']}}">
                        </div>

                        {{-- name in english--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Name in english')}}</label>
                            <input type="text" class="form-control" name="name[en]"
                                   value="{{ $aqarOrder->getOriginal('name')['en'] }}">
                        </div>


                        {{--aqar type--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Aqar type')}}</label>
                            <select name="aqar_type_id" id="aqar_type_id" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose aqar type')}}</option>
                                @foreach ($aqarTypes as $aqarType)
                                    <option
                                        value="{{ $aqarType->id }}" {{ $aqarType->id == $aqarOrder->aqarType->id ? 'selected' : '' }}>{{ $aqarType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--aqar category--}}
                        <div class="col-md-6 form-group">
                            <label>{{__('Aqar category')}}</label>
                            <select name="aqar_category_id" id="aqar-categories" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose aqar category')}}</option>
                                @foreach ($aqarCategories as $aqarCategory)
                                    <option
                                        value="{{ $aqarCategory->id }}" {{ $aqarCategory->id == $aqarOrder->aqarCategory->id ? 'selected' : '' }}>{{ $aqarCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--aqar kind--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Aqar Kind')}}</label>
                            <select name="aqar_kind_id" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose aqar kind')}}</option>
                                <option value="1"
                                        @if($aqarOrder->aqar_kind_id == 1) selected @endif>{{__('For sale')}}</option>
                                <option value="2"
                                        @if($aqarOrder->aqar_kind_id == 2) selected @endif>{{__('For rent')}}
                                </option>
                            </select>
                        </div>

                        {{--payment method--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Payment method')}}</label>
                            <select name="payment_method" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose payment method')}}</option>
                                <option value="cache"
                                        @if($aqarOrder->payment_method == 'cache') selected @endif>{{__('cache')}}</option>
                                <option value="installment"
                                        @if($aqarOrder->payment_method == 'installment') selected @endif>{{__('installment')}}

                            </select>
                        </div>

                        {{--package--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Package')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ optional($aqarOrder->package)->name ?? __('Not subscribed to package yet') }}"
                                   disabled>
                        </div>

                        {{--region--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Region')}}</label>
                            <select name="region_id" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose region')}}</option>
                                @foreach ($regions as $region)
                                    <option
                                        value="{{ $region->id }}" {{ $region->id == $aqarOrder->region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--price--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('price')}}</label>
                            <input type="number" class="form-control" name="price"
                                   value="{{ $aqarOrder->price ?? 0 }}">
                        </div>

                        {{--code--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Code')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ $aqarOrder->code ?? '' }}"
                                   disabled="">
                        </div>

                        {{--width--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Width')}}</label>
                            <input type="number" class="form-control" name="width"
                                   value="{{ $aqarOrder->width ?? 0 }}">
                        </div>

                        {{--floor--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Floor')}}</label>
                            <input type="number" class="form-control" name="floor"
                                   value="{{ $aqarOrder->floor ?? '' }}">
                        </div>

                        {{--user--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('User')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ $aqarOrder->user->username ?? '' }}"
                                   disabled="">
                        </div>

                        {{--Phone--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Phone')}}</label>
                            <input type="number" class="form-control" name="phone"
                                   value="{{ $aqarOrder->phone ?? '' }}">
                        </div>

                        {{--registerd--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Registered ?')}}</label>
                            <select name="registered" class="form-control select2" required>
                                <option value="" disabled>{{__('Registered ?')}}</option>
                                <option value="yes"
                                        @if($aqarOrder->registered == 'yes') selected @endif>{{__('Yes')}}</option>
                                <option value="no"
                                        @if($aqarOrder->registered == 'no') selected @endif>{{__('No')}}
                                </option>
                                <option value="recordable"
                                        @if($aqarOrder->registered == 'recordable') selected @endif>{{__('Recordable')}}
                                </option>
                            </select>
                        </div>

                        {{--bed rooms--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Bed rooms')}}</label>
                            <input type="number" class="form-control" name="bed_rooms"
                                   value="{{ $aqarOrder->bed_rooms ?? 0 }}">
                        </div>

                        {{--bath rooms--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Bath rooms')}}</label>
                            <input type="number" class="form-control" name="bath_rooms"
                                   value="{{ $aqarOrder->bath_rooms ?? 0 }}">
                        </div>

                        {{--views--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Views')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ $aqarOrder->views ?? 0 }}"
                                   disabled="">
                        </div>

                        {{--published_at--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Published at')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ $aqarOrder->published_at ?? '' }}"
                                   disabled="">
                        </div>

                        {{--building year--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Building year')}}</label>
                            <input type="number" class="form-control" name="building_year"
                                   value="{{ $aqarOrder->building_year ?? '' }}">
                        </div>

                        {{--Status--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Status')}}</label>
                            <input type="text" class="form-control"
                                   value="{{ __($aqarOrder->status) }}"
                                   disabled="">
                        </div>

                        {{--rent type--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Rent type')}}</label>
                            <select name="rent_type" class="form-control select2" required>
                                <option value="" disabled>{{__('Rent type')}}</option>
                                <option value="monthly"
                                        @if($aqarOrder->rent_type == 'monthly') selected @endif>{{__('Monthly')}}</option>
                                <option value="annual"
                                        @if($aqarOrder->rent_type == 'annual') selected @endif>{{__('Annually')}}
                                </option>
                            </select>
                        </div>

                        {{--finishing type--}}
                        <div class="col-md-6  form-group">
                            <label>{{__('Finishing type')}}</label>
                            <select name="finishing_type_id" class="form-control select2" required>
                                <option value="" disabled>{{__('Choose finishing type')}}</option>
                                @foreach ($finishingTypes as $finishingType)
                                    <option
                                        value="{{ $finishingType->id }}" {{ $finishingType->id == $aqarOrder->finishingType->id ? 'selected' : '' }}>{{ $finishingType->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    {{--arabic description--}}
                    <div class="form-group">
                        <label>{{__('Description in arabic')}}<span class="text-danger">*</span></label>
                        <textarea class="ckeditor form-control" name="description[ar]"
                                  required>{{ $aqarOrder->getOriginal('description')['ar'] }}
                        </textarea>
                    </div>

                    {{--english description--}}
                    <div class="form-group">
                        <label>{{__('Description in english')}}<span class="text-danger">*</span></label>
                        <textarea class="ckeditor form-control" name="description[en]"
                                  required>{{ $aqarOrder->getOriginal('description')['en'] }}
                        </textarea>
                    </div>

                    {{--                    --}}{{-- image--}}
                    {{--                    <div class="col-md-6 form-group">--}}
                    {{--                        <label>{{__('Images')}}</label>--}}
                    {{--                        @foreach($aqarOrder->images as $image)--}}
                    {{--                            <img src="{{ asset(optional($image)->url) }}" class="loaded-image" alt=""--}}
                    {{--                                 style="display: inline; width: 200px; margin: 10px 0;">--}}
                    {{--                        @endforeach--}}
                    {{--                    </div>--}}


                    <div class="form-group">
                        <label>{{__('Images')}}</label>
                        <div class="col-md-12">
                            {{ Form::file('image[]',['class'=>'form-control','id'=>'' ,'multiple' => 'multiple']) }}
                            @if($errors->has('image'))
                                <div class="alert alert-danger">{{$errors->first('image')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image_current"
                               class="col-sm-3 col-form-label">{{__('Current images')}}</label>
                        <div class="col-sm-9" style="display: flex;">
                            @foreach($aqarOrder->images as $img)
                                <div class="col-md-3" style="margin-bottom: 20px;">
                                    <img src="{{URL::to($img['url'])}}"
                                         class="img-thumbnail" style="width:100%; height: 150px;">
                                    <a href="{{URL::route('admin.photo.destroy',$img->id)}}"
                                       onclick="return confirm('Are you sure?')"
                                       class="btn btn-block btn-danger" style="margin-top: 0;"><span
                                            class="fa fa-trash-o"></span> {{__('Delete')}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" onclick="submitForm(this)" class="btn btn-primary"><i
                                class="fa fa-edit"></i> {{__('Update')}}
                        </button>
                    </div>
                </form>
            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->


    <script>
        $("#aqar_type_id").change(function () {
            var aqarType = $("#aqar_type_id").val();
            var url = window.laravelUrl + "/api/aqar-categories?aqar_type_id=" + aqarType;
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    //console.log(data[0].id);
                    $('#aqar-categories').empty();
                    var option = '<option value="" disabled>{{__('Choose aqar category')}}</option>';
                    $("#aqar-categories").append(option);
                    $.each(data, function (index, aqarCategory) {
                        var option = '<option value="' + aqarCategory.id + '">' + aqarCategory.name["{{app()->getLocale()}}"] + '</option>';
                        $("#aqar-categories").append(option);
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var aqarType = $("#aqar_type_id").val();
            var url = window.laravelUrl + "/api/aqar-categories?aqar_type_id=" + aqarType;
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    //console.log(data[0].id);
                    $('#aqar-categories').empty();
                    var option = '<option value="" disabled>{{__('Choose aqar category')}}</option>';
                    $("#aqar-categories").append(option);
                    $.each(data, function (index, aqarCategory) {
                        var option = '<option value="' + aqarCategory.id + '">' + aqarCategory.name["{{app()->getLocale()}}"] + '</option>';
                        $("#aqar-categories").append(option);
                    });
                }
            });
        });
    </script>
@endsection

