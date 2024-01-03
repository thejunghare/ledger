<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


@include('layouts.header')

<body>
    <div id="app">
        @include('layouts.login-nav')

        <main class="">
            <div id="layoutSidenav">
                @include('layouts.side-nav')
                <div id="layoutSidenav_content">
                    @yield('content')
                    @include('layouts.footer')
                </div>
            </div>

        </main>


        @include('layouts.script')
    </div>

</body>

</html>
