@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Add Videos</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Description" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="slug" class="form-control" placeholder="Slug" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" name="url" class="form-control" placeholder="URL" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" placeholder="Image" required>
            </div>
            <img id="preview" style="max-width: 500px; max-height:500px" />

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Video</button>
        </div>
    </form>
    </div>
    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>

@endsection
