@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('admin.includes.modals')
    @include('admin.includes.editmodal')
    <hr>
    <div class="topbar" style="display: flex;">
        <a href="{{ route('admin.videos.create') }}" style="text-decoration:none;width:auto;padding:5px;"><button
                type="button" class="btn btn-block btn-success btn-lg" style="width:auto;">Add Videos <i
                    class="fas fa-file"></i>
            </button>
        </a>

    </div>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Videos</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">
            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>URL</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $video->title ?? '' }}</td>
                            <td>{{ $video->slug ?? '' }}</td>
                            <td>{{ $video->url ?? '' }}</td>
                            <td><img src="{{ url('storage/' . $video->image) ?? '' }}" id="preview"
                                style="max-width: 150px; max-height:150px" /></td>

                            <td>
                                <button type="button" class="btn-warning btn-sm"
                                data-toggle="modal" data-target="#modal-edit" style="width:auto;"
                                onclick="updateEditModal(<?php echo $video->id; ?>)">Edit</button>

                            <button type="button" class=" btn-danger btn-sm"
                                data-toggle="modal" data-target="#modal-default" style="width:auto;"
                                onclick="replaceLinkFunction(<?php echo $video->id; ?>)">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $videos->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/videos/delete/".concat(id));
        }

        function updateEditModal(id) {
            document.getElementById('edit_button').setAttribute("href", "/admin/videos/edit/".concat(id));
        }
    </script>
@endsection
