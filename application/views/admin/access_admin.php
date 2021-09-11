<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Access Admin</div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>admin/Home/submit_update_access_admin" method="post" novalidate="novalidate">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="hidden" id="id" name="id" placeholder ="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="username" class="control-label mb-1">Username</label>
                                    <input id="username" name="username" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Masukkan Username" value="<?php echo $username; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label mb-1">Password</label>
                                    <input id="password" name="password" type="password" class="form-control" aria-required="true" aria-invalid="false" placeholder="Masukkan Password" value="<?php echo $password; ?>" required>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Tanggal Pengumuman Rasionalisasi</div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>admin/Home/submit_update_tanggal_pengumuman" method="post" novalidate="novalidate">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="hidden" id="id" name="id" placeholder ="id" value="<?php echo $id_tanggal; ?>">
                                <div class="form-group">
                                    <label for="tanggal" class="control-label mb-1">Update Tanggal</label><br />
                                    <small class="text-info">* Tanggal ini ditampilkan dihasil akhir rasionalisasi sebagai tanggal pengumuman hasil SNMPTN</small>
                                    <input id="datepicker" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
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
