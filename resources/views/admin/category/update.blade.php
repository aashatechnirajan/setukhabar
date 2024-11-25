@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Update Categories</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.categories.update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $category->id ?? '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" value="{{ $category->title ?? '' }}" name="title" class="form-control" id="exampleInputName" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text"  value="{{ $category->slug ?? '' }}" name="slug" class="form-control" id="exampleInputName" placeholder="Slug" required>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
    </form>
    </div>

@endsection
