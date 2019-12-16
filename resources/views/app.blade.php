<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>

<div class="container mt-5">
    <header class="row">
        @include('includes.header')
    </header>
    <div id="main" class="row mt-5">

        @yield('content')
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>

</div>
</body>
</html>
<style>
    .main-body{
        background: rgba(189, 189, 189, 0.24);
        height: 40px;
        position: fixed;
        padding:250px;
    }
</style>
