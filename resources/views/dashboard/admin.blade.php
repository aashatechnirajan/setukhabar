@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @can('hasPermission', 'view_users')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ App\Models\User::count() }}</h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            @endcan
            @can('hasPermission', 'view_roles')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ App\Models\Role::count() }}</h3>

                            <p>Roles</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <a href="{{ route('admin.roles.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            @endcan
            @can('hasPermission', 'view_permissions')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ App\Models\Permission::count() }}</h3>

                            <p>Permissions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <a href="{{ route('admin.permissions.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            @endcan

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ App\Models\Post::count() }}</h3>

                        <p>Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <a href="{{ route('admin.permissions.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ App\Models\Ad::count() }}</h3>

                        <p>Ads</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ad"></i>
                    </div>
                    <a href="{{ route('admin.permissions.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ App\Models\Category::count() }}</h3>

                        <p>Category</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="{{ route('admin.categories.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- /.row (main row) -->
    </div>

    <style>
        .small-box {
    position: relative;
    display: block;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    margin-bottom: 20px;
    color: #fff;
    overflow: hidden;
}

.small-box .inner {
    padding: 10px;
}

.small-box h3 {
    font-size: 30px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
}

.small-box p {
    font-size: 14px;
}

.small-box .icon {
    position: absolute;
    top: -10px;
    right: 10px;
    z-index: 0;
    font-size: 90px;
    color: rgba(0, 0, 0, 0.15);
}

.small-box .icon > i {
    position: relative;
    top: 3px;
}

.small-box .small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    display: block;
    z-index: 10;
    text-decoration: none;
    font-weight: 600;
}

.small-box.bg-warning {
    background-color: #f39c12 !important;
}

.small-box.bg-info {
    background-color: #00c0ef !important;
}

.small-box.bg-success {
    background-color: #00a65a !important;
}

.small-box.bg-purple {
    background-color: #605ca8 !important;
}

.small-box.bg-purple .icon {
    color: rgba(255, 255, 255, 0.8);
}

.small-box.bg-purple .icon > i {
    color: rgba(255, 255, 255, 0.8);
}

.small-box.bg-purple .small-box-footer {
    color: rgba(255, 255, 255, 0.8);
}

.small-box.bg-success .icon {
    color: rgba(255, 255, 255, 0.8);
}

.small-box.bg-success .icon > i {
    color: rgba(255, 255, 255, 0.8);
}

.small-box.bg-success .small-box-footer {
    color: rgba(255, 255, 255, 0.8);
}

    </style>
@endsection
