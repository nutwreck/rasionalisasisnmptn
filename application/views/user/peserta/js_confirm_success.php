<script>
    $(document).ready(function(){
        var id_peserta = $('#id_peserta').val();
        setTimeout(() => { $('#alihkan').html('Tunggu ya.'); }, 1500);
        setTimeout(() => { $('#alihkan').html('Tunggu ya..'); }, 1700);
        setTimeout(() => { $('#alihkan').html('Tunggu ya...'); }, 1900);
        setTimeout(() => { $('#alihkan').html('Yuk Mulai Input Data Kamu!'); }, 5000);
        setTimeout(() => { window.location = '<?php echo site_url();?>register-personal-info/'+id_peserta; }, 6500);
    });
</script>