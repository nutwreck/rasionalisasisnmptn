<section class="mt-3 mb-3">
    <h3 class="text-center font-kg-happy">Rasionalisasi SNMPTN</h3>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="msform">
                    <ul id="progressbar">
                        <li id="nilairaport"><strong class="font-arial-rounded">Nilai Raport</strong></li>
                        <li id="prestasi"><strong class="font-arial-rounded">Prestasi</strong></li>
                        <li id="prodi"><strong class="font-arial-rounded">Program Studi</strong></li>
                        <li class="active" id="hasil"><strong class="font-arial-rounded">Hasil Rasionalisasi</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
                <div class="card">
                    <div class="card-header text-center bg-info text-white font-kg-happy"><h4>Hasil Kamu</h4></div>
                    <div class="card-body text-center">
                        <div>
                            <h3>Hai, <?php echo $nama_peserta; ?></h3>
                        </div>
                        <div class="mt-3">
                            <span class="circle shadow <?php echo $color_circle; ?>"><?php echo $result_final.'%'; ?></span>
                        </div>
                        <?php foreach($prodi_pertama as $prt){ 
                            $prodi_pertama = $prt->nama_universitas_jurusan;
                        } ?>
                        <div class="mt-3">
                            <h5>Peluang kamu lolos untuk program study <br /><?php echo $prodi_pertama; ?> <b><u><?php echo $result_kategori; ?></u></b>.</h5>
                            <div class="mt-4 col-md-8 col-sm-12 offset-sm-2">
                            <?php if($result_kategori == 'Tinggi') { ?>
                                <h6>Kesempatan kamu untuk masuk melalui SNMPTN di prodi tersebut cukup terbuka lebar. <br />Tetap pertahankan semangat dan prestasi kamu ya !!</h6>
                                <h6>Namun tidak ada salahnya buatmu untuk mempersiapkan diri di UTBK - SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?> agar kamu lebih yakin buat masuk PTN. <br /><a href="<?php echo base_url(); ?>click-grandsbmptn/<?php echo $identity; ?>" target="_blank">Yuk persiapkan diri kamu untuk UTBK SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?></a>.</h6>
                            <?php } elseif($result_kategori == 'Sedang') { ?>
                                <h6>Oleh karena itu, saran kami agar kamu mempertimbangkan kembali jurusan yang kamu pilih di SNMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?> <br /> Atau kamu bisa mengejar prodi tersebut di UTBK - SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?>. <br /><a href="<?php echo base_url(); ?>click-grandsbmptn/<?php echo $identity; ?>" target="_blank">Yuk persiapkan diri kamu untuk UTBK SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?></a>.</h6>
                            <?php } elseif($result_kategori == 'Rendah') { ?>
                                <h6>Oleh karena itu, saran kami agar kamu segera mengganti jurusan yang kamu pilih di SNMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?>. Daftar rasionalisasi jurusan dapat dilihat tgl <?php echo format_indo_date($tanggal_rasionalisasi->tanggal); ?> Atau kamu bisa mengejar prodi tersebut lebih maksimal di UTBK - SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?>. <br /><a href="<?php echo base_url(); ?>click-grandsbmptn/<?php echo $identity; ?>" target="_blank">Yuk persiapkan diri kamu untuk UTBK SBMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?></a>.</h6>
                            <?php } ?>
                            </div>
                            <div class="mt-4 col-md-8 col-sm-12 offset-sm-2">
                                <h6>Rasionalisasi ini berdasar nilai KKM, Konsistensi Nilai, Akreditasi Sekolah, Prestasi akademik & Non Akademik, dan daya saing provinsi.</h6>
                                <h6>Ini adalah rasionalisasi prediksi awal, namun lebih memastikan perhitungan data lengkap kami, silahkan tunggu pengumuman di tanggal <?php echo format_indo_date($tanggal_rasionalisasi->tanggal); ?>.</h6>
                            </div>
                        </div>
                        <div class="mt-4">
                            <hr>
                        </div>
                        <div class="mt-3">
                        <h4>Rangkuman Data Kamu</h4>
                        <small>* Geser tabel ke kanan</small>
                        <table class="table table-hover table-bordered table-responsive text-center">
                            <tbody>
                                <!-- PERSONAL INFO -->
                                <?php foreach($personal_info as $pi){
                                    $nama_peserta = $pi->nama;
                                    $no_telp = $pi->no_telp;
                                    $email = $pi->email;
                                    $nama_sekolah = $pi->nama_sekolah;
                                    $jurusan_sekolah = $pi->nama_jurusan;
                                } ?>
                                <tr><td colspan="5" class="bg-info text-white" style="font-size:20px;">Personal Info</td></tr>
                                <tr>
                                    <td>Nama</td>
                                    <td colspan="4"><?php echo $nama_peserta; ?></td>
                                </tr>
                                <tr>
                                    <td>No Telp</td>
                                    <td colspan="4"><?php echo $no_telp; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td colspan="4"><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td>Sekolah</td>
                                    <td colspan="4"><?php echo $nama_sekolah; ?></td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td colspan="4"><?php echo $jurusan_sekolah; ?></td>
                                </tr>
                                <!-- NILAI SEMESTER -->
                                <?php foreach($nilai_semester as $ns){ ?>
                                <tr><td colspan="5" class="bg-info text-white" style="font-size:20px;">Nilai Semester</td></tr>
                                <tr class="bg-warning text-white">
                                    <td width="20%">Semester 1</td>
                                    <td width="20%">Semester 2</td>
                                    <td width="20%">Semester 3</td>
                                    <td width="20%">Semester 4</td>
                                    <td width="20%">Semester 5</td>
                                </tr>
                                <tr>
                                    <td><?php echo $ns->nilai_smt1; ?></td>
                                    <td><?php echo $ns->nilai_smt2; ?></td>
                                    <td><?php echo $ns->nilai_smt3; ?></td>
                                    <td><?php echo $ns->nilai_smt4; ?></td>
                                    <td><?php echo $ns->nilai_smt5; ?></td>
                                </tr>
                                <tr class="bg-warning text-white">
                                    <td width="20%">KKM 1</td>
                                    <td width="20%">KKM 2</td>
                                    <td width="20%">KKM 3</td>
                                    <td width="20%">KKM 4</td>
                                    <td width="20%">KKM 5</td>
                                </tr>
                                <tr>
                                    <td><?php echo $ns->kkm_smt1; ?></td>
                                    <td><?php echo $ns->kkm_smt2; ?></td>
                                    <td><?php echo $ns->kkm_smt3; ?></td>
                                    <td><?php echo $ns->kkm_smt4; ?></td>
                                    <td><?php echo $ns->kkm_smt5; ?></td>
                                </tr>
                                <?php } ?>
                                <!-- PRESTASI -->
                                <tr><td colspan="5" class="bg-info text-white" style="font-size:20px;">Prestasi</td></tr>
                                <tr class="bg-warning text-white">
                                    <td colspan="3">Nama</td>
                                    <td>Tingkat</td>
                                    <td>Juara</td>
                                </tr>
                                <?php if(!empty($prestasi)) { ?>
                                <?php foreach($prestasi as $p){ ?>
                                <tr>
                                    <td colspan="3"><?php echo strtoupper($p->nama); ?></td>
                                    <td><?php echo $p->nama_prestasi; ?></td>
                                    <td><?php echo $p->nama_juara; ?></td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <td colspan="5"><i>Tidak ada data</i></td>
                                <?php } ?>
                                <!-- PRODI -->
                                <tr><td colspan="5" class="bg-info text-white" style="font-size:20px;">Pilihan Program Studi</td></tr>
                                <tr class="bg-warning text-white">
                                    <td colspan="2">Universitas</td>
                                    <td colspan="2">Jurusan</td>
                                    <td>Alumni</td>
                                </tr>
                                <?php foreach($prodi as $pr){ ?>
                                <tr>
                                    <td colspan="2"><?php echo $pr->nama_universitas; ?></td>
                                    <td colspan="2"><?php echo $pr->nama_universitas_jurusan; ?></td>
                                    <td><?php echo $pr->jumlah_alumni; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
