<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
    <meta name="description" content="">

    <title>{{ config('app.name') }}</title>

    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/main-teal.css') }}" media="all">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">
    @if (app()->getLocale() == 'ar')

        {{--google font--}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600&display=swap">

        <style>
            body {
                font-family: 'cairo', 'sans-serif';
            }

            .breadcrumb-item + .breadcrumb-item {
                padding-left: .5rem;
            }

            .breadcrumb-item + .breadcrumb-item::before {
                padding-left: .5rem;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                margin: 2px 2px;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                }
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
    @endif
    <style>
        .load {
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        .load-sm {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #009688;
            width: 40px;
            height: 40px;
        }
    </style>
    {{--jquery--}}
    <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-ui.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin_assets/plugins/noty/noty.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/lightbox2/css/lity.css') }}">

    {{--datatable--}}
    <script type="text/javascript"
            src="{{ asset('admin_assets/plugins/jquery.dataTables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('admin_assets/plugins/dataTables.bootstrap/dataTables.bootstrap.min.js') }}"></script>

    {{--<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>--}}
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    <link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css')}}">
    <style>
        .btn-sml {
            padding: 0px 0px;
            font-size: 1px;
            margin: 0 auto;
        }

        .ui-datepicker td span, .ui-datepicker td a {
            color: #000000; /* Numbers color */
            fill: #ffffff;
        }

        .ui-datepicker td {
            background: #ffffff; /* Numbers background */
        }

        .ui-datepicker-calendar .ui-state-hover {
            color: #009688; /* Numbers color on hover */
        }

        .ui-datepicker-calendar .ui-state-active {
            color: #009688; /* Selected date color */
        }
    </style>
</head>

<body class="app sidebar-mini">

@include('layouts.admin._header')

@include('layouts.admin._aside')

<main class="app-content">

    @include('admin.partials._session')

    @yield('content')

    <div class="modal fade general-modal" id="add-brand" aria-labelledby="add-brand" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

</main><!-- end of main -->

<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>

{{--select 2--}}
<script type="text/javascript" src="{{ asset('admin_assets/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('admin_assets/js/main.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/lightbox2/js/lity.js') }}"></script>

{{--ckeditor--}}
<script src="{{ asset('admin_assets/plugins/ckeditor/ckeditor.js') }}"></script>


{{--custom--}}
<script src="{{ asset('admin_assets/js/custom/index.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom/roles.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    $(document).ready(function () {

        //delete
        $(document).on('click', '.delete, #bulk-delete', function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "{{__('Confirm delete')}}",
                type: "alert",
                killer: true,
                buttons: [
                    Noty.button("{{__('Yes')}}", 'btn btn-success mr-2', function () {
                        let url = that.closest('form').attr('action');
                        let data = new FormData(that.closest('form').get(0));

                        let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                        let originalText = that.html();
                        that.html(loadingText);

                        n.close();

                        $.ajax({
                            url: url,
                            data: data,
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (response) {
                                $("#record__select-all").prop("checked", false);

                                $('.datatable').DataTable().ajax.reload();
                                if (response.status === 0) {
                                    new Noty({
                                        layout: 'topRight',
                                        type: 'error',
                                        text: response.text,
                                        killer: true,
                                        timeout: 2000,
                                    }).show();
                                } else {
                                    new Noty({
                                        layout: 'topRight',
                                        type: 'success',
                                        text: response.text,
                                        killer: true,
                                        timeout: 2000,
                                    }).show();
                                }

                                that.html(originalText);
                            },

                        });//end of ajax call

                    }),

                    Noty.button("{{__('No')}}", 'btn btn-danger mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

    });//end of document ready

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

    //select 2
    $('select').select2({
        'width': '100%',
    });

</script>
<script>
    function submitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }
</script>
<script>
    function previewFile(input) {

        var image = $('input[type=file]').get(0).files[0];
        if (image) {
            var reader = new FileReader();
            reader.onload = function () {
                $('#previewImg').attr("src", reader.result);
            }
            reader.readAsDataURL(image);
        }

    }
</script>
<script>
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        // yearRange: “c-70:c+10”,
        changeYear: true
    });
</script>
<script>
    window.laravelUrl = "{{url('/')}}";
</script>

@stack('scripts')

</body>
</html>