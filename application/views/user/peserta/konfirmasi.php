<div class="d-flex justify-content-center align-items-center container">
    <div class="card py-5 px-3">
        <h5 class="m-0 mb-2 text-center">Verifikasi Nomor Telepon</h5>
        <span class="mobile-text">Masukkan kode verifikasi yang kita kirimkan ke nomor kamu <b class="text-danger"><?php echo $no_telp; ?></b> melalui SMS</span>
        <div class="d-flex flex-row mt-5">
            <p id="csrf-hash" style="display: none"><?php echo $this->security->get_csrf_hash(); ?></p>
            <input type="hidden" id="id_peserta" name="id_peserta" placeholder ="id_peserta" value="<?php echo $id_peserta; ?>">
            <input type="hidden" id="otp_expired" name="otp_expired" placeholder ="otp_expired" value="<?php echo $otp_expired; ?>">
            <input type="number" id="kolom1" class="inputs form-control text-center" autofocus="" maxlength="1" required>
            <input type="number" id="kolom2" class="inputs form-control text-center" maxlength="1" required>
            <input type="number" id="kolom3" class="inputs form-control text-center" maxlength="1" required>
            <input type="number" id="kolom4" class="inputs form-control text-center" maxlength="1" required>
            <input type="number" id="kolom5" class="inputs form-control text-center" maxlength="1" required>
            <input type="number" id="kolom6" class="inputs form-control text-center" maxlength="1" required>
        </div>
        <div class="text-center mt-4">
            <div id="msg"></div>
            <div id="countdown-ex3"></div>
            <span id="kirim-ulang-header" class="d-block mobile-text"></span>
            <span id="kirim-ulang" class="font-weight-bold text-danger cursor" onclick="kirimulang()"></span>
        </div>
    </div>
</div>