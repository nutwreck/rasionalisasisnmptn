<script>
$('#mulai').click(function(){
    setTimeout(() => { $('#button-text').html('.'); }, 500);
    setTimeout(() => { $('#button-text').html('..'); }, 1000);
    setTimeout(() => { $('#button-text').html('...'); }, 1500);
    setTimeout(() => { window.location = '<?php echo site_url();?>home'; }, 2000);
});

$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});

function setuju() {
  var checkBox = document.getElementById("setuju");
  var btnstj = document.getElementById("btnstj");
  if (checkBox.checked == true){
    btnstj.style.display = "block";
  } else {
    btnstj.style.display = "none";
  }
}

function tidak_setuju() {
  var checkBox = document.getElementById("setuju");
  var btnstj = document.getElementById("btnstj");
  if (checkBox.checked == true){
    btnstj.style.display = "none";
  } else {
    btnstj.style.display = "none";
  }
}
</script>