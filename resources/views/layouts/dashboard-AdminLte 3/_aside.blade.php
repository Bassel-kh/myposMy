@php
    $dir= 'left';
    $dir_ = 'r';
    if(app()->getLocale() == 'en'){
            $dir= 'right';
            $dir_ = 'l';
            }
@endphp



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-blue elevation-4 ">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset( 'dashboard AdminLte 3_files/dist/img/AdminLTELogo.png' ) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <p class=" text-center font-weight-light ">&nbsp&nbspاتصالات الخليل</p>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('uploads/userImages/'.Auth::user()->image ) }}" class="img-circle elevation-2" style="width: 30px; height: 30px;" alt="User Image">
            </div>
            <br>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <!-- Main list -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link bg-gradient-blue text-white">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('site.dashboard') }}
                            <i class="{{$dir}} fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-blue"></i>
                                <p>{{ __('site.daily_payments') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-blue"></i>
                                <p>{{ __('site.new_orders') }}</p>
                            </a>
                        </li>

                        @if(@auth()->user()->hasPermission('orders_read'))
                            <li class="nav-item">
                                <a href="{{route('dashboard.orders.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-maroon"></i>
                                    <p>{{__('site.orders')}}</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-blue"></i>
                                <p>{{ __('site.customer_balances') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-blue"></i>
                                <p>{{ __('site.financial_profit') }}</p>
                            </a>
                        </li>

                    </ul>

                </li><!-- ./ Main List -->

                <!-- Management permission and Role List Users Roles Permissions Teams -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link bg-gradient-danger text-white">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            {{__('site.permissions_management')}}
                            <i class="{{$dir}} fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('dashboard/permissions') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>{{__('site.permissions')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/permissionsAjax') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Ajax {{__('site.permissions')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/permissionsReAjax') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>ReAjax {{__('site.permissions')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/roles') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>{{__('site.roles')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/rolesReAjax') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>ReAjax {{__('site.roles')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/teamsReAjax') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>ReAjax {{__('site.team')}}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('dashboard/userTestAjax') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>{{__('site.assign_roles_and_permissions')}}</p>
                            </a>
                        </li>
                    </ul>
                </li><!-- ./Management permission and Role List -->

                <!-- Management Users Customers Admins List -->
                @if(@auth()->user()->hasPermission('users_read'))
{{--                    @if(@auth()->user()->hasRole('admin'))--}}
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link bg-gradient-success text-white  ">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            إدارة المستخدمين
                            <i class="{{$dir}} fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-success"></i>
                                    <p>{{ __('site.users') }} v2</p>
                                </a>
                            </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>----------------</p>
                            </a>
                        </li>

                    </ul>
                </li><!-- ./Management Users Customers Admins List -->
            @endif
                <!-- Management Payments List -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link bg-gradient-info text-white">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            إدارةالفواتير
                            <i class="{{$dir}} fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>------------</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>-----------</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>----------</p>
                            </a>
                        </li>
                    </ul>
                </li><!-- ./Management Payments List  -->

                <!-- Management Site Content List -->
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link bg-gradient-maroon text-white">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            إدارة محتوى الموقع
                            <i class="{{$dir}} fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.categories.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon text-maroon"></i>
                                <p>{{__('site.Categories')}}</p>
                            </a>
                        </li>

                        @if(@auth()->user()->hasPermission('products_read'))
                            <li class="nav-item">
                                <a href="{{route('dashboard.products.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-maroon"></i>
                                    <p>{{__('site.products')}}</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon text-maroon"></i>
                                <p></p>
                            </a>
                        </li>
                    </ul>
                </li><!-- ./Management Site Content List -->

                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link bg-gradient-dark text-white">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            إدارة العملاء
                            <i class="{{$dir}} fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(@auth()->user()->hasPermission('clients_read'))
                            <li class="nav-item">
                                <a href="{{route('dashboard.clients.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-maroon"></i>
                                    <p>{{__('site.clients')}}</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li><!-- ./Management Clients List -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
