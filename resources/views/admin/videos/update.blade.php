@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Video</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.videos.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $video->id ?? '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $video->title ?? '' }}" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input type="text" name="description" class="form-control" value="{{ $video->description ?? '' }}" placeholder="Description" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $video->slug ?? '' }}" placeholder="Slug" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" name="url" class="form-control" value="{{ $video->url ?? '' }}" placeholder="URL" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" placeholder="Image" >
            </div>
            <img id="preview" src="{{ url('storage/'.$video->image) ?? '' }}" style="max-width: 500px; max-height:500px" />

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Video</button>
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
