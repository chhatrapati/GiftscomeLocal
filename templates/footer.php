<script>
var url = window.location.toString();//alert(url);
     if ( window.location.hash != '' )
    {
        // remove any accordion panels that are showing (they have a class of 'in')
        $('.collapse').removeClass('show');

        // show the panel based on the hash now:
        $(window.location.hash + '.collapse').addClass('show');
    }
</script>
<footer>

			<div class="t-center s-text8 footer_bt">
			<?php $cur_year= date("Y"); $next_year = date('y', strtotime('+1 years'));?>
				GiftsCome &copy; <?php echo  $cur_year;?>-<?php echo$next_year;	?> | <a href="terms-and-conditions.php" class="footer-link">Terms &amp; Conditions</a> | <a href="privacy-policy.php" class="footer-link">Privacy Policy</a>
			</div>
</footer>