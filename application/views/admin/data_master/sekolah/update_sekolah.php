<!-- MAIN CONTENT-->
<?php 
    foreach($get_sekolah as $value){
        $id = $value->id;
        $nama = $value->nama;
        $id_provinsi = $value->id_provinsi;
        $nama_provinsi = $value->nama_provinsi;
        $id_kota_kab = $value->id_kota_kab;
        $nama_kota_kab = $value->nama_kota_kab;
        $id_akreditasi = $value->id_akreditasi;
        $nama_akreditasi = $value->nama_akreditasi;
    }
?>
<p id="csrf-hash" style="display: none"><?=$this->security->get_csrf_hash();?></p>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Update Data Sekolah</div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url(); ?>Admin/Data_master/submit_update_sekolah" method="post" novalidate="novalidate">
                                        <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <input type="hidden" id="id" name="id" placeholder ="id" value="<?php echo $id; ?>">
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Provinsi</label>
                                                <select name="id_provinsi" id="id_provinsi" class="form-control" required>
                                                        <option value="<?php echo $id_provinsi; ?>"><?php echo $nama_provinsi; ?></option>
                                                        <?php foreach($provinsi as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Kota / Kabupaten</label>
                                                <select name="id_kota_kab" id="id_kota_kab" class="form-control" required>
                                                    <option value="<?php echo $id_kota_kab; ?>"><?php echo $nama_kota_kab; ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Sekolah</label>
                                                <input id="nama" name="nama" type="text" class="form-control" value="<?php echo $nama; ?>" aria-required="true" aria-invalid="false" placeholder="Masukkan nama Kota/Kab" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Akreditasi</label>
                                                <select name="id_akreditasi" id="id_akreditasi" class="form-control" required>
                                                        <option value="<?php echo $id_akreditasi; ?>"><?php echo $nama_akreditasi; ?></option>
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