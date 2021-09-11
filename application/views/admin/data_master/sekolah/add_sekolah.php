<!-- MAIN CONTENT-->
<p id="csrf-hash" style="display: none"><?=$this->security->get_csrf_hash();?></p>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Tambah Data Sekolah</div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url(); ?>Admin/Data_master/submit_add_sekolah" method="post" novalidate="novalidate">
                                        <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Provinsi</label>
                                                <select name="id_provinsi" id="id_provinsi" class="form-control" required>
                                                        <option value="0">-- PILIH --</option>
                                                        <?php foreach($provinsi as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Kota / Kabupaten</label>
                                                <select name="id_kota_kab" id="id_kota_kab" class="form-control" required>
                                                        <option value="">-- PILIH --</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Sekolah</label>
                                                <input id="nama" name="nama" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Masukkan nama Kota/Kab" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Akreditasi</label>
                                                <select name="id_akreditasi" id="id_akreditasi" class="form-control" required>
                                                        <option value="0">-- PILIH --</option>
                                                        <?php foreach($akreditasi as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-check fa-lg"></i>&nbsp;
                                                    <span>Submit</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>