<!-- MAIN CONTENT-->
<?php 
    foreach($get_jurusan_universitas as $value){
        $id = $value->id;
        $nama = $value->nama;
        $id_wilayah = $value->id_wilayah;
        $nama_wilayah = $value->nama_wilayah;
        $id_universitas = $value->id_universitas;
        $nama_universitas = $value->nama_universitas;
        $nama_jurusan_group = $value->nama_jurusan_group;
        $kode = $value->kode;
        $tahun = $value->tahun;
        $daya_tampung = $value->daya_tampung;
        $nilai_raport = $value->nilai_raport;
    }
?>
<p id="csrf-hash" style="display: none"><?=$this->security->get_csrf_hash();?></p>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Update Data Program Studi</div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url(); ?>Admin/Data_master/submit_update_jurusan_universitas" method="post" novalidate="novalidate">
                                        <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <input type="hidden" id="id" name="id" placeholder ="id" value="<?php echo $id; ?>">
                                            <div class="form-group">
                                                <label for="tahun" class="control-label mb-1">Tahun</label>
                                                <input id="tahun" name="tahun" type="number" class="form-control" aria-required="true" value="<?php echo $tahun; ?>" aria-invalid="false" placeholder="Masukkan tahun berlaku" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_jurusan_group" class="control-label mb-1">Prodi Group</label>
                                                <select name="id_jurusan_group" id="id_jurusan_group" class="form-control" required>
                                                        <option value="<?php echo $id_jurusan_group; ?>"><?php echo $nama_jurusan_group; ?></option>
                                                        <?php foreach($jurusan_group as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_wilayah" class="control-label mb-1">Wilayah</label>
                                                <select name="id_wilayah" id="id_wilayah" class="form-control" required>
                                                        <option value="<?php echo $id_wilayah; ?>"><?php echo $nama_wilayah; ?></option>
                                                        <?php foreach($wilayah as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_universitas" class="control-label mb-1">Universitas</label>
                                                <select name="id_universitas" id="id_universitas" class="form-control" required>
                                                        <option value="<?php echo $id_universitas; ?>"><?php echo $nama_universitas; ?></option>
                                                        <?php foreach($universitas as $value){ ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kode" class="control-label mb-1">Kode Prodi</label>
                                                <input id="kode" name="kode" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $kode; ?>" placeholder="Masukkan kode prodi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="control-label mb-1">Nama Prodi</label>
                                                <input id="nama" name="nama" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $nama; ?>" placeholder="Masukkan nama prodi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="daya_tampung" class="control-label mb-1">Daya Tampung</label>
                                                <input id="daya_tampung" name="daya_tampung" type="number" class="form-control" aria-required="true" value="<?php echo $daya_tampung; ?>" aria-invalid="false" placeholder="Masukkan daya tampung" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nilai_raport" class="control-label mb-1">Nilai Raport Prodi</label>
                                                <input id="nilai_raport" name="nilai_raport" type="number" class="form-control" aria-required="true" value="<?php echo $nilai_raport; ?>" aria-invalid="false" placeholder="Masukkan nilai raport" required>
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