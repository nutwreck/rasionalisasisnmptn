<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Master Jurusan Sekolah</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button id="add" class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="add_data()">
                                <i class="zmdi zmdi-plus"></i>Input Data</button>
                            <!-- <button id="add_all" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Import Excel</button>
                            <button id="delete_all" class="au-btn au-btn-icon btn-danger au-btn--small">
                                <i class="zmdi zmdi-minus"></i>Delete All</button></a>
                            <label class="text-wrap">* Import sesuai header kolom dibawah ini tanpa nomor, isi status data 1 jika aktif dan 0 tidak aktif</label> -->
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                    <table id="table_jurusan_sekolah" class="display text-center">
                        <thead>
                            <tr>
                                <th width="20px">No</th>
                                <th>Nama Jurusan</th>
                                <th>Status Data</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                                foreach($all_sekolah_jurusan as $value){ ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $value->nama; ?></td>
                                <td><?php if($value->is_enable == 1){ echo 'Aktif'; } else { echo 'Tidak Aktif'; }; ?></td>
                                <td>
                                    <?php if($value->is_enable == 1) { ?>
                                    <div class="table-data-feature">
                                        <a href="<?php echo base_url(); ?>admin/master/update-jurusan-sekolah/<?php echo $value->id; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="<?php echo base_url(); ?>admin/master/delete-jurusan-sekolah/<?php echo $value->id; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    </div>
                                    <?php } else { ?>
                                    <div class="table-data-feature">
                                        <a href="<?php echo base_url(); ?>admin/master/active-jurusan-sekolah/<?php echo $value->id; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Active">
                                            <i class="zmdi zmdi-check"></i>
                                        </a>
                                </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>