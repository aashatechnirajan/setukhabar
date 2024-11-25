@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Sections</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.sections.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $section->id ?? '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $section->title ?? '' }}"  placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $section->slug ?? '' }}"  placeholder="Slug" required>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Section</button>
        </div>
    </form>
    </div>

@endsection
