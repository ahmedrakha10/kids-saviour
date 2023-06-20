<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->display_name  ?? ''}}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i
                    class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">{{__('Home')}}</span></a></li>

        {{--roles--}}
        @if (auth()->user()->hasPermission('read_roles'))
            <li><a class="app-menu__item {{ request()->is('*roles*') ? 'active' : '' }}"
                   href="{{ route('admin.roles.index') }}"><i class="app-menu__icon fa fa-lock"></i> <span
                        class="app-menu__label">{{__('Roles')}}</span></a></li>
        @endif

        {{--admins--}}
        @if (auth()->user()->hasPermission('read_admins'))
            <li><a class="app-menu__item {{ request()->is('*admins*') ? 'active' : '' }}"
                   href="{{ route('admin.admins.index') }}"><i class="app-menu__icon fa fa-users"></i> <span
                        class="app-menu__label">{{__('Supervisors')}}</span></a></li>
        @endif

        {{--sliders--}}
        @if (auth()->user()->hasPermission('read_sliders'))
            <li><a class="app-menu__item {{ request()->is('*sliders*') ? 'active' : '' }}"
                   href="{{ route('admin.sliders.index') }}"><i class="app-menu__icon fa fa-photo"></i> <span
                        class="app-menu__label">{{__('Sliders')}}</span></a></li>
        @endif

        {{--app users--}}
        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user-o"></i> <span
                        class="app-menu__label">{{__('Users')}}</span></a></li>
        @endif

        {{--articles--}}
        @if (auth()->user()->hasPermission('read_articles'))
            <li><a class="app-menu__item {{ request()->is('*articles*') ? 'active' : '' }}"
                   href="{{ route('admin.articles.index') }}"><i class="app-menu__icon fa fa-book"></i> <span
                        class="app-menu__label">{{__('Articles')}}</span></a></li>
        @endif

        {{--tags--}}
        @if (auth()->user()->hasPermission('read_tags'))
            <li><a class="app-menu__item {{ request()->is('*tags*') ? 'active' : '' }}"
                   href="{{ route('admin.tags.index') }}"><i class="app-menu__icon fa fa-tag"></i> <span
                        class="app-menu__label">{{__('Tags')}}</span></a></li>
        @endif

        {{--order your aqar--}}
        @if (auth()->user()->hasPermission('read_orders'))
            <li><a class="app-menu__item {{ request()->is('*order-aqar*') ? 'active' : '' }}"
                   href="{{ route('admin.order-aqar.index') }}"><i class="app-menu__icon fa fa-shopping-basket"></i> <span
                        class="app-menu__label">{{__('Orders')}} ( {{__('Order your aqar')}} )</span></a></li>
        @endif


        {{--aqar orders--}}
        @if (auth()->user()->hasPermission('read_aqar_orders'))
            <li><a class="app-menu__item {{ request()->is('*aqar-orders*') ? 'active' : '' }}"
                   href="{{ route('admin.aqar-orders.index') }}"><i class="app-menu__icon fa fa-shopping-bag"></i> <span
                        class="app-menu__label">{{__('Aqar orders')}}</span></a></li>
        @endif


        {{--question reports--}}
        @if (auth()->user()->hasPermission('read_report_questions'))
            <li><a class="app-menu__item {{ request()->is('*report_questions*') ? 'active' : '' }}"
                   href="{{ route('admin.report-question.index') }}"><i class="app-menu__icon fa fa-adn"></i> <span
                        class="app-menu__label">{{__('Question reports')}}</span></a></li>
        @endif

        {{--comment reports--}}
        @if (auth()->user()->hasPermission('read_report_comments'))
            <li><a class="app-menu__item {{ request()->is('*report_comments*') ? 'active' : '' }}"
                   href="{{ route('admin.report-comment.index') }}"><i class="app-menu__icon fa fa-bullhorn"></i> <span
                        class="app-menu__label">{{__('Comments reports')}}</span></a></li>
        @endif

        {{--Aqar Types--}}
        @if (auth()->user()->hasPermission('read_aqar_types'))
            <li><a class="app-menu__item {{ request()->is('*aqar_types*') ? 'active' : '' }}"
                   href="{{ route('admin.aqar-types.index') }}"><i class="app-menu__icon fa fa-area-chart"></i> <span
                        class="app-menu__label">{{__('Aqar Types')}}</span></a></li>
        @endif

        {{--Packages--}}
        @if (auth()->user()->hasPermission('read_packages'))
            <li><a class="app-menu__item {{ request()->is('*packages*') ? 'active' : '' }}"
                   href="{{ route('admin.packages.index') }}"><i class="app-menu__icon fa fa-book"></i> <span
                        class="app-menu__label">{{__('Packages')}}</span></a></li>
        @endif

        {{--Services--}}
        @if (auth()->user()->hasPermission('read_services'))
            <li><a class="app-menu__item {{ request()->is('*services*') ? 'active' : '' }}"
                   href="{{ route('admin.services.index') }}"><i class="app-menu__icon fa fa-wrench"></i> <span
                        class="app-menu__label">{{__('Services')}}</span></a></li>
        @endif

        {{-- Aqar tips--}}
        @if (auth()->user()->hasPermission('read_aqar_tips'))
            <li><a class="app-menu__item {{ request()->is('*aqar_tips*') ? 'active' : '' }}"
                   href="{{ route('admin.aqar-tips.index') }}"><i class="app-menu__icon fa fa-support"></i> <span
                        class="app-menu__label">{{__('Aqar Tips')}}</span></a></li>
        @endif

        {{--payment methods--}}
        @if (auth()->user()->hasPermission('read_payment_methods'))
            <li><a class="app-menu__item {{ request()->is('*payment_methods*') ? 'active' : '' }}"
                   href="{{ route('admin.payment-methods.index') }}"><i class="app-menu__icon fa fa-money"></i> <span
                        class="app-menu__label">{{__('Payment methods')}}</span></a></li>
        @endif

        {{--Cities--}}
        @if (auth()->user()->hasPermission('read_cities'))
            <li><a class="app-menu__item {{ request()->is('*cities*') ? 'active' : '' }}"
                   href="{{ route('admin.cities.index') }}"><i class="app-menu__icon fa fa-flag"></i> <span
                        class="app-menu__label">{{__('Cities')}}</span></a></li>
        @endif

        {{--Service orders--}}
        @if (auth()->user()->hasPermission('read_service_orders'))
            <li><a class="app-menu__item {{ request()->is('*service_orders*') ? 'active' : '' }}"
                   href="{{ route('admin.service-orders.index') }}"><i class="app-menu__icon fa fa-first-order"></i>
                    <span
                        class="app-menu__label">{{__('Service Orders')}}</span></a></li>
        @endif

        {{--Aqar Features--}}
        @if (auth()->user()->hasPermission('read_aqar_features'))
            <li><a class="app-menu__item {{ request()->is('*aqar-features*') ? 'active' : '' }}"
                   href="{{ route('admin.aqar-features.index') }}"><i class="app-menu__icon fa fa-hourglass-start"></i>
                    <span
                        class="app-menu__label">{{__('Aqar Features')}}</span></a></li>
        @endif

        {{--        settings--}}
        @if (auth()->user()->hasPermission('read_settings'))
            <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}"><a class="app-menu__item"
                                                                                           href="#"
                                                                                           data-toggle="treeview"><i
                        class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">
          {{__('Settings')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('admin.settings.general') }}"><i
                                class="icon fa fa-circle-o"></i>{{__('General settings')}}</a></li>
                </ul>
            </li>
        @endif

        {{--profile--}}
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a
                class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-user-circle"></i><span
                    class="app-menu__label">{{__('User profile')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.profile.edit') }}"><i
                            class="icon fa fa-circle-o"></i>{{__('Profile')}}</a></li>
                <li><a class="treeview-item" href="{{ route('admin.profile.password.edit') }}"><i
                            class="icon fa fa-circle-o"></i>{{__('Change password')}}</a></li>
            </ul>
        </li>

        <li>
            <a class="app-menu__item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="app-menu__icon fa fa-sign-out fa-lg"></i>
                {{__('Logout')}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </li>

    </ul>
</aside>
