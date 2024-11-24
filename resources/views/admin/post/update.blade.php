@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
@include('includes.forms')
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

    <form id="quickForm"  method="POST" action="{{ route('admin.posts.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" value="{{ $post->title ?? '' }}" name="title" class="form-control" id="title" placeholder="Title" required>
            </div>
            <div>
                <label for="registration_date">Description</label><span style="color:red; font-size:large">
                    *</span>
                <textarea style="max-width: 30%;" type="text" class="form-control" name="description" id="description" placeholder="Add Description" required>{!! $post->description ?? '' !!}</textarea>
            </div>
            <div class="form-group">
                <label for="address">Tags</label><span style="color:red; font-size:large"> </span>
                <input type="text" name="tags" value="{{ $post->tags ?? '' }}" class="form-control" id="address" placeholder="Tags">
            </div>
            <div class="form-group">
                <label for="taxpayer_name">Content</label><span style="color:red; font-size:large"> *</span>


                <textarea style="max-width: 100%;min-height: 250px;" type="text" class="form-control" id="myTextarea"
                name="content" placeholder="Add Description">{!! $post->content ?? '' !!}</textarea>
                {{-- <textarea type="text" name="content" class="form-control" id="content" placeholder="Content" rows="10" cols="50">{!! $post->content ?? '' !!}</textarea> --}}
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Images <span style="color:red;"></span></label>
                <span style="color:red; font-size:large"> *</span>

                <input type="file" name="image[]" id="" class="form-control" multiple onchange="previewImages(event)">
                
                {{-- @foreach ($post->image as $image )
                    <img src="{{ $image }}" alt="Post Image">
                @endforeach --}}


            {{-- @foreach ($post->image as $uploadedImage)
                <div class="col-md-2 mb-3 image-preview">
                    <img src="{{ $uploadedImage }}" alt="Image Preview" class="img-fluid">
                    <span class="remove-image" onclick="removePreview(this)">Remove</span>
                </div>
            @endforeach --}}


                {{-- <div id="imagePreviews" class="row">
                    @foreach ($post->image as $image)
                        <div class="col-md-2 mb-3 image-preview">
                            <img src="{{ $image }}" alt="Image Preview" class="img-fluid">
                            <span class="remove-image" onclick="removePreview(this)">Remove</span>
                        </div>
                    @endforeach
                </div> --}}

                


            </div>

            <div id="imagePreviews" class="row">
                @foreach (old('image', []) as $uploadedImage)
                <div class="col-md-2 mb-3 image-preview">
                    <img src="{{ $uploadedImage }}" alt="Image Preview" class="img-fluid">
                    <span class="remove-image" onclick="removePreview(this)">Remove</span>
                </div>
            @endforeach
            </div>


            {{-- <img src="{{ url('storage/'.$post->image) ?? '' }}" id="preview" style="max-width: 500px; max-height:500px" /> --}}



            <div class="form-group">
                <label for="reporter">Reporter Name</label>
                <input style="width:auto;" type="text" value="{{ $post->reporter_name ?? '' }}" name="reporter_name" class="form-control" id="reporter" placeholder="Reporter Name">
            </div>


            <div style="display: flex;">
                <div class="form-group" style="margin: auto;">
                    <label>Sections</label>
                    @foreach ($sections as $section)
                    <div class="form-check checkbox1">
                        <input class="form-check-input" name="sections[]" value="{{ $section->id }}" type="checkbox" @if ($post->getSections->contains($section->id))
                        checked
                        @endif >
                        <label class="form-check-label">{{ $section->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group" style="margin: auto;">
                    <label>Categories</label>
                    @foreach ($categories as $category)
                    <div class="form-check checkbox2">
                        <input class="form-check-input" name="categories[]" value="{{ $category->id }}" type="checkbox" @if ($post->getCategories->contains($category->id))
                        checked
                        @endif>
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
            images_upload_url: '/storage/uploads/tiny/',
            file_picker_types: 'image',
file_picker_callback: function(callback, value, meta) {
    if (meta.filetype === 'image') {
        // Open a file upload dialog
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];

            // Upload the image file to the server
            var formData = new FormData();
            formData.append('image', file);

            // Make an AJAX request to upload the image
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/uploadImage', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var imageUrl = xhr.responseText;

                    // Pass the image URL to the callback function
                    callback(imageUrl, { alt: file.name });
                } else {
                    console.error('Image upload failed.');
                }
            };
            xhr.send(formData);
        };
        input.click();
    }
}



    });


    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'

</script>



</div>

@endsection
