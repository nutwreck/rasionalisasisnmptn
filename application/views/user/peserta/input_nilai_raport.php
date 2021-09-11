<section class="mt-3 mb-3">
    <h3 class="text-center font-kg-happy">Rasionalisasi SNMPTN</h3>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="msform">
                    <ul id="progressbar">
                        <li class="active" id="nilairaport"><strong class="font-arial-rounded">Nilai Raport</strong></li>
                        <li id="prestasi"><strong class="font-arial-rounded">Prestasi</strong></li>
                        <li id="prodi"><strong class="font-arial-rounded">Program Studi</strong></li>
                        <li id="hasil"><strong class="font-arial-rounded">Hasil Rasionalisasi</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>Nilai Raport</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <label class="text-info">* Masukkan Nilai, KKM Nilai dan Foto Nilai Kamu</label><br />
                        <label class="text-info">* Upload foto nilai optional, jika tetap ingin upload, baca ketentuan dibawah</label><br />
                        <label class="text-info">* Ketentuan untuk foto nilai : </label> <br />
                        <ul class="text-info">
                            <li>JPG/PNG maksimal 500KB tiap semester</li>
                            <li>Semua mata pelajaran dalam satu semester dijadikan dalam 1 foto untuk tiap semesternya</li>
                        </ul>
                        <form method="POST" action="<?=site_url('raport-submit')?>" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id_peserta" name="id_peserta" placeholder ="id_peserta" value="<?php echo $id_peserta; ?>">
                            <div class="form-group">
                                <label>Semester 1</label>
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="nilai_smt1" name="nilai_smt1" placeholder="Nilai Semester 1" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="kkm_smt1" name="kkm_smt1" placeholder="KKM Semester 1" step="0.01" required>
                                    </div>
                                    <div class="col-sm">
                                        <input type="file" class="form-control form-control-sm" id="img_smt[]" name="img_smt[]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester 2</label>
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="nilai_smt2" name="nilai_smt2" placeholder="Nilai Semester 2" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="kkm_smt2" name="kkm_smt2" placeholder="KKM Semester 2" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="file" class="form-control form-control-sm" id="img_smt[]" name="img_smt[]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester 3</label>
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="nilai_smt3" name="nilai_smt3" placeholder="Nilai Semester 3" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="kkm_smt3" name="kkm_smt3" placeholder="KKM Semester 3" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="file" class="form-control form-control-sm" id="img_smt[]" name="img_smt[]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester 4</label>
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="nilai_smt4" name="nilai_smt4" placeholder="Nilai Semester 4" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="kkm_smt4" name="kkm_smt4" placeholder="KKM Semester 4" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="file" class="form-control form-control-sm" id="img_smt[]" name="img_smt[]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester 5</label>
                                <div class="row">
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="nilai_smt5" name="nilai_smt5" placeholder="Nilai Semester 5" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="number" class="form-control" id="kkm_smt5" name="kkm_smt5" placeholder="KKM Semester 5" step="0.01" required>
                                    </div>
                                    <div class="col-sm mb-2">
                                        <input type="file" class="form-control form-control-sm" id="img_smt[]" name="img_smt[]">
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
