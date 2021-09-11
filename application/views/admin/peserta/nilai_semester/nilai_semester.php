<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Data Nilai Semester</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <button id="download_excel" class="au-btn au-btn-icon au-btn--green au-btn--small" onclick="download_excel()">
                                <i class="zmdi zmdi-download"></i>Excel</button>
                            <!-- <button id="delete_all" class="au-btn au-btn-icon btn-danger au-btn--small">
                                <i class="zmdi zmdi-minus"></i>Delete All</button></a>
                            <label class="text-wrap">* Import sesuai header kolom dibawah ini tanpa nomor, isi status data 1 jika aktif dan 0 tidak aktif</label> -->
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <table id="table" class="display text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr> 
                                <th rowspan="2">No</th>
                                <th rowspan="2">Peserta</th>
                                <th colspan="2">Semester 1</th> 
                                <th colspan="2">Semester 2</th> 
                                <th colspan="2">Semester 3</th> 
                                <th colspan="2">Semester 4</th> 
                                <th colspan="2">Semester 5</th> 
                            </tr> 
                            <tr> 
                                <th>Nilai</th> 
                                <th>KKM</th>
                                <th>Nilai</th> 
                                <th>KKM</th>
                                <th>Nilai</th> 
                                <th>KKM</th>
                                <th>Nilai</th> 
                                <th>KKM</th>
                                <th>Nilai</th> 
                                <th>KKM</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>