<section class="mt-3 mb-3">
    <h3 class="text-center font-kg-happy">Rasionalisasi SNMPTN</h3>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="msform">
                    <ul id="progressbar">
                        <li id="nilairaport"><strong class="font-arial-rounded">Nilai Raport</strong></li>
                        <li class="active" id="prestasi"><strong class="font-arial-rounded">Prestasi</strong></li>
                        <li id="prodi"><strong class="font-arial-rounded">Program Studi</strong></li>
                        <li id="hasil"><strong class="font-arial-rounded">Hasil Rasionalisasi</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>Prestasi</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <label class="text-info">* Masukkan Nama, Tingkat dan Juara Lomba. Kosongkan jika tidak ada prestasi</label>
                        <form method="POST" action="<?=site_url('prestasi-submit')?>" class="form-horizontal" role="form">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id_peserta" name="id_peserta" placeholder ="id_peserta" value="<?php echo $id_peserta; ?>">
                            <label>Prestasi</label>
                            <div class="form-group element" id="div_1">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="nama_1" name="nama[]" placeholder="Nama Lomba" >
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control" id="prestasi_option" name="id_prestasi[]" >
                                            <option value="">-TINGKAT-</option>
                                            <?php foreach($prestasi as $prestasi_x) {
                                                echo "<option value=".$prestasi_x->id.">".$prestasi_x->nama."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control" id="juara_option" name="id_juara[]" >
                                            <option value="">-JUARA-</option>
                                            <?php foreach($juara as $juara_x) {
                                                echo "<option value=".$juara_x->id.">".$juara_x->nama."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-2 text-center">
                                        <span class="btn btn-md btn-success add"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Simpan & Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>