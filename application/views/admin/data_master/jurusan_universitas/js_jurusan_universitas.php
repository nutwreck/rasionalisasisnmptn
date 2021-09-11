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
                "url": "<?php echo site_url('admin/master/prodi/all')?>",
                "type": "POST"
            },

            "responsive": true,

            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],

        });
 
    });

    function add_data() {
        window.location.href = "<?php echo base_url(); ?>admin/master/add-prodi";
    }
</script>