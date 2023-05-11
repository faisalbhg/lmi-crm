<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Metas -->
    @if(env('IS_DEMO'))
        <x-demo-metas></x-demo-metas>
    @endif

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <title>
        LMI CRM
    </title>
    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f5641a49d9.js" crossorigin="anonymous"></script>
    

    <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('css/soft-ui-dashboard.css?v=0.12')}}" rel="stylesheet" />
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style type="text/css">
        /*!
 * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
 * Copyright 2015 Daniel Cardoso <@DanielCardoso>
 * Licensed under MIT
 */
.la-ball-beat,
.la-ball-beat > div {
    position: relative;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
.la-ball-beat {
    display: block;
    font-size: 0;
    color: #fff;
}
.la-ball-beat.la-dark {
    color: #333;
}
.la-ball-beat > div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor;
}
.la-ball-beat {
    width: 54px;
    height: 18px;
}
.la-ball-beat > div {
    width: 10px;
    height: 10px;
    margin: 4px;
    border-radius: 100%;
    -webkit-animation: ball-beat .7s -.15s infinite linear;
       -moz-animation: ball-beat .7s -.15s infinite linear;
         -o-animation: ball-beat .7s -.15s infinite linear;
            animation: ball-beat .7s -.15s infinite linear;
}
.la-ball-beat > div:nth-child(2n-1) {
    -webkit-animation-delay: -.5s;
       -moz-animation-delay: -.5s;
         -o-animation-delay: -.5s;
            animation-delay: -.5s;
}
.la-ball-beat.la-sm {
    width: 26px;
    height: 8px;
}
.la-ball-beat.la-sm > div {
    width: 4px;
    height: 4px;
    margin: 2px;
}
.la-ball-beat.la-2x {
    width: 108px;
    height: 36px;
}
.la-ball-beat.la-2x > div {
    width: 20px;
    height: 20px;
    margin: 8px;
}
.la-ball-beat.la-3x {
    width: 162px;
    height: 54px;
}
.la-ball-beat.la-3x > div {
    width: 30px;
    height: 30px;
    margin: 12px;
}
/*
 * Animation
 */
@-webkit-keyframes ball-beat {
    50% {
        opacity: .2;
        -webkit-transform: scale(.75);
                transform: scale(.75);
    }
    100% {
        opacity: 1;
        -webkit-transform: scale(1);
                transform: scale(1);
    }
}
@-moz-keyframes ball-beat {
    50% {
        opacity: .2;
        -moz-transform: scale(.75);
             transform: scale(.75);
    }
    100% {
        opacity: 1;
        -moz-transform: scale(1);
             transform: scale(1);
    }
}
@-o-keyframes ball-beat {
    50% {
        opacity: .2;
        -o-transform: scale(.75);
           transform: scale(.75);
    }
    100% {
        opacity: 1;
        -o-transform: scale(1);
           transform: scale(1);
    }
}
@keyframes ball-beat {
    50% {
        opacity: .2;
        -webkit-transform: scale(.75);
           -moz-transform: scale(.75);
             -o-transform: scale(.75);
                transform: scale(.75);
    }
    100% {
        opacity: 1;
        -webkit-transform: scale(1);
           -moz-transform: scale(1);
             -o-transform: scale(1);
                transform: scale(1);
    }
}
    </style>
    @livewireStyles

    @stack('custom_css') 

</head>

<body class="g-sidenav-show bg-gray-100">


    {{ $slot }}

    <!--   Core JS Files   -->
    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('js/soft-ui-dashboard.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @livewireScripts

    @stack('custom_script') 
    
</body>

</html>
