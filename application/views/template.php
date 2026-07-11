<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/')?>assets/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url('assets/template/dist/')?>assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url('assets/template/dist/')?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/')?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/')?>assets/css/app.css">
    <link rel="shortcut icon" href="<?= base_url('assets/template/dist/')?>assets/images/favicon.svg" type="image/x-icon">
</head>
<style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    #app {
      display: flex;
      flex: 1;
    }

    #main {
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .content-wrapper {
      flex: 1; /* isi ruang kosong sebelum footer */
    }
  </style>


<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?php echo base_url('home') ?>"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="<?php echo base_url('dashboard') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                       
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data Master</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/users') ?>">Data user</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/kereta') ?>">Data Kereta</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/gerbong') ?>">Data Gerbong</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/jadwal') ?>">Data Jadwal</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/pemesanan') ?>">Data Pemesanan</a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?php echo base_url('admin/laporan') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Laporan</span>
                            </a>
                            
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>laporan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/laporan') ?>">Transaksi</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('admin/marchendise') ?>">Data User</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Authentication</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('auth') ?>">Login</a>
                                </li>
                                <!-- <li class="submenu-item ">
                                    <a href="auth-register.html">Register</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="auth-forgot-password.html">Forgot Password</a>
                                </li> -->
                            </ul>
                        </li>

                        
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
        <div class="container-fluid">
            <!-- Judul / Breadcrumb -->
            
            <div class="section-header">
            <h5><?= $judul_halaman; ?></h5>
          </div>

            <!-- Bagian kanan -->
            <div class="d-flex align-items-center">
            <!-- Notifikasi -->
            <button class="btn btn-light position-relative me-3">
                <i class="bi bi-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
                </span>
            </button>

            <!-- Profil Pengguna -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                    $photo = $this->session->userdata('photo') ?? 'default.png'; 
                    $photo_path = base_url('assets/photo/' . $photo);
                ?>
                <img src="<?= $photo_path ?>" alt="profile" style="width: 40px; height: 40px; border-radius: 50%;">
                <span><?= $this->session->userdata('nama') ?? $this->session->userdata('nama') ?? 'pengguna' ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?php echo base_url('auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
        </nav>
<br>
          <h2><?= $contents; ?></h2>

          <footer class="footer bg-white shadow-sm border-top mt-auto">
            <div class="container py-3 d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    <p class="mb-0">2025 &copy; Mazer</p>
                </div>
                <div class="text-muted small">
                    <p class="mb-0">
                        Crafted with <span class="text-danger"><i class="bi bi-heart-fill"></i></span> by 
                        <a href="http://ahmadsaugi.com" class="fw-semibold text-decoration-none text-primary">A. Saugi</a>
                    </p>
                </div>
            </div>
        </footer>

        </div>
    </div>
    <script src="<?= base_url('assets/template/dist/')?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/template/dist/')?>assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/template/dist/')?>assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="<?= base_url('assets/template/dist/')?>assets/js/pages/dashboard.js"></script>

    <script src="<?= base_url('assets/template/dist/')?>assets/js/main.js"></script>
    <!-- Tambahkan Bootstrap Icons untuk icon bell -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>