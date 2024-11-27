@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
@include('includes.forms')
<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Add Post</h1>
        <a style="float: right;" href="/admin/posts/index"><button class="btn btn-success"><i
                    class="fas fa-backward"></i>
                Back</button></a>
    </div>


    @if(session('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
@endif

    @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <form id="quickForm" method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="title" class="form-control" id="title" placeholder="Title"
                    value="{{ old('title') }}" required>
            </div>
            <div>
                <label for="registration_date">Description</label><span style="color:red; font-size:large">
                    *</span>
                <textarea style="max-width: 30%;" type="text" class="form-control" name="description" id="description"
                    placeholder="Add Description" value="{{ old('description') }}" required></textarea>
            </div>
            <div class="form-group">
                <label for="address">Tags</label><span style="color:red; font-size:large"> </span>
                <input type="text" name="tags" class="form-control" id="address" placeholder="Tags" value="{{ old('tags') }}">
            </div>


            <div>



                <label for="content">Content</label><span style="color:red; font-size:large">
                    *</span>
                <textarea style="max-width: 100%;min-height: 250px;" type="text" class="form-control" id="myTextarea"
                    name="content" placeholder="Add Description">
                {{ old('content') }}
                </textarea>

            </div>


            <div class="form-group">
                <label for="exampleInputEmail1"> Images <span style="color:red;"></span></label>
                <span style="color:red; font-size:large"> *</span>
                <input type="file" name="image[]" id="" class="form-control" multiple onchange="previewImages(event)">
            </div>
            <div id="imagePreviews" class="row">
                @if (!empty($images))
                    @foreach ($images as $image)
                        <div class="col-md-2 mb-3 image-preview">
                            <img src="{{ asset('uploads/post/' . $image) }}" alt="Image Preview" class="img-fluid">
                            <span class="remove-image" onclick="removePreview(this)">Remove</span>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label for="reporter">Reporter</label>
                <input type="text" name="reporter_name" class="form-control" id="reporter" placeholder="Reporter Name" value="{{ old('reporter_name') }}">
            </div>


            <div style="display: flex;">
                <div class="form-group" style="margin: auto;">
                    <label>Sections</label>
                    @foreach ($sections as $section)
                    <div class="form-check checkbox1">
                        <input class="form-check-input" name="sections[]" value="{{ $section->id }}" type="checkbox"
                        {{ in_array($section->id, old('sections', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $section->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group" style="margin: auto;">
                    <label>Categories</label>
                    @foreach ($categories as $category)
                    <div class="form-check checkbox2">
                        <input class="form-check-input" name="categories[]" value="{{ $category->id }}" type="checkbox"
                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $category->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>
            </div>



        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    </form>

    <script>
        // ClassicEditor.create(document.querySelector('#description'));
        // // .then(editor => {
        // //    window.editor = editor;
        // // })
        // // .catch(error => {
        // //     console.error(error);
        // // });

        ClassicEditor.create(document.querySelector('#content'));
        // .then(editor => {
        //   window.editor = editor;
        // })
        // .catch(error => {
        //     console.error(error);
        // });
    </script>
    <script>
        const previewImages = e => {
        const files = e.target.files;
        const imagePreviews = document.getElementById('imagePreviews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (const file of files) {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = () => {
                const preview = document.createElement('div');
                preview.className = 'col-md-2 mb-3';
                preview.innerHTML = `<img src="${reader.result}" alt="Image Preview" class="img-fluid">`;
                imagePreviews.appendChild(preview);
            };
        }
    };


    </script>



    <script>
        tinymce.init({
        selector:"#myTextarea",
        height: 400,
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',

        menubar:'file edit view insert format tools table help',
        toollbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',

        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval:'30s',
        autosave_prefix:'{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,


    image_title: true,
                automatic_uploads: true,
                images_upload_url: '{{ route("admin.posts.upload-image") }}',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];
                        var formData = new FormData();
                        formData.append('file', file);

                        fetch('{{ route("admin.posts.upload-image") }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            callback(data.location, { alt: file.name });
                        })
                        .catch(error => {
                            console.error('Image upload failed:', error);
                        });
                    };
                    input.click();
                }
            }
        });
    </script>
@endsection
