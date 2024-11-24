@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Add Ads</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.ads.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" name="url" class="form-control" placeholder="URL" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" placeholder="Image"
                    >
            </div>
            <img id="preview" style="max-width: 500px; max-height:500px" />

            <div class="form-group">
                <label>Displays</label>
                <div class="select2-purple" data-select2-id="38">
                    <select class="select2 select2-hidden-accessible" multiple="" id="permissions" name="displays[]"
                        data-placeholder="Choose Displays" data-dropdown-css-class="select2-purple" style="width: 100%;"
                        data-select2-id="15" tabindex="-1" aria-hidden="true" >
                        @foreach ($displays as $display)
                            <option value="{{ $display->id }}">{{ $display->title ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Ad</button>
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
            $('.select2').select2()

            // $('#quickForm').validate({
            //     rules: {
            //         name: {
            //             required: true,
            //         },
            //         permissions: {
            //             required: true,
            //         }
            //     },
            //     messages: {
            //         name: {
            //             required: "Please provide a name of role",
            //         },
            //         permissions:{
            //             required: "Choose at lease one permission",
            //         }
            //     },
            //     errorElement: 'span',
            //     errorPlacement: function(error, element) {
            //         error.addClass('invalid-feedback');
            //         element.closest('.form-group').append(error);
            //     },
            //     highlight: function(element, errorClass, validClass) {
            //         $(element).addClass('is-invalid');
            //     },
            //     unhighlight: function(element, errorClass, validClass) {
            //         $(element).removeClass('is-invalid');
            //     }
            // });
        });

        // function replaceFunction(val) {
        //     document.getElementById('exampleInputName').value=val.replace(' ', '-');
        // }
    </script>
@endsection
