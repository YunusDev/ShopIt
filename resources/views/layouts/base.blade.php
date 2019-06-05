<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Umaiza</title>

    <!-- Styles -->
{{--    <link href="{{asset('css/app.css')}}" rel="stylesheet">--}}

    @yield('styles')

    <link href="/assets/css/core.min.css" rel="stylesheet">
    <link href="/assets/css/thesaas.min.css" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
    <link rel="icon" href="/assets/img/favicon.png">

    <style>
        nav{
            /*margin: 30px 50px 100px;*/
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
            border: 1px solid #ebebeb;
            /*margin-bottom: 150px;*/

        }

    </style>
</head>
<body>
<div id="app">
    <nav class="topbar topbar-expand-md">
        <div class="container">

            <div class="topbar-left">
                <button class="topbar-toggler">☰</button>
                <a class="topbar-brand" href="{{url('/')}}"><h3>Umaiza</h3>
                    {{--<img class="logo-default" src="assets/img/q_a.png" alt="logo">--}}
                    <img class="logo-inverse" src="assets/img/logo-light.png" alt="logo">
                </a>
            </div>


            <div class="topbar-right">

                <ul class="topbar-nav nav">
                    <li class="nav-item"><a style="padding-left: 20px;" class="nav-link" href="{{url('/')}}">Home</a></li>

                </ul>
                <ul class="topbar-nav nav">
                    <li class="nav-item"><a style="padding-left: 20px;"class="nav-link" href="{{url('/plan')}}">Plan</a></li>

                </ul>

                @guest
                    <div class="d-inline-flex ml-30">
                        <a class="btn btn-sm btn-success mr-4" href="{{url('/login')}}">Login</a>
                        <a class="btn btn-sm btn-outline btn-dark hidden-sm-down" href="{{url('/register')}}">Register</a>
                    </div>
                @else
                    {{--<li class="nav-item"><a style="padding-left: 20px;"class="nav-link" href="{{url('/dashboar')}}d">{{auth()->user()->name}}</a></li>--}}

                    <div class="d-inline-flex ml-30">
                        <a class="btn btn-sm btn-danger mr-4" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>

        </div>
    </nav>


    {{--@yield('header')--}}

    <main class="main-content main">
        @yield('content')
    </main>


    <footer class="site-footer" style=" left: 0; bottom: 0; width: 100%;">
        <div class="container">
            <div class="row gap-y">
                <div class="col-12 col-md-6">
                    <p class="text-center text-md-left">Copyright © 2017 <a class="text-dark" href="/">Umaiza</a>. All rights reserved.</p>
                </div>

                <div class="col-12 col-md-6">
                    <ul class="nav nav-inline nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Terms of use</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Privacy policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</div>
{{--<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>--}}

<script src="/assets/js/core.min.js"></script>
<script src="/assets/js/thesaas.min.js"></script>
<script src="/assets/js/script.js"></script>

<script src="/js/app.js"></script>
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
@yield('scripts')

</body>
</html>
