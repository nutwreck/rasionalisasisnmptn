
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a class="logo" href="<?php echo base_url(); ?>admin">
                    <img src="<?php echo base_url(); ?>assets/admin/images/header-logo60x60.png" alt="RasionalisasiSNMPTN" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin/access"><i class="fas fa-user"></i>Admin</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#"><i class="fas fa-book"></i>Data Master</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">