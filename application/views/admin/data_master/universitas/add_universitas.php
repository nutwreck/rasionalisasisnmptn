<!-- MAIN CONTENT-->
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Tambah Universitas</div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url(); ?>Admin/Data_master/submit_add_universitas" method="post" novalidate="novalidate">
                                        <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Provinsi</label>
                                                <select name="id_provinsi" id="id_provinsi" class="form-control">
                                                        <option value="0">-- PILIH --</option>
                                                        <?php foreach($provinsi as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Universitas</label>
                                                <input id="nama" name="nama" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Masukkan nama universitas" required>
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