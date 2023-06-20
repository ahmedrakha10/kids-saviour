@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Packages')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item">{{__('Create')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.packages.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

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

                    {{--arabic period--}}
                    <div class="form-group">
                        <label>{{__('Period in arabic')}}<span class="text-danger">*</span></label>
                        <input type="text" name="period[ar]" class="form-control" value="{{ old('period.ar') }}"
                               required
                               autofocus>
                    </div>

                    {{--english period--}}
                    <div class="form-group">
                        <label>{{__('Period in english')}}<span class="text-danger">*</span></label>
                        <input type="text" name="period[en]" class="form-control" value="{{ old('period.en') }}"
                               required
                               autofocus autocomplete="off">
                    </div>

                    {{--arabic position--}}
                    <div class="form-group">
                        <label>{{__('Position in arabic')}}</label>
                        <input type="text" name="position[ar]" class="form-control" value="{{ old('position.ar') }}"
                               autofocus>
                    </div>

                    {{--english position--}}
                    <div class="form-group">
                        <label>{{__('Position in english')}}</label>
                        <input type="text" name="position[en]" class="form-control" value="{{ old('position.en') }}"
                               autofocus autocomplete="off">
                    </div>

                    {{--arabic views number--}}
                    <div class="form-group">
                        <label>{{__('Views number in arabic')}}<span class="text-danger">*</span></label>
                        <input type="text" name="views_number[ar]" class="form-control"
                               value="{{ old('views_number.ar') }}" required
                               autofocus>
                    </div>

                    {{--english views number--}}
                    <div class="form-group">
                        <label>{{__('Views number in english')}}<span class="text-danger">*</span></label>
                        <input type="text" name="views_number[en]" class="form-control"
                               value="{{ old('views_number.en') }}" required
                               autofocus autocomplete="off">
                    </div>

                    {{--price--}}
                    <div class="form-group">
                        <label>{{__('price')}}<span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required
                               autofocus autocomplete="off">
                    </div>

                    {{-- Type--}}
                    <div class="form-group">
                        <label class="form-label">{{__("Type")}} <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control select2" required>
                            <option value="">{{__('Choose type')}}</option>
                            <option value="individual"
                                    @if(old('type') == 'individual') selected @endif>{{__('individual')}}</option>
                            <option value="companies"
                                    @if(old('type') == 'companies') selected @endif>{{__('companies')}}
                            </option>
                        </select>
                    </div>

                    <div class="ads" style="display: none">
                        {{--total ads--}}
                        <div class="form-group">
                            <label>{{__('total ads')}}</label>
                            <input type="number" name="total_ads" class="form-control" value="{{ old('total_ads') }}"
                                   autocomplete="off">
                        </div>

                        {{--normal_ads--}}
                        <div class="form-group">
                            <label>{{__('normal ads')}}</label>
                            <input type="number" name="normal_ads" class="form-control" value="{{ old('normal_ads') }}"
                                   autocomplete="off">
                        </div>

                        {{--special_ads--}}
                        <div class="form-group">
                            <label>{{__('special ads')}}</label>
                            <input type="number" name="special_ads" class="form-control"
                                   value="{{ old('special_ads') }}"
                                   autocomplete="off">
                        </div>

                        {{--vip_ads--}}
                        <div class="form-group">
                            <label>{{__('vip ads')}}</label>
                            <input type="number" name="vip_ads" class="form-control" value="{{ old('vip_ads') }}"
                                   autocomplete="off">
                        </div>

                        {{--banner_ads--}}
                        <div class="form-group">
                            <label>{{__('banner ads')}}</label>
                            <input type="number" name="banner_ads" class="form-control" value="{{ old('banner_ads') }}"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('Create')}}
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->



    <script>

        $("#type").change(function () {
            var type = $("#type").val();
            if (type === 'companies') {
                $(".ads").show();
                $("input[name='total_ads'] ").prop('required', true);
                $("input[name='normal_ads'] ").prop('required', true);
                $("input[name='special_ads'] ").prop('required', true);
                $("input[name='vip_ads'] ").prop('required', true);
                $("input[name='banner_ads'] ").prop('required', true);
            } else {
                $(".ads").hide();
            }
        });
    </script>
@endsection
