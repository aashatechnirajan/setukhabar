@extends('admin.layouts.master')

@section('content')
@include('includes.forms')
@include('admin.includes.modals')

<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Update Site Settings</h1>
    </div>
    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.sitesettings.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label for="title">App Name</label>
                    <input type="text" name="title" value="{{ $sitesetting->title ?? '' }}" class="form-control"
                        placeholder="Website Name" required>
                </div>
                <div class="form-group">
                    <label for="location">Address</label>
                    <input type="text" name="location" value="{{ $sitesetting->location ?? '' }}" class="form-control"
                        placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $sitesetting->email ?? '' }}" class="form-control"
                        placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" name="phone" value="{{ $sitesetting->phone ?? '' }}" class="form-control"
                        placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook URL</label>
                    <input type="url" name="facebook" value="{{ $sitesetting->facebook ?? '' }}" class="form-control"
                        placeholder="Facebook URL (https://)">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter URL</label>
                    <input type="url" name="twitter" value="{{ $sitesetting->twitter ?? '' }}" class="form-control"
                        placeholder="Twitter URL (https://)">
                </div>
                <div class="form-group">
                    <label for="linkedin">LinkedIN URL</label>
                    <input type="url" name="linkedin" value="{{ $sitesetting->linkedin ?? '' }}" class="form-control"
                        placeholder="LinkedIN URL (https://)">
                </div>
                <div class="form-group">
                    <label for="pinterest">Pinterest URL</label>
                    <input type="url" name="pinterest" value="{{ $sitesetting->pinterest ?? '' }}" class="form-control"
                        placeholder="Pinterest URL (https://)">
                </div>

                <div class="form-group">
                    <label for="main_logo">Main Logo</label>
                    
                    @if(isset($sitesetting) && $sitesetting->main_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->main_logo)))
                        <div class="mb-3">
                            <label class="form-label">Current Logo:</label>
                            <div>
                                <img src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}" 
                                     alt="Current Main Logo"
                                     style="max-width: 200px; max-height: 200px; object-fit: contain;"
                                     class="img-thumbnail">
                            </div>
                            <input type="hidden" name="current_main_logo" value="{{ $sitesetting->main_logo }}">
                        </div>
                    @endif

                    <div class="input-group">
                        <input type="file" 
                               name="main_logo" 
                               class="form-control @error('main_logo') is-invalid @enderror" 
                               id="main_logo_input"
                               accept="image/*"
                               onchange="previewImage(event, 'image_preview')">
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
                    <small class="text-muted">Only upload a new image if you want to change the current logo.</small>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(event, previewId) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection