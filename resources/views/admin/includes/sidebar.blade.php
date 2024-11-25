<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
      if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
      }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href="index.html">
            <div class="d-flex align-items-center py-3"><img class="me-2"
                    src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="40"><span class="font-sans-serif">falcon</span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">


                    <a class="nav-link" href="{{ route('dashboard') }}">

                        <div class="d-flex align-items-center">


                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a><!-- more inner pages-->



                    <ul class="nav collapse show" id="dashboard">

                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('admin.sitesettings.index') }}">

                                <div class="d-flex align-items-center">

                                    <i class="fas fa-cog"></i>
                                    <span class="nav-link-text ps-1">Sitesetting

                                    </span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>



                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.favicons.index') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fab fa-fonticons"></i>
                                    <span class="nav-link-text ps-1">Favicon</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>


                    </ul>
                </li>

                {{-- sknxsanksanxkasnxknsakxnasknxsaskjndksjn --}}
                <li class="nav-item">
                    <!-- label-->

                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">App</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <!-- parent pages-->



                    @can('hasPermission', 'view_posts')

                    <a class="nav-link" href="{{ route('admin.posts.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-plus-circle"></i>
                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span>
                            <span class="nav-link-text ps-1">Posts</span>
                        </div>
                    </a>
                    @endcan

                    <!-- parent pages-->
                    @can('hasPermission','view_ads')
                    <a class="nav-link" href="{{ route('admin.ads.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fab fa-ioxhost"></i>

                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span>
                            <span class="nav-link-text ps-1">Ads</span>
                        </div>
                    </a>
                    @endcan
                    <!-- parent pages-->
                    @can('hasPermission','view_categories')
                    <a class="nav-link" href="{{ route('admin.categories.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-pen-square"></i>
                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span>
                            <span class="nav-link-text ps-1">Categories</span>
                        </div>
                    </a>
                    @endcan

                    <!-- parent pages-->
                    @can('hasPermission','view_sections')
                    <a class="nav-link" href="{{ route('admin.sections.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-shapes"></i>
                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span>
                            <span class="nav-link-text ps-1">Section</span>
                        </div>
                    </a>
                    @endcan


                    <!-- parent pages-->
                    @can('hasPermission','view_displays')
                    <a class="nav-link" href="{{ route('admin.displays.index') }}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-calendar-alt"></i>
                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com -->
                            </span>
                            <span class="nav-link-text ps-1">Displays</span>
                        </div>
                    </a>
                    @endcan


                    <!-- parent pages-->
                    @can('hasPermission','view_videos')
                    <a class="nav-link" href="{{ route('admin.videos.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-play"></i>
                                <!-- <span class="fas fa-calendar-alt"></span> Font Awesome fontawesome.com --></span>
                            <span class="nav-link-text ps-1">Videos</span>
                        </div>
                    </a>
                    @endcan

                    @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                    <a class="nav-link dropdown-indicator" href="#email" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="email">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-envelope"></i>
                            </span><span class="nav-link-text ps-1">Management</span>
                        </div>
                    </a>
                    @can('hasPermission', 'view_users')
                    <ul class="nav collapse" id="email">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Users</span>
                                </div>
                            </a>

                            <!-- more inner pages-->
                        </li>
                        @endcan
                        @can('hasPermission', 'view_roles')
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Roles</span>
                                </div>
                            </a>

                            <!-- more inner pages-->
                        </li>
                        @endcan

                        @can('hasPermission', 'view_permissions')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                                <div class="d-flex align-items-center"><span
                                        class="nav-link-text ps-1">Permission</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        @endcan
                    </ul>
                    @endif


                    <!-- parent pages-->
                    @can('hasPermission','view_history')
                    <a class="nav-link dropdown-indicator" href="#user" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="user">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-user"></i>
                            </span><span class="nav-link-text ps-1">History</span></div>
                    </a>


                    <ul class="nav collapse" id="user">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.application-history') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Application
                                        History</span></div>
                            </a><!-- more inner pages-->
                        </li>


                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.system-history') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">System
                                        History</span></div>
                            </a><!-- more inner pages-->
                        </li>
                    </ul>
                    @endcan

                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#customization" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="customization">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-wrench"></i>
                            </span><span class="nav-link-text ps-1"> {{ Auth::user()->name }}</span></div>
                    </a>
                    <ul class="nav collapse" id="customization">
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Profile</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>

                    </ul><!-- parent pages-->

        </div>
    </div>
</nav>
