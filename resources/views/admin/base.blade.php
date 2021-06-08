@extends('layouts.skeleton')

@section('app')
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('partials.topnav')
        </nav>
        <div class="main-sidebar">
            @include('partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @if (Session::has('message'))
                <div class="conatiner">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('partials.footer')
        </footer>
    </div>
@endsection
