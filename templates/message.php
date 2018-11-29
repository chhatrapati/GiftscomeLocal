<?php if( !empty( $error )){ ?>
    <div class="alert alert-error message_div" style="background-color:red;color:#fff;">
		<p class="text-center" style="color:#fff;"> <?php echo $error; ?> </p>
	</div>
<?php } ?>

<?php if( !empty( $success )){ ?>
	 <div class="alert alert-success message_div" style="color: #155724;background-color: #155724;border-color: #155724;">
		<p class="text-center" style="color:#fff;" > <?php echo $success; ?> </p>
	</div>
<?php } ?>

<?php if( !empty( $success ) || !empty( $error ) ){ ?>
	<script>
		$(document).ready(function(){
			$('.message_div').delay(5000).slideUp();
		});
    </script>
<?php } ?>