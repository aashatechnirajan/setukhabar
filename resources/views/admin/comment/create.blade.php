@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Add Comments</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.comments.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1"> Post Title</label>
                <select name="post_id" class="form-control" required>
                    @foreach ($posts as $post)
                        <option value="{{ $post->id }}">{{ Str::substr($post->title ?? '', 0, 200) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Name </label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Comment</label>
                <textarea name="comment" class="form-control" id="" cols="30" rows="10" placeholder="Comment Here"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input class="form-control" type="file" onchange="previewImage(event)" placeholder="Image" name="image"
                    required>
            </div>
            <img id="preview" style="max-width: 500px; max-height:500px" />

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>
    </form>
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
    </div>

@endsection
