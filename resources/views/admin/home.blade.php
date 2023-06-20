@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{__('Home')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">{{__('Statistics')}}</li>
    </ul>

    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Aqar orders')}}</p>
                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="aqar-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Draft orders')}}</p>
                                {{--                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>--}}
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="draft-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Pending orders')}}</p>
                                {{--                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>--}}
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="pending-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Published orders')}}</p>
                                {{--                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>--}}
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="published-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->


            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->
    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Rejected orders')}}</p>
                                {{--                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>--}}
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="rejected-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-bag"></span> {{__('Unavailable orders')}}
                                </p>
                                {{--                                <a href="{{route('admin.aqar-orders.index')}}">{{__('Show all ...')}}</a>--}}
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="unavailable-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-shopping-basket"></span> {{__('Orders')}}
                                    ( {{__('Order your aqar')}} )
                                </p>
                                <a href="{{route('admin.order-aqar.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-tag"></span> {{__('Tags')}}
                                </p>
                                <a href="{{route('admin.tags.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="tags-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->


            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->
    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-money"></span> {{__('Payment methods')}}</p>
                                <a href="{{route('admin.payment-methods.index')}}">{{__('Show all ...')}}</a>
                            </div>

                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="payment-methods-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-area-chart"></span> {{__('Aqar Types')}}</p>
                                <a href="{{route('admin.aqar-types.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="aqar_types-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-flag"></span> {{__('Cities')}}</p>
                                <a href="{{route('admin.cities.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="cities-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-users"></span> {{__('Regions')}}</p>
                                <a href="{{route('admin.cities.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="regions-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->

    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-user"></span> {{__('Supervisors')}}</p>
                                <a href="{{route('admin.admins.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="supervisors-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-tasks"></span> {{__('Roles')}}</p>
                                <a href="{{route('admin.roles.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="roles-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->
                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-wrench"></span> {{__('Services')}}</p>
                                <a href="{{route('admin.services.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="services-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->
                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-book"></span> {{__('Packages')}}</p>
                                <a href="{{route('admin.packages.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="packages-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

            </div>   <!-- end of row-->

        </div><!-- End of col -->

    </div><!-- End of row -->

    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-support"></span> {{__('Aqar Tips')}}</p>
                                <a href="{{route('admin.aqar-tips.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="aqar-tips-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->
                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-hourglass-start"></span> {{__('Aqar Features')}}</p>
                                <a href="{{route('admin.aqar-features.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="aqar-features-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->
                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-first-order"></span> {{__('Service Orders')}}</p>
                                <a href="{{route('admin.service-orders.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="service-orders-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->
                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-adn"></span> {{__('Question reports')}}</p>
                                <a href="{{route('admin.report-question.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="report-questions-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->
    <div class="row mt-5">

        <div class="col-md-12">


            <div class="row" id="top-statistics">

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-bullhorn"></span> {{__('Comments report')}}</p>
                                <a href="{{route('admin.report-comment.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="report-comments-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-user-circle-o"></span> {{__('Clients')}}</p>
                                <a href="{{route('admin.users.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="users-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-user-o"></span> {{__('Companies')}}</p>
                                <a href="{{route('admin.users.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="companies-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

                <div class="col-md-3">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-address-book-o"></span> {{__('Articles')}}</p>
                                <a href="{{route('admin.articles.index')}}">{{__('Show all ...')}}</a>
                            </div>
                            <div class="load load-sm"></div>
                            <h3 class="mb-0" id="articles-count" style="display: none"></h3>
                        </div>


                    </div>

                </div>   <!-- End of col-->

            </div>   <!-- end of row-->


        </div><!-- End of col -->

    </div><!-- End of row -->



@endsection

@push('scripts')
    <script>
        $(function () {

            $.ajax({
                url: "{{route('admin.home.top_statistics')}}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .load-sm').hide();
                    $('#top-statistics #payment-methods-count').show().text(data.payment_methods_count);
                    $('#top-statistics #aqar_types-count').show().text(data.aqar_types_count);
                    $('#top-statistics #cities-count').show().text(data.cities_count);
                    $('#top-statistics #tags-count').show().text(data.tags_count);
                    $('#top-statistics #services-count').show().text(data.services_count);
                    $('#top-statistics #supervisors-count').show().text(data.supervisors_count);
                    $('#top-statistics #roles-count').show().text(data.roles_count);
                    $('#top-statistics #regions-count').show().text(data.regions_count);
                    $('#top-statistics #packages-count').show().text(data.packages_count);
                    $('#top-statistics #aqar-tips-count').show().text(data.aqar_tips_count);
                    $('#top-statistics #aqar-features-count').show().text(data.aqar_features_count);
                    $('#top-statistics #service-orders-count').show().text(data.service_orders_count);
                    $('#top-statistics #report-questions-count').show().text(data.report_questions_count);
                    $('#top-statistics #report-comments-count').show().text(data.report_comments_count);
                    $('#top-statistics #users-count').show().text(data.users_count);
                    $('#top-statistics #companies-count').show().text(data.companies_count);
                    $('#top-statistics #articles-count').show().text(data.articles_count);
                    $('#top-statistics #aqar-orders-count').show().text(data.aqar_orders_count);
                    $('#top-statistics #draft-orders-count').show().text(data.draft_orders_count);
                    $('#top-statistics #pending-orders-count').show().text(data.pending_orders_count);
                    $('#top-statistics #published-orders-count').show().text(data.published_orders_count);
                    $('#top-statistics #rejected-orders-count').show().text(data.rejected_orders_count);
                    $('#top-statistics #unavailable-orders-count').show().text(data.unavailable_orders_count);
                    $('#top-statistics #orders-count').show().text(data.orders_count);
                }
            });
        }); // end of document ready
    </script>
@endpush

