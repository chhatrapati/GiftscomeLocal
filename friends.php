<?php session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>
					
					<div class="row" id="">
						 <?php
                        if (isset($_SESSION['id'])) {
                            $member_id = $_SESSION['id'];
                        }

                        $userid = $_SESSION['id'];
                        $queryFriend = "SELECT * FROM friendrequest where receiver_id =$member_id"; 
                        $arrFriends = array();
                        $resultFriend = mysqli_query($con, $queryFriend) or die(mysqli_error($con));
                        while ($rowFriend = mysqli_fetch_array($resultFriend, MYSQLI_BOTH)) {
                            $arrFriends[]=$rowFriend["sender_id"];
                        }
                        $arrFriends[]=$member_id;
                        $query = "SELECT * FROM  users where id not in (".implode(",",$arrFriends).")";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            $user_id = $row['id'];
                            $name = $row['name'];
                            $user_picture = $row['user_picture'];
                            $_SESSION['user_picture'] = $user_picture;
                            $login_userpic = $_SESSION['login_userpic'];
                            $loginusername = $_SESSION['name'];
                            ?>
							 <div class="col-sm-2 col-md-2 col-lg-2  p-b-25">
                                <!-- Block2 -->
                                <div class="block2 text-center">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relativ win_img">

											<?php $pic = $row['user_picture'];								  									
											if($row['user_picture'] == ""){ ?>
											<img src="users-images/user.png" style="width:100px; height:100px;">
											<?php }elseif (strpos($pic, 'https') !== false) {?>
											<img src="<?php echo $row['user_picture'];?>"  style="width:100px; height:100px;">
											<?php } else {?>
											<img src="users-images/<?php echo $row['user_picture'];?>" style="width:100px; height:100px;">
											<?php }?>
                                        <div class="trans-0-4">
                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt">
                                        <a href="#" class="block2-name dis-block s-text3 p-b-5" style="font-size:12px;">
                                            <?php echo $name; ?>
                                        </a>
                                    </div>
									<?php
										$query1 = "SELECT * from friendrequest where sender_id ='$member_id' and receiver_id='$user_id'";
                      if ($result1=mysqli_query($con,$query1))
                         {
                              if(mysqli_num_rows($result1) > 0)
                                {
                            ?>
									
                                   <!--<a href="compose.php?reciver_id=<?php //echo $user_id; ?>&reciver_name=<?php //echo $name;?>&reciver_img=<?php //echo $_SESSION['user_picture'];?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Send Message</a>-->
				<p  class="flex-c-m  bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>">Friend Request Sent</p>
								<?php
    }					
     else
	{
	?>
		<p  class="flex-c-m  bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>"><i class="fa fa-user-plus"></i>&nbsp;Add To friend</p>
             <?php				
				}}
  ?>
                 		
</div>
 </div>
<?php } ?>

					</div>

		<div id="display"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$('.pexample').on('click', function() {
	
var rid=($(this).attr('rid'));
var rname=($(this).attr('rname'));
var rpic=($(this).attr('rpic'));
var sid=($(this).attr('sid'));
var sname=($(this).attr('sname'));
var spic=($(this).attr('spic'));

//alert(rid);
//alert(rname);
//alert(rpic);
//alert(sid);
//alert(sname);
//alert(spic);



          $.ajax({
            type: 'post',
            url: 'send-request.php',
         
			 data: {

                    rid: rid,
                    rname :rname,
					rpic :rpic,
					sid :sid,
					spic :spic,
					sname : sname
					
                               },
            success: function (result) {
             $("#display").html(result).show();
			 
			 
			  //$(".pexample").text("Hello world!");
			   //$(".pexample:first").replaceWith("Hello world!");
            }
          });

	
})
</script>
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
	$.ajax({
	type: "POST",
	url: "searchuser.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#divResult").html(html).show();
	}
	});
}return false;    
});
jQuery("#divResult").live("click",function(e){ 
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var selectedValue = $("<div/>").html($name).text();
	//alert(selectedValue);
	$('#skills').val(selectedValue);
		 $.ajax({
			 
               type: "POST",

               url: "user_autocomplete_result.php",

               data: {

              search: selectedValue

               },
                success: function(html) {

                

                   $("#productContainer").html(html).show();

               }

           });
	
jQuery(document).live("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#divResult").fadeOut(); 
	}
});
$('#skills').click(function(){
	jQuery("#divResult").fadeIn();
});
});
});
</script>
<style>
#skills
	{
		width:350px;
		border:solid 1px #000;
		padding:3px;
	   margin-top: 20px;
	   margin-left:863px;
	}
	#divResult
	{
		position:absolute;
		width:350px;
		display:none;

		border:solid 1px #dedede;
		border-top:0px;
		overflow:hidden;
		border-bottom-right-radius: 6px;
		border-bottom-left-radius: 6px;
		-moz-border-bottom-right-radius: 6px;
		-moz-border-bottom-left-radius: 6px;
		box-shadow: 0px 0px 5px #999;
		border-width: 3px 1px 1px;
		border-style: solid;
		border-color: #333 #DEDEDE #DEDEDE;
		background-color: white;
		margin-left: 250px;
		    margin-top: 50px;
	}
	.contentArea{
		width:600px;
		margin:0 auto;
	}
	</style>

</body>
</html>