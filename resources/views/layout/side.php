<?php $uri = substr($_SERVER['REQUEST_URI'], 1); ?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mini System <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($uri == '') echo 'active'; ?> ">
        <a class="nav-link" href="<?= url('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
        
    </div>

    <li class="nav-item <?php if ($uri == 'vehicle') echo 'active'; ?>">
        <a class="nav-link" href="<?= url('vehicle') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Vehicle</span></a>
    </li>

    <li class="nav-item <?php if ($uri == 'sparepart') echo 'active'; ?>">
        <a class="nav-link" href="<?= url('sparepart') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Sparepart</span></a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->