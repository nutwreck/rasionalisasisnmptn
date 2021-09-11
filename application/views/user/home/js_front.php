<script>
$('#mulai').click(function(){
    setTimeout(() => { $('#button-text').html('.'); }, 500);
    setTimeout(() => { $('#button-text').html('..'); }, 1000);
    setTimeout(() => { $('#button-text').html('...'); }, 1500);
    setTimeout(() => { window.location = '<?php echo site_url();?>terms-and-conditions'; }, 2000);
});
</script>