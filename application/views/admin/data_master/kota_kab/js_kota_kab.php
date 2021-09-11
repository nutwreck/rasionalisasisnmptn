<script>
$(document).ready(function() {
    $('#table_kota_kab').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Master Kota/Kabupaten'
            }
        ]
    } );
} );

function add_data() {
    window.location.href = "<?php echo base_url(); ?>admin/master/add-kota-kab";
}
</script>