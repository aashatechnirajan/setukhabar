@extends('admin.layouts.master')


@section('content')



<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $page_title }}</h1>
        <a href="{{ route('admin.favicons.create') }}"><button class="btn-primary btn-sm"><i class="fa fa-plus"></i>
                Add New</button></a>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- Content Wrapper. Contains page content -->
@if(session('successMessage'))
<div class="alert alert-success">
    {!! session('successMessage') !!}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {!! session('error') !!}
</div>
@endif




<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Favicon 32 * 32</th>
            <th>Favicon 16 * 16</th>
            <th>apple touch icon</th>
            <th>site webmanifest</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($icons as $icon)
        <tr data-widget="expandable-table" aria-expanded="false">
            <td>
                <img src="{{ asset('uploads/favicon/' . $icon->favicon_thirtyTwo) }}" style="max-width: 100px; max-height: 100px;">
            </td>

            <td>
                <img src="{{ asset('uploads/favicon/' . $icon->favicon_sixteen) }}" style="max-width: 100px; max-height: 100px;">
           </td>

            <td>
                <img src="{{ asset('uploads/favicon/' . $icon->apple_touch_icon) }}" style="max-width: 100px; max-height: 100px;">
         </td>

            <td>

                    <iframe src="{{ asset('uploads/favicon/file/' . $icon->file) }}" title="" style="width: 100px; height:100px;"></iframe>

            </td>
            <td>
                <button type="button" class="btn-warning button-size" data-bs-toggle="modal" data-bs-target="#edit{{ $icon->id }}">
                    Update
                  </button>


                {{-- <button type="button" class="btn-danger button-size" data-bs-toggle="modal"
                    data-bs-target="#delete{{ $icon->id }}">
                    Delete
                </button> --}}
            </td>
        </tr>
        @endforeach
        {{-- @dd($image->img); --}}

    </tbody>


     {{-- update --}}
     @foreach($icons as $image)

     <div class="modal fade" id="edit{{ $image->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">This can't be undone. Are you sure?</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>

           <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
              <a href="{{ url('admin/favicons/edit/' .$image->id) }}">
               <button type="button" class="btn btn-danger">Yes
               </button>
             </a>
           </div>
         </div>
       </div>
     </div>

     @endforeach

    {{-- @foreach($icons as $image)

    <div class="modal fade" id="delete{{ $image->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">This can't be undone. Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    <a href="{{ url('admin/favicons/destroy/'.$image->id) }}">
                        <button type="button" class="btn btn-danger">Yes
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach --}}

</table>





<script>
    var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })




</script>










@stop
