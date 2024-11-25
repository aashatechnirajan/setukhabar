@extends('admin.layouts.master')


<!-- Main content -->
@section('content')
@include('includes.forms')
@include('admin.includes.modals')


<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Update Site Settings</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.sitesettings.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label for="exampleInputEmail1">App Name</label>
                    <input type="text" name="title" value="{{ $sitesetting->title ?? '' }}" class="form-control"
                        placeholder="Website Name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="location" value="{{ $sitesetting->location ?? '' }}" class="form-control"
                        placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" value="{{ $sitesetting->email ?? '' }}" class="form-control"
                        placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="number" name="phone" value="{{ $sitesetting->phone ?? '' }}" class="form-control"
                        placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Facebook URL</label>
                    <input type="url" name="facebook" value="{{ $sitesetting->facebook ?? '' }}" class="form-control"
                        placeholder="Facebook URL (https://)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Twitter URL</label>
                    <input type="url" name="twitter" value="{{ $sitesetting->twitter ?? '' }}" class="form-control"
                        placeholder="Twitter URL (https://)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">LinkedIN URL</label>
                    <input type="url" name="linkedin" value="{{ $sitesetting->linkedin ?? '' }}" class="form-control"
                        placeholder="LinkedIN URL (https://)">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pinterest URL</label>
                    <input type="url" name="pinterest" value="{{ $sitesetting->pinterest ?? '' }}" class="form-control"
                        placeholder="Pinterest URL (https://)">
                </div>


                <div class="form-group">
                    <label for="main_logo">Main Logo</label><span style="color:red; font-size:large"> *</span>
                   
                    @if(isset($sitesetting) && $sitesetting->main_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->main_logo)))
                        <div class="mb-3">
                            <label class="form-label">Current Logo:</label>
                            <div>
                                <img src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}"
                                     alt="Current Main Logo"
                                     style="max-width: 200px; max-height: 200px; object-fit: contain;"
                                     class="img-thumbnail">
                            </div>
                        </div>
                    @endif


                    <div class="input-group">
                        <input type="file"
                               name="main_logo"
                               class="form-control @error('main_logo') is-invalid @enderror"
                               id="main_logo_input"
                               onchange="previewImage(event)">
                    </div>
                   
                    @error('main_logo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <div class="mt-2">
                        <img id="image_preview"
                             src="#"
                             alt="Preview"
                             style="max-width: 200px; max-height: 200px; display: none;"
                             class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>
</div>
@endsection
<script>
    const previewImage = (event, previewId) => {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = () => {
        const preview = document.getElementById(previewId);
        preview.src = reader.result;
        preview.style.display = "block"; // Show the image
      };
    };


    // Function to retrieve and display the previously stored image
    const displayStoredImage = (imageUrl, previewId) => {
      const preview = document.getElementById(previewId);
      preview.src = imageUrl;
      preview.style.display = "block"; // Show the image
    };


    // Example usage:
    // Assuming you have the URL of the previously stored image,
    // call the displayStoredImage function for each preview image
    const mainLogoUrl = "{{ asset('uploads/sitesetting/main_logo.png') }}";
    const sideLogoUrl = "{{ asset('uploads/sitesetting/side_logo.png') }}";
    const flagLogoUrl = "{{ asset('uploads/sitesetting/nepal_flag.gif') }}";
    displayStoredImage(mainLogoUrl, "main_logo_preview");
    displayStoredImage(sideLogoUrl, "side_logo_preview");
    displayStoredImage(flagLogoUrl, "flag_logo_preview");


  </script>



