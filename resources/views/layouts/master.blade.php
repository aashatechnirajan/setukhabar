<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <?php
use App\Models\Favicon;
    $favicon = Favicon::first();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.headers')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . $favicon->apple_touch_icon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' .$favicon->favicon_thirtyTwo) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' .$favicon->favicon_sixteen) }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}"> --}}
    <link rel="manifest" href="{{ asset('uploads/favicon/file'.$favicon->file) }}">


</head>

<body class="hold-transition  sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">
                                <i class="fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @can('hasPermission','view_posts')
                        <li class="nav-item">
                            <a href="{{ route('admin.posts.index') }}" class="nav-link active">
                                <i class="fas fa-newspaper"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_posts')
                        <li class="nav-item">
                            <a href="{{ route('admin.sitesettings.index') }}" class="nav-link active">
                                <i class="fas fa-newspaper"></i>
                                <p>
                                    Sitesetting
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_ads')
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.index') }}" class="nav-link active">
                                <i class="fas fa-ad"></i>
                                <p>
                                    Ads
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('hasPermission','view_comments')
                        <li class="nav-item">
                            <a href="{{ route('admin.comments.index') }}" class="nav-link active">
                                <i class="fas fa-comments"></i>
                                <p>
                                    Comments
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_categories')
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                                <i class="fas fa-list"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_sections')
                        <li class="nav-item">
                            <a href="{{ route('admin.sections.index') }}" class="nav-link active">
                                <i class="fas fa-list"></i>
                                <p>
                                    Section
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_displays')
                        <li class="nav-item">
                            <a href="{{ route('admin.displays.index') }}" class="nav-link active">
                                <i class="fas fa-tv"></i>
                                <p>
                                    Displays
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('hasPermission','view_videos')
                        <li class="nav-item">
                            <a href="{{ route('admin.videos.index') }}" class="nav-link active">
                                <i class="fas fa-photo-video"></i>
                                <p>
                                    Videos
                                </p>
                            </a>
                        </li>
                        @endcan

                        @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                        <li class="nav-item menu-close">
                            <a href="/home" class="nav-link active">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('hasPermission', 'view_users')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link active">
                                            <i class="fas fa-users"></i>
                                            <p>Users</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('hasPermission', 'view_roles')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.roles.index') }}" class="nav-link active">
                                            <i class="fas fa-user-tag"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('hasPermission', 'view_permissions')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.permissions.index') }}" class="nav-link active">
                                            <i class="fas fa-user-shield"></i>
                                            <p>Permissions</p>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ route('admin.sitesettings.index') }}" class="nav-link active">
                                        <i class="fas fa-user-shield"></i>
                                        <p>Site Setting</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @can('hasPermission','view_history')
                        <li class="nav-item menu-close">
                            <a href="/home" class="nav-link active">
                                <i class="fas fa-history"></i>
                                <p>
                                    History
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.application-history') }}" class="nav-link active">
                                        <p>Application History</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.system-history') }}" class="nav-link active">

                                        <p>System History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan


                        <li class="nav-item menu-open">
                            <a href="/home" class="nav-link active">
                                <i class="far fa-user-circle"></i>
                                <p>
                                    {{ Auth::user()->name }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.index') }}" class="nav-link active">
                                        <i class="fas fa-user-circle"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        @include('includes.footer')
    </div>
    <!-- ./wrapper -->

    @include('includes.scripts')
    @include('includes.toasts')
</body>

</html>
