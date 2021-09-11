<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

    <!-- Title Page-->
    <title><?php echo $title_page; ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo base_url(); ?>assets/admin/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.3/css/scroller.dataTables.min.css">

    <!-- Pop Up -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <!-- Main CSS-->
    <link href="<?php echo base_url(); ?>assets/admin/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="<?php echo base_url(); ?>admin">
                            <img src="<?php echo base_url(); ?>assets/admin/images/header-logo60x60.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin/access"><i class="fas fa-user"></i>Admin</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#"><i class="fas fa-book"></i>Data Master</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/provinsi">Provinsi</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/kota-kab">Kota Kabupaten</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/jurusan-sekolah">Jurusan Sekolah</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/sekolah">Sekolah</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/prodi">Jurusan Universitas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/master/universitas">Universitas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#"><i class="fas fa-users"></i>Peserta</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/peserta">Peserta</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/nilai-semester">Nilai Semester</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/prestasi">Prestasi</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/prodi">Program Studi</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/hasil-rasionalisasi">Hasil Rasionalisasi</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/logout"><i class="zmdi zmdi-power"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->