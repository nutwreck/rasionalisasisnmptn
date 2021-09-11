<script type="text/javascript">
    var table;
    $(document).ready(function(){
        //datatables
        table = $('#table').DataTable({ 
            "oLanguage": {
              "sProcessing": "Mohon Tunggu..."
            },
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            
            "ajax": {
                "url": "<?php echo site_url('admin/master/sekolah/all')?>",
                "type": "POST"
            },

            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],

        });

        //kota_kabupaten
        $('#id_provinsi').change(function(){
            var csrfhash = document.getElementById('csrf-hash').innerHTML;
            var id_provinsi = $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>admin/Data_master/kota_kabupaten",
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
                    document.getElementById("csrf-hash").innerHTML = hash;
                    document.getElementById("csrf-hash-form").value = hash;
                    showSekolah();
                }
            });
        });
 
    });

    function add_data() {
        window.location.href = "<?php echo base_url(); ?>admin/master/add-sekolah";
    }
</script>