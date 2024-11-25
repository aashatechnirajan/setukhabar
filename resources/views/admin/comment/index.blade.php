@extends('admin.layouts.master')

<!-- Main content -->
@section('content')

@if (session('successMessage'))
<div class="alert alert-success">
    {!! session('successMessage') !!}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {!! session('error') !!}
</div>
@endif

    @include('includes.tables')
    @include('admin.includes.modals')
    <hr>
    <a href="{{ route('admin.comments.create') }}" style="text-decoration:none;"><button type="button"
            class="btn btn-block btn-success btn-lg" style="width:auto;">Add Comment <i class="fas fa-user-plus"></i>
        </button>
    </a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Comments</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Post Title
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Comment
                                    </th>
                                    <th class="non-sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                    @foreach ($comments as $comment)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ Str::substr($comment->getPost->title, 0, 200) ?? '' }}</td>
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $comment->comment ?? '' }}</td>


                                            <td><a href="/admin/comments/edit/{{ $comment->id }}">
                                                    <div style="display: flex; flex-direction:row;">
                                                        <button type="button"
                                                            class="btn btn-block btn-warning btn-sm">Edit</button>
                                                </a>
                                                <button type="button" class="btn btn-block btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#modal-default" style="width:auto;"
                                                    onclick="replaceLinkFunction(<?php echo $comment->id; ?>)">Delete</button>
                                            </td>
                    </div>

                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/comments/delete/".concat(id));
        }
        $(function() {
            $.noConflict();
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
@endsection
