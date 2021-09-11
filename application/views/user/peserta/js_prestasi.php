<script type="text/javascript">
    $(document).ready(function(){
        //add element
        $(".add").click(function(){
            var total_element = $(".element").length;

            var lastid = $(".element:last").attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;

            var max = 20;
            var option_prestasi = $("#prestasi_option").html();
            var juara_prestasi = $("#juara_option").html();
            
            if(total_element < max ){
                $(".element:last").after("<div class='form-group element' id='div_"+ nextindex +"'></div>");
                $("#div_" + nextindex).append("<div class='row'><div class='col-4'><input type='text' class='form-control' id='nama_"+ nextindex +"' name='nama[]' placeholder='Nama Lomba' required></div><div class='col-3'><select class='form-control' name='id_prestasi[]' required>"+option_prestasi+"</select></div><div class='col-3'><select class='form-control' name='id_juara[]' required>"+juara_prestasi+"</select></div><div class='col-2 text-center'><span id='remove_" + nextindex + "' class='btn btn-md btn-danger remove'><i class='fa fa-trash'></i></span></div></div>");
            }
        });

        // Remove element
        $('.container').on('click','.remove',function(){
            var id = this.id;
            var split_id = id.split("_");
            var deleteindex = split_id[1];

            $("#div_" + deleteindex).remove();
        }); 
    });
</script>