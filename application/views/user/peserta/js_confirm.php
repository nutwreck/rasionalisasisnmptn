<script>
    $(document).ready(function(){
        $(".inputs").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('.inputs').focus();
            }
        });

        setTimeout(() => { document.getElementById("kolom1").value = "<?php echo $otp1; ?>"; }, 200);
        setTimeout(() => { document.getElementById("kolom2").value = "<?php echo $otp2; ?>"; }, 300);
        setTimeout(() => { document.getElementById("kolom3").value = "<?php echo $otp3; ?>"; }, 400);
        setTimeout(() => { document.getElementById("kolom4").value = "<?php echo $otp4; ?>"; }, 500);
        setTimeout(() => { document.getElementById("kolom5").value = "<?php echo $otp5; ?>"; }, 600);
        setTimeout(() => { document.getElementById("kolom6").value = "<?php echo $otp6; ?>"; }, 700);
        setTimeout(() => { verifikasi(); }, 800);

        var datecount = document.getElementById("otp_expired").value;

        dateexpiredcountdown(datecount);
    });

    
    function dateexpiredcountdown(datecount){
        // Mengatur waktu akhir perhitungan mundur
        /* var datecount = document.getElementById("otp_expired").value; */
        var countDownDate = new Date(datecount).getTime();

        // Memperbarui hitungan mundur setiap 1 detik
        var x = setInterval(function() {

            // Untuk mendapatkan tanggal dan waktu hari ini
            var now = new Date().getTime();

            // Temukan jarak antara sekarang dan tanggal hitung mundur
            var distance = countDownDate - now;

            // Perhitungan waktu untuk hari, jam, menit dan detik
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Keluarkan hasil dalam elemen dengan id = "demo"

                var countdown = "<small class='d-block mobile-timer text-center'>"+minutes+":"+seconds+"</small>";

                document.getElementById("countdown-ex3").innerHTML = countdown;
                /* document.getElementById("countdown-ex3_2").innerHTML = countdown; */

            // Jika hitungan mundur selesai, tulis beberapa teks
            if (distance < 0) {
                var csrfhash = document.getElementById('csrf-hash').innerHTML;
                var id_peserta = $('#id_peserta').val();
                $.ajax({
                    url : "<?php echo base_url();?>Peserta/verification_expired",
                    method : "POST",
                    data : {id_peserta: id_peserta, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                    async : false,
                    cache: false,
                    dataType : 'json',
                    success: function(data){
                        var hash = data.hash;
                        var log = data.log;
                        document.getElementById("csrf-hash").innerHTML = hash;

                        if(log != 1){
                            document.getElementById("msg").innerHTML = "#error code #{Module update otp not work}";
                        } else {
                            document.getElementById("msg").innerHTML = "";
                        }
                        
                    }
                });
                clearInterval(x);
                document.getElementById("kirim-ulang").innerHTML = "Kirim Ulang";
                document.getElementById("kirim-ulang-header").innerHTML = "Tidak menerima kode verifikasi?";
                document.getElementById("countdown-ex3").innerHTML = "<small class='d-block mobile-text text-center text-danger'>Batas waktu konfirmasi habis</small>";
            }
        }, 1000);
    }
    

    function kirimulang() {
        var csrfhash = document.getElementById('csrf-hash').innerHTML;
        var id_peserta = $('#id_peserta').val();

        $.ajax({
            url : "<?php echo base_url();?>Peserta/verification_reset",
            method : "POST",
            data : {id_peserta: id_peserta, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
            async : false,
            cache: false,
            dataType : 'json',
            success: function(data){
                var hash = data.hash;
                var log = data.log;
                var update_expired = data.otp_expired;
                document.getElementById("csrf-hash").innerHTML = hash;

                if(log == 0){
                    document.getElementById("msg").innerHTML = "#error code #{Module update otp not work}";
                } else if(log == 2){
                    document.getElementById("msg").innerHTML = "<small class='d-block mobile-text text-center text-danger'>Maksimal kirim ulang verifikasi hanya 1 kali</small>";
                    document.getElementById("kolom1").value = "";
                    document.getElementById("kolom2").value = "";
                    document.getElementById("kolom3").value = "";
                    document.getElementById("kolom4").value = "";
                    document.getElementById("kolom5").value = "";
                    document.getElementById("kolom6").value = "";
                    document.getElementById("kirim-ulang").innerHTML = "";
                    document.getElementById("kirim-ulang-header").innerHTML = "";
                    document.getElementById("countdown-ex3").innerHTML = "";
                } else {
                    document.getElementById("kolom1").value = "";
                    document.getElementById("kolom2").value = "";
                    document.getElementById("kolom3").value = "";
                    document.getElementById("kolom4").value = "";
                    document.getElementById("kolom5").value = "";
                    document.getElementById("kolom6").value = "";
                    document.getElementById("msg").innerHTML = "";
                    document.getElementById("kirim-ulang").innerHTML = "";
                    document.getElementById("kirim-ulang-header").innerHTML = "";
                    document.getElementById("countdown-ex3").innerHTML = "";
                    location.reload();
                }
                
            }
        });
    }

    function verifikasi() {
        var csrfhash = document.getElementById('csrf-hash').innerHTML;
        var id_peserta = $('#id_peserta').val();
        var kolom1 = document.getElementById("kolom1").value;
        var kolom2 = document.getElementById("kolom2").value;
        var kolom3 = document.getElementById("kolom3").value;
        var kolom4 = document.getElementById("kolom4").value;
        var kolom5 = document.getElementById("kolom5").value;
        var kolom6 = document.getElementById("kolom6").value;
        var code_input = kolom1.concat(kolom2, kolom3, kolom4, kolom5, kolom6);
        var n = code_input.length;
        if(n == 6){
            $.ajax({
                url : "<?php echo base_url();?>Peserta/verification_code",
                method : "POST",
                data : {otp: code_input, id_peserta: id_peserta, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var hash = data.hash;
                    var log = data.log;
                    var text = data.text;
                    var id_peserta = data.id_peserta;
                    document.getElementById("csrf-hash").innerHTML = hash;

                    if(log != 1){
                        document.getElementById("msg").innerHTML = text;
                    } else {
                        window.location = '<?php echo site_url();?>confirm-success/'+id_peserta;
                    }
                }
            });
        } else {
            document.getElementById("msg").innerHTML = "<small class='text-danger'>#the way you input is wrong, eror input{all fields are required}</small>";
        }
    }
</script>