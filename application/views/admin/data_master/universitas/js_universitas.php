<script>
$(document).ready(function() {
    $('#table_universitas').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Master Universitas'
            }
        ]
    } );
} );

function add_data() {
    window.location.href = "<?php echo base_url(); ?>admin/master/add-universitas";
}
</script>