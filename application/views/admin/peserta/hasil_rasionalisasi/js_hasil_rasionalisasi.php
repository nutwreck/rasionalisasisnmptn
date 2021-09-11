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
                "url": "<?php echo site_url('admin/hasil-rasionalisasi/all')?>",
                "type": "POST"
            },

            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],

        });
    });

    function download_excel() {
        window.location.href = "<?php echo base_url(); ?>admin/hasil-rasionalisasi/download-excel";
    }
</script>