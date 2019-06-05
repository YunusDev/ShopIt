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
                                    @php
                                        $cnt = $batch->investments()->count()
                                    @endphp
                                    <h3 class="card-title text-center mb-2"><strong class="text-info"><i>{{$batch->merchant->name}}</i></strong> <strong><i>|</i></strong> <strong class="text-info"><i>{{$batch->investmentProduct->name}}</i></strong></h3>
                                    <h4 class="card-title text-center">Investments from <strong><i>{{$batch->name}}</i></strong></h4>
                                    <a style="padding: 10px; margin: 0 auto;"  class=" mt-3  {{$cnt > 0 ? '' : 'isDisabled'}}  pull-right btn btn-outline-info" href="{{route('batch.export', $batch->name)}}" >
                                    <i class="fa fa-download" style="padding-right: 10px"></i>Export to Excel
                                    </a>

                                </div>

                                {{--<div class="col-md-4 text-center pull-right">--}}
                                    {{--<button id="singlebutton" name="singlebutton" class="btn btn-primary">Next Step!</button>--}}
                                {{--</div>--}}

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