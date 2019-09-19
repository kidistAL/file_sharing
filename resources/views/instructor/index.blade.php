@extends('layouts.master')
@section('specificCSS')
<link rel="stylesheet" href="{{'css/datatables.min.css'}} ">
@append

@section('specificJS')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    function fill_form() {
        $('.edit').on('click', function () {
            $('#idselect').val($(this).data('instructor_id'))
            $('#nameselect').val($(this).data('name'))
            $('#titleselect').val($(this).data('title'))
            $('#courseselect').val($(this).data('course_code'))

            $("#editform").attr('action', "/instructors/" + $(this).data('id'));

        })
    }

    function get_action() {
        $('.remove').on('click', function () {
            console.log($(this).data('id'));
            $("#deletf").attr('action', "/instructors/" + $(this).data('id'));
            console.log($('#deletf').attr('action'))
        })
    }
    get_action()
    fill_form()

</script>
@append

@section('header')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Instructor Management Page</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Instructor Page</li>
    </ol>
</div><!-- /.col -->
@append
@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Instructor management Table With Full Features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <span class="table-add float-right mb-3 mr-2"><a href="#!" data-toggle="modal"
                        data-target="#addinstructor" class="text-success"><i class="fas fa-plus fa-2x"
                            aria-hidden="true"></i></a></span>
                <div class="table-responsive-sm">
                    <table id="dtBasicExample" class="table table-striped  table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">name</th>
                                <th class="th-sm">instructor_id</th>
                                <th class="th-sm">title</th>
                                <th class="th-sm">Creadted at</th>
                                <th class="th-sm">Edit</th>
                                <th class="th-sm">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $instructor)
                            <tr>
                                <td>{{$instructor->name}}</td>
                                <td>{{$instructor->instructor_id}}</td>
                                <td>{{$instructor->title}}</td>
                                <td>{{$instructor->created_at}}</td>
                                <td>
                                    <span class="table-remove"><button data-toggle="modal" data-target="#editinstructor"
                                            type="button" data-name="{{$instructor->name}}"
                                            data-id="{{$instructor->id}}"
                                            data-instructor_id="{{$instructor->instructor_id}}"
                                            data-title="{{$instructor->title}}"
                                            class="btn btn-success btn-rounded btn-sm my-0 edit">Edit </button></span>
                                </td>
                                <td>

                                    <span class="table-remove"><button type="button" data-id="{{$instructor->id}}"
                                            data-toggle="modal" data-target="#deleteinstructor"
                                            class="btn btn-danger btn-rounded btn-sm my-0 remove">Remove</button></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="th-sm">name</th>
                                <th class="th-sm">instructor_id</th>
                                <th class="th-sm">title</th>
                                <th class="th-sm">Creadted at</th>
                                <th class="th-sm">Edit</th>
                                <th class="th-sm">Remove</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteinstructor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Are You Sure You want to delete?
                </div>
            </div>
            <div class="modal-footer">
                <form id="deletf" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addinstructor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('instructors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('instructor.form')
                </form>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="editinstructor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editform" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')



                    <div class="form-group col-md-4">
                        <label for="deptselect">Department</label>
                        <select name="dept" class="form-control" id="deptselect">
                            <option value="" disabled selected>Select dept</option>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="nameselect">Instructor Name</label>
                        <input type="text" name="name" class="form-control" id="nameselect"
                            placeholder="Instructor Name">
                    </div>
                    <div class="form-group">
                        <label for="idselect">Instructor id</label>
                        <input class="form-control" name="instructor_id" id="idselect" placeholder="Instructor id">
                    </div>
                    <div class="form-group">
                        <label for="titleselect">Title</label>
                        <input class="form-control" name="title" id="genderselect" placeholder="title">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>

            </form>
        </div>

    </div>
</div>
</div>


@endsection
