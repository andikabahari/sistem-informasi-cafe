<div class="navbar-bg" style="height: 70px"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="dashboard-general.html" class="navbar-brand">{{ config('app.name') }}</a>
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="nav-item"><a href="#" class="nav-link nav-link-lg"><div class="d-inline-block">Dashboard</div></a></li>
        <li class="nav-item"><a href="#" class="nav-link nav-link-lg"><div class="d-inline-block">Kelola Menu</div></a></li>
        <li class="nav-item"><a href="#" class="nav-link nav-link-lg"><div class="d-inline-block">Kelola Pengguna</div></a></li>
        <li class="nav-item"><a href="#" class="nav-link nav-link-lg"><div class="d-inline-block">Pesanan</div></a></li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Ujang Maman</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Akun
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>
<div style="display: none"><nav class="navbar navbar-secondary navbar-expand-lg"></nav></div>