@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Ads</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.ads.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <input type="hidden" name="id" value="{{ $ad->id ?? '' }}">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" value="{{ $ad->title ?? '' }}" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" value="{{ $ad->url ?? '' }}" name="url" class="form-control" placeholder="URL" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file"  name="image" class="form-control" onchange="previewImage(event)" placeholder="Image" required>
            </div>
            <img src="{{ asset('uploads/images/ads/'.$ad->image) ?? '' }}" id="preview" style="max-width: 500px; max-height:500px" />



            <div class="form-group">
                <label>Displays</label>
                <div class="select2-purple" data-select2-id="38">
                    <select class="select2 select2-hidden-accessible" multiple="" id="permissions" name="displays[]"
                        data-placeholder="Choose Displays" data-dropdown-css-class="select2-purple" style="width: 100%;"
                        data-select2-id="15" tabindex="-1" aria-hidden="true" required>
                        @foreach ($displays as $display)
                            <option value="{{ $display->id }}" @if ($ad->getDisplays->contains($display->id))
                                selected
                            @endif>{{ $display->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Ad</button>
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
    <script>
        $(function() {
            $.noConflict();
            //Initialize Select2 Elements
            $('.select2').select2();
        });


    </script>
@endsection
