<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            @include('partials.navbar')
            <div class="main-content" style="min-height: 541px; padding-top: 100px">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.script')
    @yield('script')
</body>
</html>