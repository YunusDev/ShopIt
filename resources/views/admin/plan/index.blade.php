@extends('admin.layouts.app')


@section('styles')

    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">


@endsection

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-12">

                <create-plan></create-plan>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Plans</h3>

                        <button style="padding: 10px" data-toggle="modal" data-target="#createPlan" href="javascript:;"  CLASS="col-lg-3 pull-right btn btn-success">
                            <i class="fa fa-user-plus" style="padding-right: 10px"></i>Add New Plan
                        </button>


                    </div>

                    {{--<div class="box-header">--}}
                        {{--@include('includes.form_error')--}}
                    {{--</div>--}}


                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Plan Name</th>
                                <th>Time Range</th>
                                <th>Bonus</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                                <plans></plans>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Plan Name</th>
                                <th>Time Range</th>
                                <th>Bonus</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>

    </section>


@endsection

@section('scripts')

    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="/js/app.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

@endsection