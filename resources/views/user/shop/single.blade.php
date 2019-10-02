@extends('layouts.base')

@section('title') Shop - {{$product->name}} @endsection

@section('styles')

    <style>
        .has-error{
            border-color: #dd4b39;
        }
    </style>

@endsection

@section('content')

    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url({{asset('user/assets/img/bg-gift.jpg')}})" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{$product->name}}</h1>
                    <p class="fs-20 opacity-70">You can find a list of our product in this page. We'll deliver your order in less than two days. Try it yourself!</p>

                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->

    <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Product details
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
    <section class="section bb-1">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide text-center"><img src="{{asset('user/assets/img/product-screen-1.png')}}" alt="..."></div>
                            <div class="swiper-slide text-center"><img src="{{asset('user/assets/img/product-screen-2.png')}}" alt="..."></div>
                            <div class="swiper-slide text-center"><img src="{{asset('user/assets/img/product-screen-3.png')}}" alt="..."></div>
                            <div class="swiper-slide text-center"><img src="{{asset('user/assets/img/product-screen-3.png')}}" alt="..."></div>
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>

                </div>


                <div class="col-12 col-md-4">
                    <br>
                    <h5>{{$product->name}}</h5>

                    <p>
                        <del>N{{$product->price + 100}}</del>
                        <span class="lead ml-20">N{{$product->price}}</span>
                    </p>

                    <p>{{$product->brief}}</p>

                    <ul>
                        @foreach($product_specs as $spec)

                            <li>{{$spec}}</li>

                        @endforeach
                    </ul>

                    <hr>

                    <form>
                        <div class="form-group">
                            <select class="form-control">
                                <option>Select a color</option>
                                <option>Black</option>
                                <option>White</option>
                                <option>Pink</option>
                                <option>Gold</option>
                            </select>
                        </div>

                        <div class="row" style="margin-top: 15px">
                            <div class="col  form-group">
                                <input class="form-control" type="text" placeholder="Quantity">
                            </div>

                            <div class="col form-group">
                                <button class="btn btn-block btn-primary" ><span class="fa fa-shopping-cart"></span> Add to cart</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>


            <br>
            <hr>
            <br>


            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    {!! $product->description !!}

                </div>
            </div>

        </div>
    </section>



@endsection