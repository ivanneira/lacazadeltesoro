<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{env('APP_FIRST_NAME')}}{{env('APP_SECOND_NAME')}}</title>

        <meta name="description" content="{{ config('app.desc') }}">
        <meta name="author" content="{{ config('app.author') }}">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.css') }}">


        <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/fullcalendar/fullcalendar.css') }}">

        <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/pulse.css') }}">
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>




        @yield('js_before')

        <style>
            .select2-container{
            width: 100%!important;
            }
            .select2-search--dropdown .select2-search__field {
            width: 98%;
            }

            .fc-toolbar { text-transform: capitalize; }

            .vcenter{
            vertical-align: middle !important;
            }

            .datepicker {
            z-index: 1600 !important; /* has to be larger than 1050 */
            }


        </style>
    </head>
    <body>


            <!-- Modal -->
            <div class="modal fade" id="ClaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ClaveModalTitle">Cambiar clave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form name="frmClave" id="frmClave" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Clave actual (*)</label>
                                    <input type="password" class="form-control" name="current_password" id="current_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Nueva clave (*)</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Repetir clave (*)</label>
                                    <input type="password" class="form-control" name="new_password1" id="new_password1">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="btn-save">Aplicar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>

        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-o sidebar-mini sidebar-inverse page-header-fixed enable-page-overlay side-scroll page-header-inverse main-content-boxed">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->

                        <!-- User Info -->
                        <div class="content-header-item">
                            <a class="img-link mr-5" href="javascript:void(0)">
                                <img class="img-avatar img-avatar32" src="{{ asset('media/photos/torogym.png') }}" alt="">
                            </a>
                            <a class="align-middle link-effect text-primary-dark font-w600" href="javascript:void(0)">{{ Auth::user()->name}}</a>
                        </div>
                        <!-- END User Info -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        Content..
                    </p>
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">T</span><span class="text-primary">G</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="/">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">{{ config('app.name') }}</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            <img class="img-avatar img-avatar32" src="{{ asset('media/photos/torogym.png') }}" alt="">
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="javascript:void(0)">
                                <img class="img-avatar" src="{{ asset('media/photos/torogym.png') }}" alt="">
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="javascript:void(0)">{{ Auth::user()->name}}</a>
                                </li>
                                <!--<li class="list-inline-item">-->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <!--<a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                        <i class="si si-drop"></i>
                                    </a>
                                </li>-->
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark" href="/logout">
                                        <i class="si si-logout"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <!--<div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li>
                                <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                                    <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">Various</span>
                            </li>
                            <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Examples</span></a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('pages/datatables') ? ' active' : '' }}" href="/pages/datatables">DataTables</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">Slick Slider</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('pages/blank') ? ' active' : '' }}" href="/pages/blank">Blank</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
                            </li>
                            <li>
                                <a href="/">
                                    <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
                                </a>
                            </li>
                        </ul>
                    </div>-->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">

                            <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-circle"></i><span class="sidebar-mini-hide">Menu</span></a>
                                    <ul>

                                        <li>
                                            <a class="{{ request()->is('recordatorios') ? ' active' : '' }}" href="/recordatorios"><span class="fa fa-envelope"></span> Recordatorios</a>
                                        </li>

                                        <li>
                                            <a class="{{ request()->is('rutinas') ? ' active' : '' }}" href="/rutinas"><span class="fa fa-list"></span> Rutinas</a>
                                        </li>

                                        <li>
                                            <a class="{{ request()->is('profesionales') ? ' active' : '' }}" href="/dietas"><span class="fa fa-star"></span> Dietas</a>
                                        </li>

                                        <li>
                                            <a class="{{ request()->is('alumnos') ? ' active' : '' }}" href="/alumnos"><span class="fa fa-user"></span> Alumnos</a>
                                        </li>

                                        <li>
                                            <a class="{{ request()->is('pagos') ? ' active' : '' }}" href="/pagos"><span class="fa fa-money"></span> Pagos</a>
                                        </li>

                                    </ul>
                            </li>

                            <li class="{{ request()->is('pages/*') ? ' open' : '' }}">

                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-circle"></i><span class="sidebar-mini-hide">Cronograma</span></a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('calendario') ? ' active' : '' }}" href="/calendario"><span class="fa fa-calendar"></span> Calendario</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="{{ request()->is('pages/*') ? ' open' : '' }}">

                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-circle"></i><span class="sidebar-mini-hide">Reportes</span></a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('general') ? ' active' : '' }}" href="#"><span class="fa fa-line-chart"></span> General</a>
                                    </li>
                                </ul>
                            </li>


                            {{-- <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wrench"></i><span class="sidebar-mini-hide">Configuraciones</span></a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('profesionales') ? ' active' : '' }}" href="#">Tipo de contacto</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('pages/slick') ? ' active' : '' }}" href="#">Log de movimientos</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('pages/slick') ? ' active' : '' }}" href="#">Notificaciones</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('pages/slick') ? ' active' : '' }}" href="#">Servicios</a>
                                    </li>

                                </ul>
                            </li> --}}


                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!--<button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-search"></i>
                        </button>-->
                        <!-- END Open Search Section -->

                        <!-- Layout Options (used just for demonstration) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown">
                                <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Settings</h5>
                                <h6 class="dropdown-header">Color Themes</h6>
                                <div class="row no-gutters text-center mb-5">
                                    <div class="col-2 mb-5">
                                        <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-elegance" data-toggle="theme" data-theme="{{ asset('css/themes/elegance.css') }}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-pulse" data-toggle="theme" data-theme="{{ asset('css/themes/pulse.css') }}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-flat" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-corporate" data-toggle="theme" data-theme="{{ asset('css/themes/corporate.css') }}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-earth" data-toggle="theme" data-theme="{{ asset('css/themes/earth.css') }}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <h6 class="dropdown-header">Header</h6>
                                <div class="row gutters-tiny text-center mb-5">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10" data-toggle="layout" data-action="header_style_classic">Classic Style</button>
                                    </div>
                                </div>
                                <h6 class="dropdown-header">Sidebar</h6>
                                <div class="row gutters-tiny text-center mb-5">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_off">Light</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_on">Dark</button>
                                    </div>
                                </div>
                                <div class="d-none d-xl-block">
                                    <h6 class="dropdown-header">Main Content</h6>
                                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="content_layout_toggle">Toggle Layout</button>
                                </div>
                            </div>
                        </div>
                        <!-- END Layout Options -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">{{ Auth::user()->name}}</span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">Usuario</h5>
                                <a class="dropdown-item" id="CambiarClave"  href="javascript:void(0)">
                                    <i class="fa fa-lock mr-5"></i> Cambiar clave
                                </a>
                                <!--<a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                                    <span class="badge badge-primary">3</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="si si-note mr-5"></i> Invoices
                                </a>
                                <div class="dropdown-divider"></div>-->

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <!--<a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                    <i class="si si-wrench mr-5"></i> Settings
                                </a>-->
                                <!-- END Side Overlay -->

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="si si-logout mr-5"></i> Salir
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flag"></i>
                                <span class="badge badge-primary badge-pill">0</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
                                <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notificaciones</h5>
                                <!--
                                <ul class="list-unstyled my-20">
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-check text-success"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                                                <div class="text-muted font-size-sm font-italic">15 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                                                <div class="text-muted font-size-sm font-italic">50 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                                                <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                                                <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-plus text-primary"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">New purchases! +$250</p>
                                                <div class="text-muted font-size-sm font-italic">1 day ago</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                                    <i class="fa fa-flag mr-5"></i> Ver todo
                                </a>-->
                            </div>
                        </div>
                        <!-- END Notifications -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        {{-- <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="fa fa-tasks"></i>
                        </button> --}}
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form action="/dashboard" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                   </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container" class="container-fluid px-0">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="container-fluid py-20 font-size-sm clearfix">
                    <div class="float-right">
                        Developed by <a class="font-w600" href="{{env('DEV_URL','asd')}}" target="_blank">{{ config('app.author') }}</a>
                    </div>
                    <!-- <div class="float-left">
                        <a class="font-w600" href="https://1.envato.market/95j" target="_blank">Codebase</a> &copy; <span class="js-year-copy"></span>
                    </div> -->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->





        <script src="{{ asset('js/codebase.app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

        <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>


        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('js/plugins/fullcalendar/locale/es.js') }}"></script>



        {{-- <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script> --}}
        <!-- Laravel Scaffolding JS -->

        <link rel="stylesheet" href="{{asset('css/app.css')}}"> 
        <script src="{{asset('js/app.js')}}"></script>


        <script type="text/javascript">

$("#CambiarClave").on('click', function(){
                $('#btn-save').html('Aplicar');
                $("#current_password").val('');
                $("#new_password").val('');
                $("#new_password1").val('');
                $("#ClaveModal").modal("show");
            })

            if ($("#frmClave").length > 0) {
                $("#frmClave").validate({

                    rules: {
                    current_password: "required",
                    new_password: "required",
                    new_password1: "required",
                    },
                    messages: {
                        current_password: "Ingrese su clave actual",
                        new_password: "Ingrese una nueva clave.",
                        new_password1: "Ingrese una nueva clave."
                    },

                    submitHandler: function(form) {
                        var actionType = $('#btn-save').val();
                        $('#btn-save').html('Aplicando..');
                        var validaUsers = validar();
                        //alert(validaUsers);
                    /* */
                    }
                })
            }

            function validar()
            {
                $.ajax({
                            data: $('#frmClave').serialize(),
                            url: "/users/changepassword",
                            type: "POST",
                            global: true,
                            dataType: 'json',
                            async: false,
                            success: function(data) {


                                switch(data.state)
                                {
                                    case 0:
                                    {
                                        $('#btn-save').html('Aplicar');
                                        swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: data.msg,
                                                })
                                    }break;

                                    case 1:
                                    {
                                        $('#btn-save').html('Aplicar');
                                        swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: data.msg,
                                                })
                                    }break;

                                    case 2:
                                    {

                                        $("#ClaveModal").modal("hide");
                                        swal.fire({
                                                    icon: 'success',
                                                    title: 'Ok',
                                                    text: data.msg,
                                                })
                                    }break;

                                    case 3:
                                    {
                                        $('#btn-save').html('Aplicar');
                                        swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: data.msg,
                                                })
                                    }break;

                                    case 4:
                                    {
                                        $('#btn-save').html('Aplicar');
                                        swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: data.msg,
                                                })
                                    }break;

                                }



                            },
                            error: function(data) {
                                //console.log('Error:', data);
                                $('#btn-save').html('Error al actualizar');
                                var j = JSON.parse(data.responseText)
                                        if(j.message == 'CSRF token mismatch.'){
                                            swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Su sesión expriró, reingrese a la plataforma o presiona la tecla F5.',
                                            })
                                        }
                            }
                        });
            }

        </script>


        @yield('js_after')
    </body>
</html>
