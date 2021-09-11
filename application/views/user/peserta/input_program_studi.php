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
                        <li class="active" id="prodi"><strong class="font-arial-rounded">Program Studi</strong></li>
                        <li id="hasil"><strong class="font-arial-rounded">Hasil Rasionalisasi</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>Program Studi</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <form method="POST" action="<?=site_url('prodi-submit')?>" class="form-horizontal" role="form">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id_peserta" name="id_peserta" placeholder ="id_peserta" value="<?php echo $id_peserta; ?>">
                            <h4 class="text-center">Pilihan 1</h4>
                            <div class="form-group">
                                <label for="id_universitas">Nama Universitas</label>
                                <select class="selectpicker form-control" id="id_universitas_1" name="id_universitas[]" data-live-search="true" required>
                                    <option value="">-PILIH-</option>
                                    <?php foreach($universitas as $universitas_x) {
                                        echo "<option value=".$universitas_x->id.">".$universitas_x->nama."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_universitas_jurusan">Program Studi</label>
                                <select class="selectpicker form-control" id="id_universitas_jurusan_1" name="id_universitas_jurusan[]" data-live-search="true" required>
                                    <option value="">-PILIH-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_alumni">Jumlah Alumni</label><br />
                                <small>(Jumlah Alumni yang diterima di Prodi PTN tersebut)</small>
                                <input type="number" class="form-control" id="jumlah_alumni_1" name="jumlah_alumni[]" placeholder="Jumlah Alumni Sebelumnya" value="0" required>
                            </div>
                            <hr>
                            <h4 class="text-center">Pilihan 2</h4>
                            <div class="form-group">
                                <label for="id_universitas">Nama Universitas</label>
                                <select class="selectpicker form-control" id="id_universitas_2" name="id_universitas[]" data-live-search="true">
                                    <option value="">-PILIH-</option>
                                    <?php foreach($universitas as $universitas_x) {
                                        echo "<option value=".$universitas_x->id.">".$universitas_x->nama."</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_universitas_jurusan">Program Studi</label>
                                <select class="selectpicker form-control" id="id_universitas_jurusan_2" name="id_universitas_jurusan[]" data-live-search="true">
                                    <option value="">-PILIH-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_alumni">Jumlah Alumni</label><br />
                                <small>(Jumlah Alumni yang diterima di Prodi PTN tersebut)</small>
                                <input type="number" class="form-control" id="jumlah_alumni_2" name="jumlah_alumni[]" placeholder="Jumlah Alumni Sebelumnya">
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Simpan & Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
