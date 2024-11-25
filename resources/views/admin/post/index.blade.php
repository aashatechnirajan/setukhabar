@extends('admin.layouts.master')

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
<hr>
<div class="topbar" style="display: flex;">
    <a href="{{ route('admin.posts.create') }}" style="text-decoration:none;width:auto;padding:5px;">
        <button type="button" class="btn btn-block btn-success btn-lg" style="width:auto;">
            Add Posts <i class="fas fa-file"></i>
        </button>
    </a>
</div>
<hr>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Posts</h3>
    </div>
    <!-- ./card-header -->
    <div class="card-body">
        <hr>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{ $post->id ?? '' }}</td>
                        <td>{{ $post->title ?? '' }}</td>
                        <td>
                            @foreach ($post->getCategories as $category)
                                <ul style="display: inline-block">{{ $category->title . ' | ' }}</ul>
                            @endforeach
                        </td>
                        <td>
                            @if ($post->image)
                                @foreach (json_decode($post->image, true) as $image)
                                    <a href="{{ asset($image) }}" class="venobox" style="margin-right: 10px;">
                                        <img src="{{ asset($image) }}" alt="Post Image" style="width: 150px; height: 150px;">
                                    </a>
                                @endforeach
                            @else
                                <p>No Image</p>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('Y-m-d') ?? '' }}</td>
                        <td>
                            <button type="button" class="btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit"
                                style="width:auto;" onclick="updateEditModal({{ $post->id }})">Edit</button>

                            <button type="button" class="btn-danger btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="width:auto;" onclick="replaceLinkFunction({{ $post->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination m-1 float-right">
            <li class="page-item">{{ $posts->links() ?? '' }}</li>
        </ul>
    </div>
</div>

<!-- Page specific script -->
<script>
    function replaceLinkFunction(id) {
        document.getElementById('confirm_button').setAttribute("href", "/admin/posts/delete/" + id);
    }

    function updateEditModal(id) {
        document.getElementById('edit_button').setAttribute("href", "/admin/posts/edit/" + id);
    }
</script>
@endsection
