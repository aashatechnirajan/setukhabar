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
    @include('admin.includes.editmodal')
    <hr>
    <a href="{{ route('admin.displays.create') }}" style="text-decoration:none;"><button type="button"
            class="btn btn-block btn-success btn-lg" style="width:auto;">Add Display <i class="fas fa-user-plus"></i>

        </button>
    </a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Displays</h3>
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
                                        aria-label="Rendering engine: activate to sort column descending">ID
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Title
                                    </th>
                                    <th class="non-sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                    @foreach ($displays as $display)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $display->id ?? '' }}</td>
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $display->title ?? '' }}</td>


                                            <td>

                                                <button type="button" class="btn-warning btn-sm"
                                                data-toggle="modal" data-target="#modal-edit" style="width:auto;"
                                                onclick="updateEditModal(<?php echo $display->id; ?>)">Edit</button>

                                                <button type="button" class=" btn-danger btn-sm"
                                                data-toggle="modal" data-target="#modal-default" style="width:auto;"
                                                onclick="replaceLinkFunction(<?php echo $display->id; ?>)">Delete</button>

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
            document.getElementById('confirm_button').setAttribute("href", "/admin/displays/delete/".concat(id));
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

        function updateEditModal(id) {
            document.getElementById('edit_button').setAttribute("href", "/admin/displays/edit/".concat(id));
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
