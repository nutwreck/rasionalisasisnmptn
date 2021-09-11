<script type="text/javascript">
    $(document).ready(function(){
        //kota_kabupaten
        $('#id_provinsi').change(function(){
            var csrfhash = document.getElementById('csrf-hash').innerHTML;
            var id_provinsi = $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>Peserta/kota_kabupaten",
                method : "POST",
                data : {id_provinsi: id_provinsi, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var hash = data.hash;
                    var respon = data.kota_kabupaten;
                    var i;
                    html += '<div class="col-sm-12">';
                    for(i=0; i<respon.length; i++){
                        html += '<option value="'+respon[i].id+'">'+respon[i].nama+'</option>';
                    }
                    html += '</div>';
                    $('#id_kota_kab').html(html);
                    $('#id_kota_kab').selectpicker('refresh');
                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                    showSekolah();
                }
            });
        });

        //sekolah
        $('#id_kota_kab').change(function(){
            showSekolah();
        });

        function showSekolah(){
            var csrfhash = document.getElementById('csrf-hash').innerHTML;
            var id_provinsi = $('#id_provinsi').val();
            var id_kota_kab = $('#id_kota_kab').val();
            $.ajax({
                url : "<?php echo base_url();?>Peserta/sekolah",
                method : "POST",
                data : {id_kota_kab: id_kota_kab, id_provinsi: id_provinsi, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var hash = data.hash;
                    var respon = data.sekolah;
                    var i;
                    html += '<div class="col-sm-12">';
                    for(i=0; i<respon.length; i++){
                        html += '<option data-content="<small>'+respon[i].nama+'</small>" value="'+respon[i].id+'">'+respon[i].nama+'</option>';
                    }
                    html += '</div>';
                    $('#id_sekolah').html(html);
                    $('#id_sekolah').selectpicker('refresh');
                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                }
            });
        }

        //Menambahkan data sekolah jika tidak terdaftar
        $('#id_sekolah').selectpicker({
            noneResultsText: '<small>Tidak menemukan sekolah kamu?</small> <button class="btn btn-sm btn-success" onclick=(add_school(this))>Tambahkan</button>'
        }); 
        
    });

    function add_school(event){
        var value = $(event).parents('div').siblings('.bs-searchbox').find('input').val(); // Ambil data terbaru
        var csrfhash = document.getElementById('csrf-hash').innerHTML;
        var id_provinsi = $('#id_provinsi').val();
        var id_kota_kab = $('#id_kota_kab').val();
        var id_peserta = $('#id_peserta').val();

        //Menambahkan data ke Database
        $.ajax({
                url : "<?php echo base_url();?>Peserta/menambahkan_sekolah_baru",
                method : "POST",
                data : {nama: value, id_kota_kab: id_kota_kab, id_provinsi: id_provinsi, id_peserta : id_peserta, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var hash = data.hash;
                    var respon_id = data.id_sekolah;
                    var respon_name = data.nama;

                    //Menambahkan Data ke Select Picker
                    /* $(event).parents('div').siblings('#id_sekolah').append($('<option></option>').text(value)).val(value); */
                    var options = [];
                    var option = "<option value="+respon_id+">" + respon_name + "</option>"
                    options.push(option);
                    $('#id_sekolah').html(options);
                    $('#id_sekolah').selectpicker('refresh');

                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                }
            });
    }
</script>