@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Displays</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.comments.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $comment->id ?? '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="">Post Title</label>
                <input class="form-control" type="text" value="{{ Str::substr($post->title, 0, 200) ?? '' }}" disabled>
            </div>
            <div class="form-group">
                <label for="">Name </label>
                <input type="text" value="{{ $comment->name }}" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Comment</label>
                <input type="text" value="{{ $comment->comment ?? '' }}" name="comment" class="form-control"
                    id="exampleInputName" placeholder="Comment" required>
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input class="form-control"  type="file" onchange="previewImage(event)" placeholder="Image" name="image"
                    required>
            </div>
            <img src="{{ url('storage/'.$comment->image) ?? '' }}" id="preview" style="max-width: 500px; max-height:500px" />

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Comment</button>
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
