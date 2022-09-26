<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link @yield('link-dashboard')" href="{{route('dashboard.index')}}">Dashboard</a> 
                    @can('isLevelTwo')
                        <a class="nav-link @yield('link-olah-data')" href="{{route('olahData.index')}}">Olah Data</a>
                    @endcan
                    <a class="nav-link @yield('link-active')" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @if (session('notifikasi'))
        <div class="toast-container position-absolute end-0 pe-3">
            <div class="toast show align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{session('notifikasi')}}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>    
        </div>
        @endif
        @yield('content')
    </div>
</body>
@stack('script')
</html>