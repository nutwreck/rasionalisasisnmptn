 <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">overview</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $total_user; ?></h2>
                                        <span>Data Total Semua Peserta</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <button id="total_user" class="btn btn-md btn-light" onclick="total_user()">Download Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $total_user_not_verified; ?></h2>
                                        <span>Data Total Peserta Belum Terverifikasi</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <button id="total_user_not_verified" class="btn btn-md btn-light" onclick="total_user_not_verified()">Download Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $total_user_verified; ?></h2>
                                        <span>Data Total Peserta Terverifikasi</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <button id="total_user_verified" class="btn btn-md btn-light" onclick="total_user_verified()">Download Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $total_user_input_data; ?></h2>
                                        <span>Data Total Peserta Input Data</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <button id="total_user_input_data" class="btn btn-md btn-light" onclick="total_user_input_data()">Download Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-6">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <h3 class="title-2 tm-b-5">User Klik Grandsbmptn.com</h3>
                                <small>* Data diambil dari user yang sudah terverifikasi</small>
                                <div class="row no-gutters">
                                    <div class="col-xl-6">
                                        <div class="chart-note-wrap">
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--blue"></span>
                                                <p id="user_click" style="display:none;"><?php echo $user_click; ?></p>
                                                <span>Klik</span><br />
                                                <button id="total_user_click_data" class="btn btn-md btn-primary" onclick="total_user_click_data()">Data Klik</button>
                                            </div>
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--red"></span>
                                                <p id="user_not_click" style="display:none;"><?php echo $user_not_click; ?></p>
                                                <span>Tidak Klik</span><br />
                                                <button id="total_user_not_click_data" class="btn btn-md btn-danger" onclick="total_user_not_click_data()">Data Tidak Klik</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="percent-chart">
                                            <canvas id="percent-chart-grandsbmptn"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <h3 class="title-2 tm-b-5">Laporan SMS</h3>
                                <div class="row no-gutters">
                                    <div class="col-xl-6">
                                        <div class="chart-note-wrap">
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--blue"></span>
                                                <p id="sent_sms" style="display:none;"><?php echo $sms_sent; ?></p>
                                                <span>Terkirim</span>
                                            </div>
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--red"></span>
                                                <p id="not_sent_sms" style="display:none;"><?php echo $sms_not_sent; ?></p>
                                                <span>Tidak Terkirim</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="percent-chart">
                                            <canvas id="percent-chart-sms"></canvas>
                                        </div>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-6">
                        <h2 class="title-1 m-b-25">Top Sekolah Pendaftar</h2>
                        <label>* Data asal sekolah dari peserta yang sudah input data (maksimal 10 data)</label>
                        <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                            <div class="au-card-inner">
                                <div class="table-responsive">
                                    <table class="table table-top-countries text-center">
                                        <tbody>
                                            <tr>
                                                <?php $no = 1;
                                                foreach($top_school as $val_school){ ?>
                                                    <tr>
                                                        <td><h4 class="text-white"><?php echo $no++.'. '.$val_school->school.' <small>('.$val_school->kota_kab.' - '.$val_school->provinsi.')</small>'; ?></h4></td>
                                                    </tr>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="title-1 m-b-25">Top Universitas Pilihan</h2>
                        <label>* Data universitas pilihan dari peserta yang sudah input data (maksimal 10 data)</label>
                        <div class="au-card au-card--bg-green au-card-top-countries m-b-40">
                            <div class="au-card-inner">
                                <div class="table-responsive">
                                    <table class="table table-top-countries text-center">
                                        <tbody>
                                            <?php $no = 1;
                                            foreach($top_university as $val_university){ ?>
                                                <tr>
                                                    <td><h4 class="text-white"><?php echo $no++.'. '.$val_university->university.' <small>('.$val_university->provinsi.')</small>'; ?></h4></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>