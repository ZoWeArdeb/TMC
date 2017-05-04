<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Laravel') :: Tournament</title>

        @section('meta')
            @include('includes/inc_meta')
        @show

        @section('favicon')
            @include('includes/inc_favicon')
        @show

        @section('stylesheets')
            @include('includes/inc_stylesheets')
        @show
    </head>
    <body>
        <header>
            @yield('header')
        </header>

        <div class="content">
            @yield('content')
        </div>

        <footer>
            @yield('footer')
        </footer>

        @section('javascript')
            @include('includes/inc_scripts')
        @show
    </body>
</html>
