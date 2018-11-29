<?php session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					 <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
							    <?php
							  $member_id=$_SESSION['id'];
                     				
					$query = "SELECT * FROM support WHERE receiver_id='$member_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						   ?>
						    <input type="hidden" value="<?php echo $row1['sender_id'];?>">
						   <input type="hidden" value="<?php echo $row1['receiver_name'];?>">
						   <input type="hidden" value="<?php echo $row1['support_id'];?>">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox"  name="check_delete" value="<?php echo $row['support_id'];?>">
                                  </td>
								  
                               
								  
								  
								     <td class="view-message  dont-show s-text13 " >
								  <form action="support_chat.php" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							 <input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						
								  <input type="submit" name="submit" value="<?php echo $row['sender_name'];?>" style="background:white;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13 ">
                                 <form action="support_chat.php" method="post">
								   <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							<input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
				
								  <input type="submit" name="submit" value="<?php echo $row['msg'];?>" style="background:white;">
								  </form></td>
								  
								  
								  
                                  <!--<td class="view-message  dont-show s-text13 "><a href="support_chat.php?sender_name=<?php// echo $row['sender_name'];?>&msg=<?php //echo $row['msg'];?>&sender_id=<?php //echo $row['sender_id'];?>&reciver_name=<?php //echo $row['receiver_name'];?>&support_id=<?php //echo $row['support_id'];?>"><?php //echo $row['sender_name'];?></a></td>
                                  <td class="view-messag s-text13e"><a href="support_chat.php?sender_name=<?php //echo $row['sender_name'];?>&msg=<?php //echo $row['msg'];?>&sender_id=<?php// echo $row['sender_id'];?>&reciver_name=<?php //echo $row['receiver_name'];?>&support_id=<?php// echo $row['support_id'];?>"><?php //echo $row['msg'];?></a></td>-->
                                  <!--<td class="view-message  inbox-small-cells s-text13"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message  text-right s-text13" style="font-family: Montserrat-Regular !important;"><?php echo $row['msg_date'];?></td>
                              </tr>
							    <?php
					   }
                           ?>
						   <tr class="unread">
							  <?php
							  $member_id=$_SESSION['id'];
							  $query2 = "SELECT * FROM support_reply where receiver_id='$member_id'";
                       $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
					  ?>
					
					     
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox" name="check_delete" value="<?php echo $row2['support_reply_id'];?>">
                                  </td>
                                 
								  
								  	     <td class="view-message  dont-show s-text13 " >
								  <form action="support_chat.php" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row2['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row2['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row2['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row2['sender_name'];?>">
							 <input type="hidden" name="receiver_name" value="<?php echo $row2['receiver_name'];?>">
						
								  <input type="submit" name="submit" value="<?php echo $row2['sender_name'];?>" style="background:white;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13 ">
                                 <form action="support_chat.php" method="post">
								   <input type="hidden" name="msg" value="<?php echo $row2['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row2['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row2['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row2['sender_name'];?>">
							<input type="hidden" name="receiver_name" value="<?php echo $row2['receiver_name'];?>">
				
								  <input type="submit" name="submit" value="<?php echo $row2['msg'];?>" style="background:white;">
								  </form></td>
								  
								  
								  
                               <!-- <td class="view-message  dont-show">
								<a href="support_chat.php?sender_name=<?php //echo $row2['sender_name'];?>&msg=<?php //echo $row2['msg'];?>&sender_id=<?php //echo $row2['sender_id'];?>&reciver_name=<?php //echo $row2['receiver_name'];?>&support_id=<?php //echo $row2['support_id'];?>"><?php //echo $row2['sender_name'];?></a></td>
                                  <td class="view-message "><a href="support_chat.php?sender_name=<?php //echo $row2['sender_name'];?>&msg=<?php //echo $row2['msg'];?>&sender_id=<?php //echo $row2['sender_id'];?>&reciver_name=<?php //echo $row2['receiver_name'];?>&support_id=<?php //echo $row2['support_id'];?>"><?php //echo $row2['msg'];?></a></td>-->
                                  <!--<td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message text-right" style="font-family: Montserrat-Regular !important;"><?php echo $row2['msg_date'];?></td>
							
                              </tr>
                            <?php
					   }
                           ?>
						   
						
                              
                          </tbody>
                          </table>
						  <div id="display"></div>
											</div>

	<style>
input#search {
    display: none;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#compose").submit(function() {	

    	
		$.ajax({
			type: "POST",
			url: 'send.php',
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".mail-checkbox").click(function(){
			var answer = confirm ("Are you sure you want to delete?");	 
			if (answer)
      {
            var favorite = [];
            $.each($("input[name='check_delete']:checked"), function(){            
                favorite.push($(this).val());
            });
            var checkbox=favorite.join(", ");
			  $.ajax({
            type: 'post',
            url: 'delete_msg.php',
                  data: {
                 checkbox: checkbox
				 
                    },
            success: function (result) {
             $("#display").html(result).show();
			  
            }
          });
		      } 
        });
		
           
    });
</script>