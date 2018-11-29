	<?php require_once('includes/config.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<div class="form-area">  
        <form role="form" method="post" id="compose">		
        <br style="clear:both">
                    <h3 class="s-text15">Compose Message</h3>
    				<div class="form-group">
						<select name="category" id="user" class="span8 tip" style="width:100%;">
		<option value="">Select Manager for Support</option> 
		<?php $query=mysqli_query($con,"select * from admin WHERE role ='manager'");
		while($row=mysqli_fetch_array($query))
		{?>
		 <option value="<?php echo $row['id'].'_'.$row['username'];?>"><?php echo $row['username'];?></option>
		<?php } ?>
		</select>
					</div>	
              <div class="form-group">
             <textarea class="form-control" type="textarea" name="reciver_msg" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>    </div>
        <input type="submit" id="submit" value="Send Message" name="submit" style="width:22%;float:right;" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
        </form>
    </div>
	<div id="results"></div>
</div>		
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#compose").submit(function() {	
		$.ajax({
			type: "POST",
			url: 'support_help.php',
			data:$("#compose").serialize(),
			success: function (data) {	
				// Inserting html into the result div on success
				$('#results').html(data);
			},
			error: function(jqXHR, text, error){
            // Displaying if there are any errors
            	$('#result').html(error);           
        }
    });
		return false;
	});
});
</script>

<style>
	.s-text15{
	   margin-bottom: 25px;
	   font-size:25px;
	   text-align:center;
	   font-family: Montserrat-bold; 
	   color:#fff;
	}
input#search {display:none !important;}
</style>