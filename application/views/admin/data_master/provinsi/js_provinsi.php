<script>
$(document).ready(function() {
    $('#table_provinsi').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Master Provinsi'
            }
        ]
    } );
} );

function add_data() {
    window.location.href = "<?php echo base_url(); ?>admin/master/add-provinsi";
}
</script>