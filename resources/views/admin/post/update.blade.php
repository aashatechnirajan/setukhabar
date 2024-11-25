@extends('admin.layouts.master')


@section('content')
@include('includes.forms')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Update Post</h1>
        <a style="float: right;" href="/admin/posts/index"><button class="btn btn-success"><i class="fas fa-backward"></i>
                Back</button></a>
    </div>


    @if(session('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
    @endif


    <form id="quickForm" method="POST" action="{{ route('admin.posts.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" value="{{ $post->title ?? '' }}" name="title" class="form-control" id="title" placeholder="Title" required>
            </div>
           
            <div>
                <label for="registration_date">Description</label><span style="color:red; font-size:large"> *</span>
                <textarea style="max-width: 30%;" type="text" class="form-control" name="description" id="description" placeholder="Add Description" required>{!! $post->description ?? '' !!}</textarea>
            </div>
           
            <div class="form-group">
                <label for="address">Tags</label><span style="color:red; font-size:large"> </span>
                <input type="text" name="tags" value="{{ $post->tags ?? '' }}" class="form-control" id="address" placeholder="Tags">
            </div>
           
            <div class="form-group">
                <label for="taxpayer_name">Content</label><span style="color:red; font-size:large"> *</span>
                <textarea style="max-width: 100%;min-height: 250px;" type="text" class="form-control" id="myTextarea" name="content" placeholder="Add Description">{!! $post->content ?? '' !!}</textarea>
            </div>


            <!-- Current Images Display -->
            <div class="form-group">
                <label>Current Images</label>
                <div id="currentImages" class="row mb-3">
                    @if($post->image)
                        @foreach(json_decode($post->image) as $index => $image)
                        <div class="col-md-2 mb-3 current-image">
                            <div class="position-relative">
                                <img src="{{ asset($image) }}" class="img-fluid rounded" alt="Current Image">
                                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                               
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>


            <!-- New Image Upload -->
            <div class="form-group">
                <label for="exampleInputEmail1">Upload New Images</label>
                <span style="color:red; font-size:large"> *</span>
                <input type="file" name="image[]" id="imageInput" class="form-control" multiple accept="image/*" onchange="previewImages(event)">
            </div>


            <!-- New Image Previews -->
            <div id="imagePreviews" class="row"></div>


            <div class="form-group">
                <label for="reporter">Reporter Name</label>
                <input style="width:auto;" type="text" value="{{ $post->reporter_name ?? '' }}" name="reporter_name" class="form-control" id="reporter" placeholder="Reporter Name">
            </div>


            <div style="display: flex;">
                <div class="form-group" style="margin: auto;">
                    <label>Sections</label>
                    @foreach ($sections as $section)
                    <div class="form-check checkbox1">
                        <input class="form-check-input" name="sections[]" value="{{ $section->id }}" type="checkbox"
                            @if ($post->getSections->contains($section->id)) checked @endif>
                        <label class="form-check-label">{{ $section->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>
               
                <div class="form-group" style="margin: auto;">
                    <label>Categories</label>
                    @foreach ($categories as $category)
                    <div class="form-check checkbox2">
                        <input class="form-check-input" name="categories[]" value="{{ $category->id }}" type="checkbox"
                            @if ($post->getCategories->contains($category->id)) checked @endif>
                        <label class="form-check-label">{{ $category->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


    <style>
        .current-image img, .preview-image img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }
        .position-relative {
            position: relative;
        }
        .position-absolute {
            position: absolute;
        }
    </style>


    <script>
        // Function to preview new images
        const previewImages = (e) => {
            const files = e.target.files;
            const imagePreviews = document.getElementById('imagePreviews');
            imagePreviews.innerHTML = ''; // Clear existing previews


            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
               
                reader.onload = function(event) {
                    const preview = document.createElement('div');
                    preview.className = 'col-md-2 mb-3 preview-image';
                    preview.innerHTML = `
                        <div class="position-relative">
                            <img src="${event.target.result}" class="img-fluid rounded" alt="Preview">
                            <button type="button" class="btn btn-danger btn-sm position-absolute"
                                    style="top: 5px; right: 5px;"
                                    onclick="removeNewImage(this, ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    imagePreviews.appendChild(preview);
                };


                reader.readAsDataURL(file);
            });
        };


        // Function to remove current image
        const removeCurrentImage = (button, index) => {
            const container = button.closest('.current-image');
            container.remove();
           
            // You might want to add a hidden input to track deleted images
            const form = document.getElementById('quickForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'removed_images[]';
            input.value = index;
            form.appendChild(input);
        };


        // Function to remove new image preview
        const removeNewImage = (button, index) => {
            const container = button.closest('.preview-image');
            container.remove();
           
            // Update the file input
            const fileInput = document.getElementById('imageInput');
            const dt = new DataTransfer();
            const { files } = fileInput;
           
            for(let i = 0; i < files.length; i++) {
                if(i !== index) {
                    dt.items.add(files[i]);
                }
            }
           
            fileInput.files = dt.files;
        };


        // Initialize TinyMCE
        tinymce.init({
            selector: "#myTextarea",
            height: 400,
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/storage/uploads/tiny/',
            file_picker_types: 'image',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                   
                    input.onchange = function() {
                        const file = this.files[0];
                        const formData = new FormData();
                        formData.append('image', file);


                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '/uploadImage', true);
                       
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                const imageUrl = xhr.responseText;
                                callback(imageUrl, { alt: file.name });
                            } else {
                                console.error('Image upload failed.');
                            }
                        };
                       
                        xhr.send(formData);
                    };
                   
                    input.click();
                }
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });


        // Initialize ClassicEditor for content if needed
        ClassicEditor.create(document.querySelector('#content')).catch(error => {
            console.error(error);
        });
    </script>
</div>
@endsection

