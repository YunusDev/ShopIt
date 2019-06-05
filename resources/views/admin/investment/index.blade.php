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
                                    <h3 class="card-title">All Investments</h3>

                                </div>

                            </div>
                            <br>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>User</th>
                                        <th>Plan Name</th>
                                        <th>Merchant Name</th>
                                        {{--<th>Reference</th>--}}
                                        <th>Days Count</th>
                                        <th>Settled</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($investments)
                                        @foreach($investments as $investment)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$investment->name}}</td>
                                                <td>N{{$investment->amount }}</td>
                                                <td>{{$investment->user->email }}</td>
                                                <td>{{$investment->investmentProduct->name}}</td>
                                                <td>{{$investment->investmentProduct->merchant->name}}</td>
{{--                                                <td>{{$investment->reference}}</td>--}}
                                                <td>{{$investment->day_count}} Days</td>
                                                <td>{{$investment->is_settled == 0 ? 'Not Settled': 'Settled'}}</td>
                                                <td>{{$investment->created_at->toDayDateTimeString()}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                    <tfoot>

                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>User</th>
                                        <th>Plan Name</th>
                                        <th>Merchant Name</th>
                                        {{--<th>Reference</th>--}}
                                        <th>Days Count</th>
                                        <th>Settled</th>
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