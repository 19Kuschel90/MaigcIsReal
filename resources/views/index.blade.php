<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <base href="/">
    <title>Maigc is real</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('img/logoEye.svg')}}">

    <meta name="apple-mobile-web-app-title" content="Maigc is real">
    <!-- <meta name="theme-color" content="#ff00ff"> -->
    <meta name="theme-color" content="#00d3d6">

    <link rel="apple-touch-startup-image" href="{{asset('img/logoEye.svg')}}" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPhone 5+ -->
    <link rel="apple-touch-startup-image" href="{{asset('img/logoEye.svg')}}" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPhone, retina -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="apple-touch-icon" href="{{asset('img/logoEye.svg')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/logoEye.svg')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/logoEye.svg')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('img/logoEye.svg')}}">

    <meta name="application-name" content="Maigc is real" />
    <meta name="msapplication-square70x70logo" content="{{asset('img/logoEye.svg')}}" />
    <meta name="msapplication-square150x150logo" content="{{asset('img/logoEye.svg')}}" />
    <meta name="msapplication-wide310x150logo" content="{{asset('img/logoEye.svg')}}" />
    <meta name="msapplication-square310x310logo" content="{{asset('img/logoEye.svg')}}" />
    <meta name="msapplication-TileColor" content="#ECC400" />

    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="manifest.json">
</head>
<body>
<div id="app" v-cloak   >
<nav>
<ul class="nav justify-content-end  backblue1 ">
      <li>
      <div><router-link to="/"><img src="{{asset('img/logoEye.svg')}}" alt="logo" class="logoSize"></router-link> </div>
</li>
    <li class="nav-item">
      <router-link class="nav-link active text-dark" to="/">Home</router-link>
    </li>

    <li class="nav-item">
        <!-- Authentication Links -->
        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <router-link class="nav-link active text-dark" to="/profil" >profil</router-link>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
   
     
    </li>
    <li class="nav-item">
      <router-link class="nav-link disabled text-dark" to="/chat">chat</router-link>
    </li>
</ul>
</nav>
<main>
    <router-view class="alert"></router-view>
</main>
<footer></footer>
    </div>
<script src="{{mix('js/app.js')}}"></script>
    <script>
        console.log('asd');
        if ('serviceWorker' in navigator) {  

            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {    // Registration was successful
                       
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);  

                }).catch(function(err) {    // registration failed :(
                       
                    console.log('ServiceWorker registration failed: ', err);  
                });

        }
    </script>
</body>
</html>