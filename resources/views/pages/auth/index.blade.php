@extends('layouts.default')

@section('title', 'Memulai Sesi')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <a href="{{ route('auth') }}">
                    <h4 class="text-center">Cafe {{ config('app.name') }}</h4>
                </a>
                <div class="login-brand"></div>
                @include('partials.message')
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Memulai Sesi</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('login') }}">
                            @method('post')
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" name="password">
                                <div class="text-right mt-2">
                                    <small><a href="{{ route('reset-password') }}">Lupa password?</a></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> {{ config('app.name') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection