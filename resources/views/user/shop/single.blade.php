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

                    <p>Built-in GPS. Water resistance to 50 meters.1 A lightning-fast dual‑core processor. And a display that’s two times brighter than before. Full of features that help you stay active.</p>

                    <ul>
                        <li>Built in GPS</li>
                        <li>Heart Rate Sensor</li>
                        <li>Water Resistant 50 Meters</li>
                        <li>Comprehensive Workout App</li>
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
                    <h5>Full specification</h5>

                    <p>Interactively foster interoperable schemas rather than client-centric architectures. Progressively drive collaborative human capital vis-a-vis optimal ideas. Monotonectally fashion cross-platform leadership skills through high standards in manufactured products. Continually reintermediate.</p>
                    <p>Progressively deliver ethical schemas before equity invested intellectual capital. Rapidiously embrace value-added manufactured products rather than 24/7 information. Credibly whiteboard compelling methodologies installed base action items. Objectively maintain.</p>

                    <h6>Warranty</h6>
                    <p>Synergistically empower multimedia based scenarios before backward-compatible testing procedures. Interactively disintermediate distinctive portals with state of the art sources. Conveniently architect process-centric quality vectors for cross-platform models. Continually expedite.</p>

                    <h6>Shipping info</h6>
                    <p>Progressively morph plug-and-play value without market positioning partnerships. Authoritatively myocardinate high standards in deliverables and effective opportunities. Interactively whiteboard premium relationships rather than go forward expertise. Phosfluorescently target process-centric.</p>

                </div>
            </div>

        </div>
    </section>



@endsection