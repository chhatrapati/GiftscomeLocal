	
	<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar frd-list-sidebar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Friends
						</h4>

						<ul class="p-b-54 frd_active">
						<li class="p-t-4"><span class="frd-list"><?php 
						$query="SELECT count(sender) FROM `referral`";
						$sql=mysqli_query($con,$query);
						 $rows = mysqli_fetch_row($sql);
                        echo $rows[0];
						
						?>
						
						</span><a href="view_friends.php" style="text-decoration:none;" class="s-text13 category active" cid="4">Friends</a></li>
						<li class="p-t-4">
						<?php 
						$query="SELECT count(receiver_id) FROM `friendrequest_id`";
						$sql=mysqli_query($con,$query);
					 $rows = mysqli_fetch_row($sql);
                      $value=$rows[0];
					  if($value==0)
					  {
						
					  }
					  else
					  {
						  ?>
						<span class="frd-list">  
						<?php echo $value;?>
						<?php
					  }
						?>
						</span>
						<a href="view_request.php" style="text-decoration:none;" class="s-text13 category" cid="4">View Request</a></li>
						<li class="p-t-4"><?php 
						$query="SELECT count(myid) FROM `myfriends`";
						$sql=mysqli_query($con,$query);
						 $rows = mysqli_fetch_row($sql);
                        
						$value=$rows[0];
					  if($value==0)
					  {
					  }
					  else
					  {
						  ?>
						<span class="frd-list">  
						<?php echo $value;?>
						<?php
					  }
						?>
						</span><a href="myfriends.php" style="text-decoration:none;" class="s-text13 category" cid="4">My Friends</a></li>
						<li class="p-t-4"><?php 
						$query="SELECT count(sender) FROM `referral`";
						$sql=mysqli_query($con,$query);
						 $rows = mysqli_fetch_row($sql);
                      $value=$rows[0];
					  if($value==0)
					  {
					  }
					  else
					  {
						  ?>
						<span class="frd-list">  
						<?php echo $value;?>
						<?php
					  }
						?>
						
						</span><a href="refer.php" style="text-decoration:none;" class="s-text13 category" cid="4">Refer Friends</a></li>
						<li class="p-t-4">
						<?php 
					 $member_id=$_SESSION['id'];
						$query="SELECT count(message_id) FROM `message` where receiver_id='$member_id'";
					    $sql=mysqli_query($con,$query);
						 $rows = mysqli_fetch_row($sql);
						 $msg_id=$rows[0];
					       $query1="SELECT count(reply_id) FROM `reply` where receiver_id='$member_id'";
						   $sql1=mysqli_query($con,$query1);
						 $rows1 = mysqli_fetch_row($sql1);
						 $reply_id=$rows1[0];
					  if($msg_id==0 || $reply_id==0 )
					  {
					  }
					  else
					  {
						  ?>
						<span class="frd-list">  
						  <?php 
						 //echo  $msg_id;
					 //echo $reply_id;
						 $total=$msg_id +$reply_id;
						echo $total;
					  }  
					  
						?>
						</span>
					
						<a href="inbox.php" style="text-decoration:none;" class="s-text13 category" cid="4">Inbox</a></li>
						<li class="p-t-4"><a href="support.php" style="text-decoration:none;" class="s-text13 category" cid="4">Support</a></li>
						<li class="p-t-4">
						<?php 
					 $member_id=$_SESSION['id'];
						$query="SELECT count(support_id) FROM ` support` where receiver_id='$member_id'";
					    $sql=mysqli_query($con,$query);
						 $rows = mysqli_fetch_row($sql);
						 $msg_id=$rows[0];
					       $query1="SELECT count(support_reply_id) FROM `support_reply` where receiver_id='$member_id'";
						   $sql1=mysqli_query($con,$query1);
						 $rows1 = mysqli_fetch_row($sql1);
						 $reply_id=$rows1[0];
					  if($msg_id==0 || $reply_id==0 )
					  {
					  }
					  else
					  {
						  ?>
						<span class="frd-list">  
						  <?php 
						 //echo  $msg_id;
					 //echo $reply_id;
						 $total=$msg_id +$reply_id;
						echo $total;
					  }  
					  
						?>
						</span>
						
						<a href="help_support_inbox.php" style="text-decoration:none;" class="s-text13 category" cid="4">Inbox Help Support</a></li>
					
						</ul>

						<!--  -->
				

					

					</div>
				</div>
				<style>
				.frd-list {
    position: absolute;
    left: -5px;
    margin-top: -3px;
    background: #0daacf;
    height: 20px;
    width: 20px;
    text-align: center;
    border-radius: 10px;
    color: #fff;
    line-height: 21px;
}
.frd-list-sidebar li {
    background: #17a2b8;
    width: 200px;
    padding: 0 15px;
    margin-bottom: 10px;
}
.frd-list-sidebar li a {
    color: #FFF !important;
}
.frd-list {
    position: absolute;
    left: 10px;
    margin-top: -5px;
    background: #0daacf;
    height: 20px;
    width: 20px;
    text-align: center;
    border-radius: 10px;
    color: #fff;
    line-height: 21px;
}
.frd-list-sidebar li.active {
    background-color: #000;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

jQuery(function ($) {
    $("ul.frd_active a")
        .click(function(e) {
            var link = $(this);

            var item = link.parent("li");
            
            if (item.hasClass("active")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }

            if (item.children("ul.frd_active").length > 0) {
                var href = link.attr("href");
                link.attr("href", "#");
                setTimeout(function () { 
                    link.attr("href", href);
                }, 300);
                e.preventDefault();
            }
        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active");
                return false;
            }
        });
});

</script>