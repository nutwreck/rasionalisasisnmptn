<script type="text/javascript">
    $(document).ready(function(){
        //kota_kabupaten
        $('#id_universitas_1').change(function(){
            var csrfhash = document.getElementById('csrf-hash').innerHTML;
            var id_universitas_1 = $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>Peserta/universitas_jurusan",
                method : "POST",
                data : {id_universitas: id_universitas_1, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var hash = data.hash;
                    var respon = data.universitas_jurusan;
                    var i;
                    html += '<div class="col-sm-12">';
                    for(i=0; i<respon.length; i++){
                        html += '<option value="'+respon[i].id+'">'+respon[i].nama+'</option>';
                    }
                    html += '</div>';
                    $('#id_universitas_jurusan_1').html(html);
                    $('#id_universitas_jurusan_1').selectpicker('refresh');
                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                }
            });
        });
        $('#id_universitas_2').change(function(){
            var csrfhash = document.getElementById('csrf-hash').innerHTML;
            var id_universitas_2 = $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>Peserta/universitas_jurusan",
                method : "POST",
                data : {id_universitas: id_universitas_2, <?php echo $this->security->get_csrf_token_name(); ?>: csrfhash},
                async : false,
                cache: false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var hash = data.hash;
                    var respon = data.universitas_jurusan;
                    var i;
                    html += '<div class="col-sm-12">';
                    for(i=0; i<respon.length; i++){
                        html += '<option value="'+respon[i].id+'">'+respon[i].nama+'</option>';
                    }
                    html += '</div>';
                    $('#id_universitas_jurusan_2').html(html);
                    $('#id_universitas_jurusan_2').selectpicker('refresh');
                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                }
            });
        });
    });
</script>