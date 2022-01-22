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
                <div class="card mb-4">
                    <div class="card-header text-center bg-info text-info font-kg-happy"><h4>Hasil Kamu</h4></div>
                    <div class="card-body text-center">
                        <div>
                            <h3>Hai, <?php echo $nama_peserta; ?></h3>
                        </div>
                        <div class="mt-3">
                            <img class="circle" src="<?php echo base_url(); ?>assets/images/result/grandsbmptn2022.png" alt="grandsbmptn" />
                        </div>
                        <?php foreach($prodi_pertama as $prt){ 
                            $prodi_pertama = $prt->nama_universitas_jurusan;
                        } ?>
                        <div class="mt-3">
                            <h5>
                                Terima kasih sudah mendaftar</br>
                                Rasionalisasi SNMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?>. Hasil</br>
                                Rasionalisasi dapat dilihat pada tanggal
                            </h5>

                            <div class="mt-4 col-md-6 col-sm-6 offset-sm-3 text-center tanggal_hasil">
                                <h2><?php echo format_indo_date($tanggal_rasionalisasi->tanggal); ?></h2>
                            </div>

                            <h5 class="mt-5">
                                melalui Instagram</br>
                                @zambertclass_utbk
                            </h5>

                            <h5 class="mt-4 mb-3">
                                Perlu diingat bahwa program Rasionalisasi</br>
                                ini merupakan prediksi dari tim</br>
                                @zambertclass_utbk dan bukan hasil</br>
                                resmi SNMPTN <?php echo date("Y", strtotime($tanggal_rasionalisasi->tanggal)); ?>.
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
