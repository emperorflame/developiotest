<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Developio test</title>
    {{-- css --}}
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    @include('includes.navbar')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12" style="min-height:1080px">

                @include('includes.messages')

                @yield('content')
            </div>
        </div>
    </div>
    <footer id="footer" class="text-center">
        <p>Developed by Teleki Ádám</p>
    </footer>
</body>
</html>
