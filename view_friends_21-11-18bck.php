<?php session_start();
  require_once('includes/config.php');
  //require_once('includes/function.php');
  if(!isset($_SESSION['id'])) {
      header('Location: login.php');
      exit();
  }
  ?>
<!DOCTYPE html>
<head>
  <title>View Friends</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('templates/common_css.php');?>
</head>
<body class="animsition">
  <?php
    require_once('templates/header.php');
    //error_reporting(1);
    //print_r($_SESSION);
    ?>
  <!-- Title Page -->
  <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/friend.png);">
    <h2 class="l-text2 t-center">
      Friends
    </h2>
    <p class="m-text13 t-center">
      New Arrivals Friends List
    </p>
  </section>
  <div class="row" style="margin-top: 10px;">
    <div class="contentArea">
      <input type="text"placeholder="Serach Friends" class="search" id="search" style="float:right;padding-left:10px;border:1px solid #17a2b8 !important;"> 
    </div>
  </div>
  <!-- Content page -->
  <section class="bgwhite p-t-20">
    <div class="container">
      <div class="row">
        <?php require_once('templates/friends_sidebar.php');?>
        <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
          <div class="row" id="productContainer">
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
			  
			  $queryFriend1 = "SELECT * FROM myfriends where myid =$member_id"; 
              $arrFriends1 = array();
              $resultFriend1 = mysqli_query($con, $queryFriend1) or die(mysqli_error($con));
              while ($rowFriend1 = mysqli_fetch_array($resultFriend1, MYSQLI_BOTH)) {
                  $arrFriends1[]=$rowFriend1["myfriends"];
              }
              
              $arrFriends[]=$member_id;
			  $newarray=array_merge($arrFriends,$arrFriends1);
			  $query = "SELECT * FROM  users where id not in (".implode(",",$newarray).")";
              //$query = "SELECT * FROM  users where id not in (".implode(",",$arrFriends).",".implode(",",$a).",".implode(",",$b).")";
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
                <p  id="<?php echo $user_id; ?>" class="flex-c-m  bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>">Request Sent</p>
                <?php
                  }					
                   else
                  {
                  ?>
                <p id="<?php echo $user_id; ?>" class="flex-c-m  bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>"><i class="fa fa-user-plus"></i>&nbsp;Add To friend</p>
                <?php				
                  }}
                  ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div id="display"></div>
  </section>
  <?php require_once('templates/footer.php');?>
  <?php require_once('templates/common_js.php');?>
  <?php require_once('templates/chat_script.php');?>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
  <script>
    $('.pexample').on('click', function() {
    var myId = $(this).attr('id');	
    var rid=($(this).attr('rid'));
    var rname=($(this).attr('rname'));
    var rpic=($(this).attr('rpic'));
    var sid=($(this).attr('sid'));
    var sname=($(this).attr('sname'));
    var spic=($(this).attr('spic'));
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
                success: function (result) 
                {
    				      $('#' + myId).html(result);
                }
              });
    
    	
    })
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>  
    $(function() {
      $("#search").autocomplete({
        source: "search_user.php",
        minLength: 1,
        select: function(event, ui) {
        selectedValue = ui.item.value;
    $.ajax({

                   type: "POST",
    
                   url: "finduser.php",
    
    
                   data: {
    
                  search: selectedValue
    
                   },
                success: function(html) { 

                  $("#productContainer").html(html).show();
    
                   }
    
               });
        },
        html: true, 
        open: function(event, ui) {
          $(".ui-autocomplete").css("z-index", 1000);
    
        }
      })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li><div><img src=users-images/"+item.img+" style='width:40px;height:40px;'><span>"+item.value+"</span></div></li>" ).appendTo( ul );
      };
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
    .row
    {
    margin-right:0px;
    }
  </style>
  
</body>
</html>