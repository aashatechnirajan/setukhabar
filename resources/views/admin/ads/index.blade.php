@extends('admin.layouts.master')

<!-- Main content -->
@section('content')

@if (session('successMessage'))
<div class="alert alert-success">
    {!! session('successMessage') !!}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {!! session('error') !!}
</div>
@endif

    @include('includes.tables')
    @include('admin.includes.modals')
    @include('admin.includes.editmodal')
    <div class="topbar" style="display: flex;">
        <a href="{{ route('admin.ads.create') }}" style="text-decoration:none;width:auto;padding:5px;"><button
                type="button" class="btn btn-block btn-success btn-lg" style="width:auto;">Add Ads <i
                    class="fas fa-file"></i>
            </button>
        </a>

    </div>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ads</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $ad->id ?? '' }}</td>
                            <td>{{ $ad->title ?? '' }}</td>
                            <td>{{ $ad->url ?? '' }}</td>
                            <td><img src="{{ asset('uploads/images/ads/' . $ad->image) ?? '' }}" id="preview"
                                    style="max-width: 150px; max-height:150px" /></td>
                            <td>
                                <button type="button" class="btn-warning btn-sm"
                                                    data-toggle="modal" data-target="#modal-edit" style="width:auto;"
                                                    onclick="updateEditModal(<?php echo $ad->id; ?>)">Edit</button>

                                                <button type="button" class=" btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#modal-default" style="width:auto;"
                                                    onclick="replaceLinkFunction(<?php echo $ad->id; ?>)">Delete</button>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-footer -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $ads->links() }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/ads/delete/".concat(id));
        }

        function updateEditModal(id) {
            document.getElementById('edit_button').setAttribute("href", "/admin/ads/edit/".concat(id));
        }

    </script>
@endsection
