<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Treatment | Interview Test</title>
        @include('layout.partials.head')
    </head>
    <body class="d-flex flex-column h-100">
        @include('layout.partials.nav')
        <main class="flex-shrink-0">
            <div class="container">
                @yield('content')
            </div>
        </main>
        @include('layout.partials.footer')
        @include('layout.partials.footer-scripts')
    </body>
</html>
