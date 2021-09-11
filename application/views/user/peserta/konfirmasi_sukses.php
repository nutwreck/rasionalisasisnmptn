<div class="d-flex justify-content-center align-items-center container">
    <div class="card py-5 px-3">
        <h3 class="m-0 mb-2 text-center">Verifikasi Berhasil</h3>
        <div class="text-center mt-4">
            <img src="<?php echo base_url(); ?>assets/images/icon/checked.png" alt="success" class="rounded mx-auto d-block wow pulse">
        </div>
        <div class="text-center mt-2 mb-2">
            <input type="hidden" id="id_peserta" name="id_peserta" placeholder ="id_peserta" value="<?php echo $id_peserta; ?>">
            <div id="loading"><img src="<?php echo base_url(); ?>assets/images/icon/loaderIcon.gif" width="15" height="15"></div>
            <div id="alihkan" class="font-weight-bold"></div>
        </div>
    </div>
</div>