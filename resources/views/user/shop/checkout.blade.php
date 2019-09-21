@extends('layouts.base')

@section('title') Checkout @endsection

@section('styles')

    <style>
        .has-error{
            border-color: #dd4b39;
        }
    </style>

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/all.css')}}">

@endsection

@section('content')

    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url({{asset('user/assets/img/bg-gift.jpg')}})" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>Checkout</h1>
                    <p class="fs-20 opacity-70">You can find a list of our product in this page. We'll deliver your order in less than two days. Try it yourself!</p>

                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->

    <section class="section">
        <div class="container">

            <order-step   raw_carts = "{{$carts}}" refd="hhjhhjhh"  keyd = "jewhkwejjwej" ></order-step>

        </div>
    </section>

@endsection


@section('scripts')

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass   : 'iradio_flat-blue'
        })
    </script>

@endsection