<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Laravel website</title>
    {{-- css --}}
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
@include('includes.navbar')

<div class="container">
    @if(Request::is('/'))
        @include('includes.showcase')
    @endif
    <div class="row">
        <div class="col-lg-8 col-md-8">

            @include('includes.messages')

            @yield('content')
        </div>
        <div class="col-lg-4 col-md-4">
            @include('includes.sidebar')
        </div>
    </div>
</div>
<footer id="footer" class="text-center">
    <p>copyright 2018 &copy; Developed by Stephen</p>
</footer>
</body>
</html>
