<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        .fa-trash{

            color: red;

        }

        .fa-edit{

            color: blue;

        }
         .fa-eye{

            color: yellowgreen;

        }

        .card-footer{

            margin-top: -20px;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper " >

    @include('admin.layouts.header')

    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">


            <!-- Main content -->
            <section class="content mt-3">

                <!-- Default box -->
                {{--<div class="card">--}}

                        @yield('content')

                <!-- /.card-body -->
                    {{--<div class="card-footer">--}}
                        {{--Footer--}}
                    {{--</div>--}}
                    {{--<!-- /.card-footer-->--}}
                {{--</div>--}}
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->




    @include('admin.layouts.footer')


</div>
</body>
</html>