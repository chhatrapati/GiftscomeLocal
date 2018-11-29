
		<ul class="ks-items">
		<?php
		require_once('includes/config.php');
$chatid=$_POST['result'];
$query=mysqli_query($con,"select * from `privatechatmessage` left join `users` on users.id=privatechatmessage.userid where chatroomid='$chatid' order by chat_date asc") or die(mysqli_error($con));

		while($row=mysqli_fetch_array($query)){
		?>
                                <li class="ks-item ks-self">
								<?php if($row['privatechatmessage_id']%2!=0){?>
                                    <span class="ks-avatar ks-offline">
                                        <img src="users-images/<?php echo $row['user_picture'];?>" width="36" height="36" class="rounded-circle">
                                    </span>
                                    <div class="ks-body">
                                        <div class="ks-header">
                                            <a href="#" onclick="myfun(<?php echo $row['id'];?>)"><span class="ks-name"><?php echo $row['name']; ?></span></a>
                                            <span class="ks-datetime">6:46 PM</span>
                                        </div>
                                        <div class="ks-message"><?php echo $row['message']; ?></div>
                                    </div>
									<?php } else { ?>
                                </li>
								
								   <li class="ks-item ks-from ks-unread" id="<?php echo $row['id'];?>">
                                    <span class="ks-avatar ks-online">
                                        <img src="users-images/<?php echo $row['user_picture'];?>" width="36" height="36" class="rounded-circle">
                                    </span>
                                    <div class="ks-body">
                                        <div class="ks-header">
                                            <a href="#" onclick="myfun1(<?php echo $row['id'];?>)"> <span class="ks-name"><?php echo $row['name']; ?></span></a>
                                            <span class="ks-datetime">1 minute ago</span>
                                        </div>
                                        <div class="ks-message">
                                           <?php echo $row['message']; ?>

                                     
                                        </div>
                                    </div>
                                </li>
		<?php }}?> 
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function myfun(uid){
	//alert("Hello vikas");
   //var uid=($(this).attr("uid"));
   //alert(uid);
   
 $(".ks-info").css("display","block");
		
	 $.ajax({

             

             type: "POST",

             url: "userchatprofile.php",


               data: {

              user_id: uid

                },
          success: function(html) {

                
                    
                  $("#userprofile").html(html).show();


               }

           });
	}	
</script>

<script>
function myfun1(aid){
	//alert("Hello vikas");
   //var uid=($(this).attr("uid"));
   //alert(uid);
   
 $(".ks-info").css("display","block");
		
	 $.ajax({

             

             type: "POST",

             url: "userchatprofile.php",


               data: {

              user_id: aid

                },
          success: function(html) {

                
                    
                  $("#userprofile").html(html).show();


               }

           });
	}	
</script>

<!--<script>
$(document).ready(function(){
  $(".ks-unread").click(function(){
   var aid=($(this).attr("id"));
    $(".ks-info").css("display","block");
	
	$.ajax({

              

               type: "POST",

               url: "userchatprofile1.php",


               data: {

              user_id: aid

               },
                success: function(html) {

                
                    
                   $("#userprofile").html(html).show();


               }

           });
   //alert(aid);
});
});
</script>-->

