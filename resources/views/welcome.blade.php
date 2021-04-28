<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ $page }}</title>

        <!-- Custom fonts for this template-->
        <link href="{{ url('/') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ url('/') }}/css/sb-admin-2.min.css" rel="stylesheet">

    </head>
    
    <body class="antialiased">
    
        <div class="mainbg">
        <canvas id="particles-js"></canvas>
            <div class="container">
                @yield('content')
            </div>
        </div>

        <script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>
        <script src="{{ url('/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ url('/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r79/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" defer data-deferred="1"></script>
        <script src="{{ url('/') }}/js/particles.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ url('/') }}/js/sb-admin-2.min.js"></script>
    </body>
</html>
