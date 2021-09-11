<section class="mt-3 mb-3">
    <h3 class="text-center font-kg-happy">Rasionalisasi SNMPTN</h3>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center text-white bg-info font-kg-happy"><h4>Registrasi</h4></div>
                    <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
                    <div class="card-body">
                        <form method="POST" action="<?=site_url('register')?>" class="form-horizontal" role="form">
                            <input type="hidden" id="csrf-hash-form" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" oninput="this.value=this.value.replace(/[^A-Za-z' ]/g,'');" placeholder="Masukkan Nama Lengkap Kamu" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'');" minlength="10" maxlength="13" pattern=".{10,13}" title="Minimal 10 Nomor Maksimal 13 Nomor" id="no_telp" name="no_telp" aria-describedby="noTelpHelp" placeholder="Masukkan Nomor Telepon Kamu (Ex: 085826XXXXXX)" required>
                                <small id="noTelpHelp" class="form-text text-muted">Apakah nomor tersebut sudah benar? (kami akan mengirimkan info dari nomor Hp yang kamu masukkan).</small>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Simpan & Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
