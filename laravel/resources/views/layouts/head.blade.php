<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
	<link href="{{ URL::asset('Css/style.css') }}" rel="stylesheet">  
	<!-- <link href="{{ URL::asset('Css/bootstrap-responsive.css') }}" rel="stylesheet">   -->
	<link href="{{ URL::asset('Css/bootstrap.css') }}" rel="stylesheet">  
	<script type="text/javascript" src="{{ URL::asset('Js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('Js/bootstrap.js') }}"></script> 
	<script type="text/javascript" src="{{ URL::asset('Js/ckform.js') }}"></script> 
	<script type="text/javascript" src="{{ URL::asset('Js/common.js') }}"></script>
	@yield('css')
    @yield('js') 
	@yield('style')
</head>
<body>
@yield('content')
</body>
</html>