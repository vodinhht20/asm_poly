<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('frontend')}}/images/favicon.ico" />
    @yield('title')
    @include('layouts.style')
    @yield('style-page')

</head>
<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.script')
    @yield('page-script')

</body>
</html>