<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script>
<script src="js/matrix.js"></script>
<script type="text/javascript" src="js/jquery.url.js"></script> 
<script type="text/javascript">
	$(function(){
		$page = jQuery.url.attr("file");//alert($page);
		if(!$page) {
			$page = 'index.php';
		}
		//$('#sidebar ul li a'').each(function(){
			//var $href = $(this).attr('href');
			//if ( ($href == $page) || ($href == '') ) {
				//$(this).addClass('active');
				//$(this).parent().parent().parent().addClass('active');
			//} else {
				//$(this).removeClass('active');
			//}
		//});
    $('ul#navigation li a').each(function(){
        var $href = $(this).attr('href'); //alert($href);
        if ( ($href == $page) || ($href == '') ) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
	
	// for sub menu
	$('ul#sub-menu li a').each(function(){
        var $href = $(this).attr('href'); //alert($href);
        if ( ($href == $page) || ($href == '') ) {
            $(this).addClass('active');
			$('ul#sub-menu').css('display','block');
        } else {
            $(this).removeClass('active');
        }
    });
	
	// for sub menu 1
	$('ul#sub-menu1 li a').each(function(){
        var $href = $(this).attr('href'); //alert($href);
        if ( ($href == $page) || ($href == '') ) {
            $(this).addClass('active');
			$('ul#sub-menu1').css('display','block');
        } else {
            $(this).removeClass('active');
        }
    });
	
	// for sub menu 2
	$('ul#sub-menu2 li a').each(function(){
        var $href = $(this).attr('href'); //alert($href);
        if ( ($href == $page) || ($href == '') ) {
            $(this).addClass('active');
			$('ul#sub-menu2').css('display','block');
        } else {
            $(this).removeClass('active');
        }
    });
	
	

	
	});
</script>