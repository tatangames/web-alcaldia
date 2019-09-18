<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Alcald&iacute;a Metap&aacute;n</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link href='{{ asset('images/LOGO_2_-_copia.png') }}' rel='shortcut icon' type='image/png'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="{{ asset('flaticon/font/flaticon.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/frontend.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('icomoon/iconmoon.ttf')}}">
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}" type="text/javascript"></script>
	@yield('header')
	<style>
		/* On screens that are 768px or less, set the logo bigger */
		@media screen and (max-width: 768px) {
  			.logoimage {
				   width: 300px;
				   height: 80px;
				   margin-bottom: -20px;
  					}
				}
    </style>
    
</head>