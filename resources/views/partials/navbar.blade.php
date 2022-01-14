<?php use App\Helpers\MyAuth; ?>
<div class="navbar-bg" style="height: 70px"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
        <a href="{{ route('auth') }}" class="navbar-brand d-xs-none d-sm-block">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars text-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-right ml-auto">
                @if (MyAuth::role('pemilik'))
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Dashboard</div></a></li>
                    <li class="nav-item"><a href="{{ route('menu') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Menu</div></a></li>
                    <li class="nav-item"><a href="{{ route('pengguna') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Pengguna</div></a></li>
                @else
                    <li class="nav-item"><a href="{{ route('pesanan') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Pesanan</div></a></li>
                @endif
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg ">
                    <div class="d-lg-inline-block"><span class="mr-1">{{ MyAuth::data()->nama_pengguna }}</span> <i class="fa fa-caret-down" style="line-height: 1; font-size: 0.75rem"></i></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('akun') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Akun
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div style="display: none"><nav class="navbar navbar-secondary navbar-expand-lg"></nav></div>