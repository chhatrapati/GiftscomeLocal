<?php session_start();
$member_id=$_SESSION['id'];
?>
	<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar frd-list-sidebar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">Friends</h4>
                        <nav id="nav">
						<ul class="p-b-54 frd_active">
							<li class="p-t-4">
								<?php 
								$sql=mysqli_query($con,"SELECT count(receiver_id) as total_req FROM friendrequest WHERE `receiver_id`='$member_id'");
								$rows = mysqli_fetch_array($sql);
								$total_req=$rows['total_req'];
								 if($total_req!=0) { ?>
								<span class="frd-list">  
								<?php echo $total_req;?>
								<?php } ?>
							   </span>
							<a href="#" style="text-decoration:none;" class="s-text13 category"  data-target="view_request"  id="view_request">View Request</a>
						 </li>
						 <li class="p-t-4">
							<?php 
							$query="SELECT count(myfriends) as total_frnd FROM `myfriends` WHERE `myfriends`='$member_id' or myid='$member_id'";
							$sql=mysqli_query($con,$query);
							 $rows = mysqli_fetch_array($sql);
							 $total_frnd=$rows['total_frnd'];
							  if($total_frnd!=0) { ?>
							<span class="frd-list">  
							<?php echo $total_frnd;?>
							<?php } ?>
							</span>
							<a href="#" style="text-decoration:none;" class="s-text13 category" data-target="myfriends" id="my_friends">My Friends</a>
						 </li>
						<!-- <li class="p-t-4">
							<?php 
							$sql=mysqli_query($con,"SELECT count(sender) as total_record FROM `referral` WHERE `sender`='$member_id'");
							$rows = mysqli_fetch_array($sql);
							$total_record=$rows['total_record'];
							if($total_record==0) { ?>
						   <span class="frd-list">  
						   <?php echo $total_record;?>
						   <?php } ?>
						  </span>
						  <a href="#" style="text-decoration:none;" class="s-text13 category" data-target="refer" id="refer_friend">Refer Friends</a>
					   </li>
					   <li class="p-t-4">
							<?php 
							$sql=mysqli_query($con,"SELECT count(message_id) as total_record FROM `message` where receiver_id='$member_id'");
							$rows = mysqli_fetch_array($sql);
							$msg_id=$rows['total_record'];
							$sql1=mysqli_query($con,"SELECT count(reply_id) as total_rep_id FROM `reply` where receiver_id='$member_id'");
							$rows1 = mysqli_fetch_array($sql1);
							$total_rep_id=$rows1['total_rep_id'];
							$total=$msg_id +$total_rep_id;
							if($msg_id !=0 && $total_rep_id !=0 ) { ?>
							<span class="frd-list">  
							<?php 
							$total=$msg_id +$total_rep_id;
								echo $total;
							  }  ?>
							 </span>
					</li>-->
			     </ul>
                </nav>
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
width: 133px;
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
.active{
background-color:black;
color:#fff;


}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('#nav ul li a'),
            container = $('#productContainer');
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.data('target'); 
            localStorage.setItem("Link", target);
       //alert(target);			
          // Load target page into container
          container.load(target + '.php');
          // Stop normal link behavior
          return false;
        });
      });
</script>
<script>
    	var act="";	
    	var id="";	
    	var get= localStorage.getItem("Link");
    	$(document).ready(function(){
    		$('ul.frd_active li a').click(function(){
    			var h=$(this).attr('data-target');
    			act=h; 
    			var i=$(this).attr('id');
    			id=localStorage.setItem("Id", i);
    			localStorage.setItem("Data", act);
    			$('.frd_active li').removeClass('active'); 
    			$( this).parent().addClass("active");
    		});
    	});
    	var get1= localStorage.getItem("Data"); 
    	var get2= localStorage.getItem("Id"); 
    	if(get1==get){$('#' + get2).parent().addClass("active");
    }
</script>
<script>
	$(document).ready(function(){
		$("#productContainer").load(get1 + '.php');
	});
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

</script>-->