@extends('admin.layouts.app')


@section('styles')

    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">

    <style>

        .isDisabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
        }

    </style>


@endsection

@section('content')

    <section class="content" >

        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <div>

                            <div class="card-header row" >
                                <div class="col-lg-12 mb-2">
                                    <h3 class="card-title text-center ">Batches for <strong class="text-info"><i>@isset($merchant) {{$merchant->name}} @else {{$plan->name}} @endisset</i></strong></h3>

                                </div>

                            </div>
                            <br>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Count of Investments</th>
                                        <th>View Investments</th>
                                        <th>Export to Excel</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batches as $batch)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{route('batches.investments', $batch->name)}}">{{$batch->name}}</a></td>
                                            @php
                                                $cnt = $batch->investments()->count()
                                            @endphp
                                            <td>{{$cnt}} </td>
                                            <td><a class="{{$cnt > 0 ? '' : 'isDisabled'}}" href="{{route('batches.investments', $batch->name)}}"><i class="text-center fa fa-eye"></i></a></td>
                                            <td><a class="{{$cnt > 0 ? '' : 'isDisabled'}}" href="{{route('batch.export', $batch->name)}}"><i class="text-center fa fa-download"></i></a></td>
                                            <td>{{$batch->created_at->toDayDateTimeString()}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>

                                    <tfoot>

                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Count of Investments</th>
                                        <th>View Investments</th>
                                        <th>Export to Excel</th>
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