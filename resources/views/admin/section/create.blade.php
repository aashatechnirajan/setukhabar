@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card-header">
        <h1 class="card-title">Add Sections</h1>
    </div>


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.sections.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="text" name="slug" class="form-control" id="exampleInputName" placeholder="Slug" required>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Section</button>
        </div>
    </form>
    </div>

@endsection
