<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Master Program Studi</h3>
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
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <table id="table" class="display responsive nowrap text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Universitas</th>
                                <th>Kode</th>
                                <th>Nama Prodi</th>
                                <th>Group Prodi</th>
                                <th>Nama Wilayah</th>
                                <th>Daya Tampung</th>
                                <th>Nilai Raport</th>
                                <th>Status Data</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>