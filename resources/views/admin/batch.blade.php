@extends('admin.layouts.app')


@section('styles')

    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">


@endsection

@section('content')

    <section class="content" >

        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <div>

                            <div class="card-header row" >
                                <div class="col-lg-6 mb-2">
                                    <h3 class="card-title">All Batches</h3>

                                </div>

                            </div>
                            <br>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($batches as $batch)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$batch->name}}</td>
                                                <td>{{$batch->created_at}}</td>

                                            </tr>
                                            @empty

                                            <td>No Batches</td>
                                        @endforelse
                                    </tbody>

                                    <tfoot>

                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Created at</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>


                        </div>



                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('scripts')

    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}}"></script>

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