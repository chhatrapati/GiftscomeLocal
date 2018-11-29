<?php session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>

	<style>
.r_me1
{
	
	text-align:right;
}
.r_me
{
	
	color:red !important;
}
input#search
{
	display:none;
}
</style>

					 <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
							    <?php
							  $member_id=$_SESSION['id'];
                     				
					$query = "SELECT * FROM message WHERE receiver_id='$member_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						   ?>
						    <input type="hidden" value="<?php echo $row['sender_id'];?>">
							<input type="hidden" value="<?php echo $row['sender_img'];?>">
						   <input type="hidden" value="<?php echo $row['receiver_name'];?>">
						   <input type="hidden" value="<?php echo $row['receiver_img'];?>">
						   <input type="hidden" value="<?php echo $row['message_id'];?>">
                                  <td class="inbox-small-cells">
                          <input type="checkbox" class="mail-checkbox" name="check_delete" value="<?php echo $row['message_id']; ?>">
                                  </td>
								  
                                  <td class="inbox-small-cells s-text13" ><i class="fa fa-star"></i></td>
								  
                                  <td class="view-message  dont-show s-text13 ">
								  <form action="" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="message_id" value="<?php echo $row['message_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
								      <input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						   <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['sender_name'];?>" style="background:white;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13">
                                 <form action="" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="message_id" value="<?php echo $row['message_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
								<input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						   <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['msg'];?>" style="background:white;">
								  </form>
								  </td>
                                  <!--<td class="view-message  inbox-small-cells s-text13"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message  text-right s-text13"><?php echo $row['msg_date'];?></td>
                              </tr>
							    <?php
					   }
                           ?>
						   
						   <tr class="unread">
							  <?php
							  $member_id=$_SESSION['id'];
							  $query2 = "SELECT * FROM reply where receiver_id='$member_id'";
                       $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
					  ?>
					
					
					               <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox" name="check_delete" value="<?php echo $row['reply_id']; ?>">
                                  </td>
								  
                                  <td class="inbox-small-cells s-text13"><i class="fa fa-star"></i></td>
					       <td class="view-message  dont-show s-text13 ">
								  <form action="" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="message_id" value="<?php echo $row['message_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							 <input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						       <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['sender_name'];?>" style="background:white;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13 ">
                                 <form action="" method="post">
								   <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="message_id" value="<?php echo $row['message_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							<input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						   <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['msg'];?>" style="background:white;">
								  </form></td>
                                  <!--<td class="view-message  inbox-small-cells s-text13"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message  text-right s-text13"><?php echo $row['msg_date'];?></td>
                              </tr>
	
					   <?php }?>
                              
                          </tbody>
                          </table>
						  <div id="display"></div>
				
	<div id="jd-chat">
	<div class="jd-online">
		<div class="jd-header" style="font-family:Poppins-Bold !important; ">Online User</div>
		<div class="jd-body">
		<?php
            if (isset($_SESSION['id'])) {
                 $member_id = $_SESSION['id'];
            }



            $post = mysqli_query($con, "SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id' ")or die(mysqli_error($con));

            $num_rows = mysqli_num_rows($post);

            if ($num_rows != 0) {

                while ($row = mysqli_fetch_array($post)) {

                    $myfriend = $row['myid'];


                    //$member_id=$_SESSION["logged"];



                    if ($myfriend == $member_id) {

                        $myfriend1 = $row['myfriends'];
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend1'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
                        ?>

			<span class="jd-online_user" uname="<?php echo $friendsa['name']; ?>" upic="<?php echo $friendsa['user_picture']; ?>" id="<?php echo $myfriend1; ?>"> <?php echo $friendsa['name']; ?> <i class="light">&#8226;</i> </span>
			 <?php
                    } else {
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
                        ?>
						<input type="hidden" value="<?php echo  $row['myid'];?>">
			<span class="jd-online_user" id="<?php echo  $row['myid'];?>"  uname="<?php echo $friendsa['name']; ?>" upic="<?php echo $friendsa['user_picture']; ?>"> <?php echo $friendsa['name']; ?> <i class="light">&#8226;</i> </span>
			<?php
                    }
                }
            } else {



                echo 'You do not have friends ';
            }
            ?>
		</div>		
<input type="hidden" id="sender_name" value="<?php echo $_SESSION['username'];?>">		
		<div class="jd-footer"><input id="search_chat" placeholder="Serach"></div>
	</div>
	
</div>
	
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>

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
            url: 'delete_inbox.php',
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
<link href="jd.css" rel="stylesheet" />
<script src="jquery-1.11.2.min.js" ></script>
<!--<script>
$(document).ready(function(){
	var oldChat="";
	var open=Array();
	setInterval(function(){ 
		$( "#jd-chat .jd-online_user" ).each(function(){
		var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		 var upic = $(this).attr("upic");
	     var uname = $(this).attr("uname");
		var sender_name=$("#sender_name").val();
			$.ajax({
			url:'chat.class.php',
			type:'POST',
			data:'get_all_msg=true&user=' + id + '&sender_name=' + sender_name,
			success:function(data)
				{                           
				$("#jd-chat").find(".jd-user:first .jd-body").html("<span class='me'> " + data + "</span>");
				
				//$(".jd-body").animate({scrollTop:  $(".jd-body").height()*10});
				}
});	
			
		});
	 }, 3000);
	
	$("#jd-chat .jd-online_user").click(function(){		
		var user_name = $.trim($(this).text());
		var id = $.trim($(this).attr("id"));
		 var upic = $(this).attr("upic");
	     var uname = $(this).attr("uname");
			 //alert(uname);
			  //alert(upic);
		var sender_name=$("#sender_name").val();
		//alert(sender_name);		
		if($.inArray(id,open) !== -1 )
			return		
		open.push(id);
	
		$("#jd-chat").prepend('<div class="jd-user">\
			<div class="jd-header" upics="' + upic + '" unames="' + uname + '" id="' + id + '">' + user_name + '<span class="close-this"> X </span></div>\
			<div class="jd-body"  style="height: 40px;overflow-y: auto; overflow-x:hidden;"></div>\
			<div class="jd-footer"><input placeholder="Write A Message" id="msg"></div>\
		</div>');
			$.ajax({
			url:'chat.class.php',
			type:'POST',
			data:'get_all_msg=true&user=' + id + '&sender_name=' + sender_name,
			success:function(data){
                           
							$("#jd-chat").find(".jd-user:first .jd-body").append("<span class='me'> " + data + "</span>");
							}
		});
	
	});
	
	$("#jd-chat").delegate(".close-this","click",function(){
		removeItem = $(this).parents(".jd-header").attr("id");
		$(this).parents(".jd-user").remove();
		
		open = $.grep(open, function(value) {
		  return value != removeItem;
		});	
	});
		
	$("#jd-chat").delegate(".jd-header","click",function(){
		var box=$(this).parents(".jd-user,.jd-online");
		$(box).find(".jd-body,.jd-footer").slideToggle();
	});
	
	$("#search_chat").keyup(function(){
		var val =  $.trim($(this).val());
		$(".jd-online .jd-body").find("span").each(function(){
			if ($(this).text().search(new RegExp(val, "i")) < 0 ) 
			{
                $(this).fadeOut(); 
            } 
			else 
			{
                $(this).show();              
            }
		});
	});
	
	$("#jd-chat").delegate(".jd-user input","keyup",function(e){
		if(e.keyCode == 13 )
		{
			var box=$(this).parents(".jd-user");
			var msg=$(box).find("input").val();
			var to = $.trim($(box).find(".jd-header").attr("id"));
			var upics = $.trim($(box).find(".jd-header").attr("upics"));
			var unames = $.trim($(box).find(".jd-header").attr("unames"));
			var sname=$("#sender_name").val();
			$.ajax({
				url:'chat.class.php',
				type:'POST',
				data:'send=true&to=' + to + '&msg=' + msg + '&unames=' + unames + '&upics=' + upics + '&sname=' + sname,
				success:function(response){	
				$(box).find(".jd-body").append("<div id='chatting'><p style='color:#fff'>" + msg + "</p></div>");
				//var result = $('<div />').append().find('.xyz').html();
				//alert(result);
				}
			});
			document.getElementById('msg').value='';
		}
	});
	
});  
// var counter = 1;
// var auto_refresh = setInterval(
// function () {
//     var newcontent= 'Refresh nr:'+counter;
//     $('.jd-user').html('Vikas');
//     counter++;
// }, 1000);
</script>
-->