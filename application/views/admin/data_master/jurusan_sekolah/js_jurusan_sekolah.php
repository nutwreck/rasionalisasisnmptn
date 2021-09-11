<script>
$(document).ready(function() {
    $('#table_jurusan_sekolah').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Master Jurusan Sekolah'
            }
        ]
    } );
} );

function add_data() {
    window.location.href = "<?php echo base_url(); ?>admin/master/add-jurusan-sekolah";
}
</script>