<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Living Advantage Inc. E-Lockbox</title>
    <meta name="description" content="">
    <meta name="author" content="WebThemez">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('cssnew/assets/ico/favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/isotope.css') }}" media="screen" />
    <link rel="stylesheet" href="{{url('js/fancybox/jquery.fancybox.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{url('css/da-slider.css')}}" />
    <!-- Owl Carousel Assets -->
    <link href="{{url('js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/styles.css')}}" />
    <!-- Font Awesome -->
    <link href="{{url('font/css/font-awesome.min.css')}}" rel="stylesheet">
    @yield('head')
</head>
<body class="home">

{{--{{ Notification::showAll() }}--}}
@yield('content', 'Default content')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('footer', '')

</body>
</html>