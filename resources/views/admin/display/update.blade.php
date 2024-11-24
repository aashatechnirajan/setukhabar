@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Displays</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.displays.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $display->id ?? '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" value="{{ $display->title ?? '' }}" name="title" class="form-control" id="exampleInputName" placeholder="Title" required>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Display</button>
        </div>
    </form>
    </div>

@endsection
