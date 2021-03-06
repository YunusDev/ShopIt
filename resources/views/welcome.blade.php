@extends('layouts.base')

@section('title') MiniPort - Start Shopping Now @endsection

@section('styles')

    <style>
        .has-error{
            border-color: #dd4b39;
        }
    </style>

@endsection

@section('content')

    <!-- Header -->


    <header class="header header-inverse bg-fixed" style="background-image: url(user/assets/img/bg-gift.jpg)" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>The Store</h1>
                    <p class="fs-20 opacity-70">You can find a list of our product in this page. We'll deliver your order in less than two days. Try it yourself!</p>

                </div>
            </div>

        </div>
    </header>

    <section class="section">
        <div class="container">

            <h1 class="text-center" style="margin-top: -50px">Shop</h1>

            {{--<form class="form-round py-30 col-lg-6" style="margin: 0 auto">--}}
                {{--<div class="input-group row">--}}
                    {{--<input type="text" class="form-control form-control-lg" placeholder="Search for...">--}}
                    {{--<span class="input-group-btn">--}}
                     {{--<button class="btn btn-primary" type="button">Go!</button>--}}
                {{--</span>--}}
                {{--</div>--}}
            {{--</form>--}}

            <my-search> </my-search>



            <div class="row gap-y">

                @forelse($products as $product)

                    <div class="col-12 col-md-6 col-xl-4">

                        <div class="shop-item" >
                            <div class="item-details">
                                <div>
                                    <h5>{{$product->name}}</h5>
                                    <p>{{$product->category->name}}</p>
                                </div>

                                <div class="item-price"><span class="unit">N</span>{{$product->price}}</div>
                            </div>
                            <a href="{{route('single', $product->slug)}}">
                                <img height="400" src="/productCoverImages/{{$product->image}}" alt="product">
                            </a>

                            <add-to-cart product_id = "{{$product->id}}"></add-to-cart>

                        </div>

                    </div>

                @empty

                    <h5>No Products In Store</h5>

                @endforelse

            </div>

        </div>
    </section>

@endsection