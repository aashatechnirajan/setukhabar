@extends('admin.layouts.master')


@section('content')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $page_title }}</h1>
        <a href="{{ url('admin') }}"><button class="btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                Back</button></a>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->

<form id="quickForm" method="POST" action="{{ route('admin.favicons.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div>

            <div class="form-group">
                <label for="favicon_thirtyTwo">Favicon 32* 32</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="favicon_thirtyTwo" class="form-control" id="favicon_thirtyTwo"
                    required>
            </div>
            <img id="favicon_thirtyTwo" style="max-width: 500px; max-height:500px" />

            <div class="form-group">
                <label for="favicon_sixteen">Favicon 16*16</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="favicon_sixteen" class="form-control" id="favicon_sixteen"
                   required>
            </div>
            <img id="favicon_sixteen" style="max-width: 500px; max-height:500px" />

            <div class="form-group">
                <label for="apple_touch_icon"> apple_touch_icon</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="apple_touch_icon" class="form-control" id="apple_touch_icon"
                    required>
            </div>
            <img id="apple_touch_icon" style="max-width: 500px; max-height:500px" />

            <div class="form-group">

                <label for="file">Site manifest</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="file" class="form-control" id="pdf" placeholder="file" required>

        </div>






        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn-primary">Submit</button>
    </div>
</form>

<script>
    const previewImage = (event, previewId) => {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = () => {
        const preview = document.getElementById(previewId);
        preview.src = reader.result;
      };
    };
</script>










@stop
