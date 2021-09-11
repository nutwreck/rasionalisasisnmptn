<section class="mt-3 mb-3">
    <h3 class="text-center font-kg-happy">Rasionalisasi SNMPTN</h3>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="msform">
                    <ul id="progressbar">
                        <li class="active" id="personalinfo"><strong class="font-arial-rounded">Personal Info</strong></li>
                        <li id="nilairaport"><strong class="font-arial-rounded">Nilai Raport</strong></li>
                        <li id="prestasi"><strong class="font-arial-rounded">Prestasi</strong></li>
                        <li id="prodi"><strong class="font-arial-rounded">Program Studi</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>Personal Info</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <form method="POST" action="<?=site_url('personal-info')?>" class="form-horizontal" role="form">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo $id_peserta; ?>" style="display: none">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Kamu" required>
                            </div>
                            <div class="form-group">
                                <label for="instagram">Akun Instagram <small>(Optional)</small></label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Masukkan Akun IG Kamu">
                            </div>
                            <div class="form-group">
                                <label for="telegram">Telegram <small>(Optional)</small></label>
                                <input type="text" class="form-control" id="telegram" name="telegram" placeholder="Masukkan Telegram Kamu">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="id_provinsi">Asal Provinsi Sekolah</label>
                                <select class="selectpicker form-control" id="id_provinsi" name="id_provinsi" data-live-search="true" required>
                                    <option value="">-PILIH-</option>
                                    <?php foreach($provinsi as $provinsi_x) {
                                        echo "<option value=".$provinsi_x->id.">".$provinsi_x->nama."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kota_kab">Asal Kabupaten Sekolah</label>
                                <select class="selectpicker form-control" id="id_kota_kab" name="id_kota_kab" data-live-search="true">
                                    <option value="">-PILIH-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_sekolah">Asal Sekolah <br /><small><b>* Jika sekolah kamu tidak ditemukan, ketik nama sekolah kamu lengkap dan klik tambahkan.</b> (<i class="bg-danger text-white">Pastikan nama sekolah yang kamu ketik benar karena akan kami simpan</i>)</small></label>
                                <select class="selectpicker form-control" id="id_sekolah" name="id_sekolah" data-live-search="true" required>
                                    <option value="">-PILIH-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_sekolah_jurusan">Jurusan</label>
                                <select class="selectpicker form-control" id="id_sekolah_jurusan" name="id_sekolah_jurusan" required>
                                    <option value="">-PILIH-</option>
                                    <?php foreach($sekolah_jurusan as $sekolah_jurusan_x) {
                                        echo "<option value=".$sekolah_jurusan_x->id.">".$sekolah_jurusan_x->nama."</option>";
                                    } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Simpan & Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
