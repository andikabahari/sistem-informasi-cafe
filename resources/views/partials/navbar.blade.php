<?php use App\Helpers\MyAuth; ?>
<div class="navbar-bg" style="height: 70px"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
        <a href="{{ route('auth') }}" class="navbar-brand">{{ config('app.name') }}</a>
        <ul class="navbar-nav navbar-right ml-auto">
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Dashboard</div></a></li>
            <li class="nav-item"><a href="{{ route('menu') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Menu</div></a></li>
            <li class="nav-item"><a href="{{ route('pengguna') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Pengguna</div></a></li>
            <li class="nav-item"><a href="{{ route('pesanan') }}" class="nav-link nav-link-lg"><div class="d-inline-block">Pesanan</div></a></li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">{{ MyAuth::data()->nama_pengguna }}</div></a>
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
</nav>
<div style="display: none"><nav class="navbar navbar-secondary navbar-expand-lg"></nav></div>