<!-- Stored in resources/views/layouts/master.blade.php -->
 
<html>
    <head>
        <title>App Name - @yield('title')</title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>