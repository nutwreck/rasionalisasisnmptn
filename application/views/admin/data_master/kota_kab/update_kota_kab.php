<!-- MAIN CONTENT-->
<?php 
    foreach($get_kota_kab as $value){
        $id = $value->id;
        $id_provinsi = $value->id_provinsi;
        $nama = $value->nama;
        $nama_provinsi = $value->nama_provinsi;
    }
?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Update Data Kota/Kabupaten</div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url(); ?>Admin/Data_master/submit_update_kota_kab" method="post" novalidate="novalidate">
                                        <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <input type="hidden" id="id" name="id" placeholder ="id" value="<?php echo $id; ?>">
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Provinsi</label>
                                                <select name="id_provinsi" id="id_provinsi" class="form-control">
                                                        <option value="<?php echo $value->id_provinsi; ?>"><?php echo $value->nama_provinsi; ?></option>
                                                        <?php foreach($provinsi as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Provinsi</label>
                                                <input id="nama" name="nama" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Masukkan nama provinsi" value="<?php echo $nama; ?>" required>
                                            </div>
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