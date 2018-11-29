<?php
session_start();
//error_reporting(0);
require_once('includes/config.php');
$member_id=$_SESSION['id'];
?>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- this file was missing -->
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- this file was missing -->
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
<?php require_once('templates/common_css.php');?>
<!-- this file was missing -->

<style class="cp-pen-styles">
#frame {
  width: 95%;
  min-width: 360px;
  max-width: 89%;
  height: 92vh;
  min-height: 300px;
  max-height: 720px;
  background: #E6EAEA;
}
@media screen and (max-width: 360px) {
  #frame {
    width: 100%;
    height: 100vh;
  }
}
#frame #sidepanel {
  float: left;
  min-width: 280px;
  max-width: 340px;
  width: 40%;
  height: 100%;
  background: #2c3e50;
  color: #f5f5f5;
  overflow: hidden;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel {
    width: 58px;
    min-width: 58px;
  }
}
#frame #sidepanel #profile {
  width: 80%;
  margin: 25px auto;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile {
    width: 100%;
    margin: 0 auto;
    padding: 5px 0 0 0;
    background: #32465a;
  }
}
#frame #sidepanel #profile.expanded .wrap {
  height: 210px;
  line-height: initial;
}
#frame #sidepanel #profile.expanded .wrap p {
  margin-top: 20px;
}
#frame #sidepanel #profile.expanded .wrap i.expand-button {
  -moz-transform: scaleY(-1);
  -o-transform: scaleY(-1);
  -webkit-transform: scaleY(-1);
  transform: scaleY(-1);
  filter: FlipH;
  -ms-filter: "FlipH";
}
#frame #sidepanel #profile .wrap {
  height: 60px;
  line-height: 60px;
  overflow: hidden;
  -moz-transition: 0.3s height ease;
  -o-transition: 0.3s height ease;
  -webkit-transition: 0.3s height ease;
  transition: 0.3s height ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap {
    height: 55px;
  }
}
#frame #sidepanel #profile .wrap img {
  width: 50px;
  border-radius: 50%;
  padding: 3px;
  border: 2px solid #e74c3c;
  height: auto;
  float: left;
  cursor: pointer;
  -moz-transition: 0.3s border ease;
  -o-transition: 0.3s border ease;
  -webkit-transition: 0.3s border ease;
  transition: 0.3s border ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap img {
    width: 40px;
    margin-left: 4px;
  }
}
#frame #sidepanel #profile .wrap img.online {
  border: 2px solid #2ecc71;
}
#frame #sidepanel #profile .wrap img.away {
  border: 2px solid #f1c40f;
}
#frame #sidepanel #profile .wrap img.busy {
  border: 2px solid #e74c3c;
}
#frame #sidepanel #profile .wrap img.offline {
  border: 2px solid #95a5a6;
}
#frame #sidepanel #profile .wrap p {
      float: left;
    margin-left: 15px;
    font-size: 27px;
    color: #fff;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap p {
    display: none;
  }
}
#frame #sidepanel #profile .wrap i.expand-button {
  float: right;
  margin-top: 23px;
  font-size: 0.8em;
  cursor: pointer;
  color: #435f7a;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap i.expand-button {
    display: none;
  }
}
#frame #sidepanel #profile .wrap #status-options {
  position: absolute;
  opacity: 0;
  visibility: hidden;
  width: 150px;
  margin: 70px 0 0 0;
  border-radius: 6px;
  z-index: 99;
  line-height: initial;
  background: #435f7a;
  -moz-transition: 0.3s all ease;
  -o-transition: 0.3s all ease;
  -webkit-transition: 0.3s all ease;
  transition: 0.3s all ease;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options {
    width: 58px;
    margin-top: 57px;
  }
}
#frame #sidepanel #profile .wrap #status-options.active {
  opacity: 1;
  visibility: visible;
  margin: 75px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options.active {
    margin-top: 62px;
  }
}
#frame #sidepanel #profile .wrap #status-options:before {
  content: '';
  position: absolute;
  width: 0;
  height: 0;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: 8px solid #435f7a;
  margin: -8px 0 0 24px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options:before {
    margin-left: 23px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul {
  overflow: hidden;
  border-radius: 6px;
}
#frame #sidepanel #profile .wrap #status-options ul li {
  padding: 15px 0 30px 18px;
  display: block;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li {
    padding: 15px 0 35px 22px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li:hover {
  background: #496886;
}
#frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
  position: absolute;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  margin: 5px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
    width: 14px;
    height: 14px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
  content: '';
  position: absolute;
  width: 14px;
  height: 14px;
  margin: -3px 0 0 -3px;
  background: transparent;
  border-radius: 50%;
  z-index: 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
    height: 18px;
    width: 18px;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li p {
  padding-left: 12px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #profile .wrap #status-options ul li p {
    display: none;
  }
}
#frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
  background: #2ecc71;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
  border: 1px solid #2ecc71;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
  background: #f1c40f;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
  border: 1px solid #f1c40f;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
  background: #e74c3c;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
  border: 1px solid #e74c3c;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
  background: #95a5a6;
}
#frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
  border: 1px solid #95a5a6;
}
#frame #sidepanel #profile .wrap #expanded {
  padding: 100px 0 0 0;
  display: block;
  line-height: initial !important;
}
#frame #sidepanel #profile .wrap #expanded label {
  float: left;
  clear: both;
  margin: 0 8px 5px 0;
  padding: 5px 0;
}
#frame #sidepanel #profile .wrap #expanded input {
  border: none;
  margin-bottom: 6px;
  background: #32465a;
  border-radius: 3px;
  color: #f5f5f5;
  padding: 7px;
  width: calc(100% - 43px);
}
#frame #sidepanel #profile .wrap #expanded input:focus {
  outline: none;
  background: #435f7a;
}
#frame #sidepanel #search {
  border-top: 1px solid #32465a;
  border-bottom: 1px solid #32465a;
  font-weight: 300;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #search {
    display: none;
  }
}
#frame #sidepanel #search label {
  position: absolute;
  margin: 10px 0 0 20px;
}
#frame #sidepanel #search input {
  font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
  padding: 10px 0 10px 46px;
  width: calc(100% - 25px);
  border: none;
  background: #32465a;
  color: #f5f5f5;
}
#frame #sidepanel #search input:focus {
  outline: none;
  background: #435f7a;
}
#frame #sidepanel #search input::-webkit-input-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input::-moz-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input:-ms-input-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #search input:-moz-placeholder {
  color: #f5f5f5;
}
#frame #sidepanel #contacts {
  height: calc(100% - 177px);
  overflow-y: scroll;
  overflow-x: hidden;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts {
    height: calc(100% - 149px);
    overflow-y: scroll;
    overflow-x: hidden;
  }
  #frame #sidepanel #contacts::-webkit-scrollbar {
    display: none;
  }
}
#frame #sidepanel #contacts.expanded {
  height: calc(100% - 334px);
}
#frame #sidepanel #contacts::-webkit-scrollbar {
  width: 8px;
  background: #2c3e50;
}
#frame #sidepanel #contacts::-webkit-scrollbar-thumb {
  background-color: #243140;
}
#frame #sidepanel #contacts ul li.contact {
  position: relative;
  padding: 10px 0 15px 0;
  font-size: 0.9em;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact {
    padding: 6px 0 46px 8px;
  }
}
#frame #sidepanel #contacts ul li.contact:hover {
  background: #32465a;
}
#frame #sidepanel #contacts ul li.contact.active {
  background: #32465a;
  border-right: 5px solid #435f7a;
}
#frame #sidepanel #contacts ul li.contact.active span.contact-status {
  border: 2px solid #32465a !important;
}
#frame #sidepanel #contacts ul li.contact .wrap {
  width: 88%;
  margin: 0 auto;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap {
    width: 100%;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap span {
  position: absolute;
  left: 0;
  margin: -2px 0 0 -2px;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid #2c3e50;
  background: #95a5a6;
}
#frame #sidepanel #contacts ul li.contact .wrap span.online {
  background: #2ecc71;
}
#frame #sidepanel #contacts ul li.contact .wrap span.away {
  background: #f1c40f;
}
#frame #sidepanel #contacts ul li.contact .wrap span.busy {
  background: #e74c3c;
}
#frame #sidepanel #contacts ul li.contact .wrap img {
  width: 40px;
  border-radius: 50%;
  float: left;
  margin-right: 10px;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap img {
    margin-right: 0px;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap .meta {
  padding: 5px 0 0 0;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #contacts ul li.contact .wrap .meta {
    display: none;
  }
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .name {
  font-weight: 600;
  color:skyblue;
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
  margin: 5px 0 0 0;
  padding: 0 0 1px;
  font-weight: 400;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -moz-transition: 1s all ease;
  -o-transition: 1s all ease;
  -webkit-transition: 1s all ease;
  transition: 1s all ease;
}
#frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
  position: initial;
  border-radius: initial;
  background: none;
  border: none;
  padding: 0 2px 0 0;
  margin: 0 0 0 1px;
  opacity: .5;
}
#frame #sidepanel #bottom-bar {
  position: absolute;
  width: 100%;
  bottom: 0;
}
#frame #sidepanel #bottom-bar button {
  float: left;
  border: none;
  width: 50%;
  padding: 10px 0;
  background: #32465a;
  color: #f5f5f5;
  cursor: pointer;
  font-size: 0.85em;
  font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button {
    float: none;
    width: 100%;
    padding: 15px 0;
  }
}
#frame #sidepanel #bottom-bar button:focus {
  outline: none;
}
#frame #sidepanel #bottom-bar button:nth-child(1) {
  border-right: 1px solid #2c3e50;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button:nth-child(1) {
    border-right: none;
    border-bottom: 1px solid #2c3e50;
  }
}
#frame #sidepanel #bottom-bar button:hover {
  background: #435f7a;
}
#frame #sidepanel #bottom-bar button i {
  margin-right: 3px;
  font-size: 1em;
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button i {
    font-size: 1.3em;
  }
}
@media screen and (max-width: 735px) {
  #frame #sidepanel #bottom-bar button span {
    display: none;
  }
}
#frame .content {
  float: right;
  width: 60%;
  height: 100%;
  overflow: hidden;
  position: relative;
}
@media screen and (max-width: 735px) {
  #frame .content {
    width: calc(100% - 58px);
    min-width: 300px !important;
  }
}
@media screen and (min-width: 900px) {
  #frame .content {
    width: calc(100% - 340px);
  }
}
#frame .content .contact-profile {
  width: 100%;
  height: 60px;
  line-height: 60px;
  background: #f5f5f5;
  margin-top:10px;
}
#frame .content .contact-profile img {
width: 40px;
    border-radius: 50%;
    float: left;
    margin: 13px 12px 0 9px;
    border: 2px solid skyblue;
}
#frame .content .contact-profile p {
    float: left;
    font-size: 13px;
    margin-top: 15px;
    margin-right: 15px;
	
}
#frame .content .contact-profile .social-media {
  float: right;
}
#frame .content .contact-profile .social-media i {
  margin-left: 14px;
  cursor: pointer;
}
#frame .content .contact-profile .social-media i:nth-last-child(1) {
     margin-left: 0px;
    margin-top: 7px;
    background-color: red;
    border-radius: 50%;
    padding: 7px;
    color: #f1f1f1;
}
#frame .content .contact-profile .social-media i:hover {
  color: #435f7a;
}
#frame .content .messages {
  height: 550px;
  overflow-y: scroll;
  overflow-x: hidden;
}
@media screen and (max-width: 735px) {
  #frame .content .messages {
    max-height: calc(100% - 105px);
  }
}
#frame .content .messages::-webkit-scrollbar {
  width: 8px;
  background: transparent;
}
#frame .content .messages::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
}
#frame .content .messages ul li {
  display: inline-block;
  clear: both;
  float: left;
  margin: 15px 15px 5px 15px;
  width: calc(100% - 25px);
  font-size: 0.9em;
}
#frame .content .messages ul li:nth-last-child(1) {
  margin-bottom: 20px;
}
#frame .content .messages ul li.sent img {
  margin: 6px 8px 0 0;
}
#frame .content .messages ul li.sent p {
  background: #435f7a;
  color: #f5f5f5;
}
#frame .content .messages ul li.replies img {
  float: right;
  margin: 6px 0 0 8px;
}
#frame .content .messages ul li.replies p {
  background: #f5f5f5;
  float: right;
}
#frame .content .messages ul li img {
  width: 22px;
  border-radius: 50%;
  float: left;
}
#frame .content .messages ul li p {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 20px;
  max-width: 205px;
  line-height: 130%;
}
@media screen and (min-width: 735px) {
  #frame .content .messages ul li p {
    max-width: 300px;
  }
}
#frame .content .message-input {
  position: absolute;
  bottom: 0;
  width: 100%;
  z-index: 99;
}
#frame .content .message-input .wrap {
  position: relative;
}
#frame .content .message-input .wrap input {
  font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
  float: left;
  border: 1 px solid #32465a;
  width: calc(100% - 90px);
  padding: 11px 32px 10px 8px;
  font-size: 0.8em;
  color: #32465a;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap input {
    padding: 15px 32px 16px 8px;
  }
}
#frame .content .message-input .wrap input:focus {
  outline: none;
}
#frame .content .message-input .wrap .attachment {
  position: absolute;
  right: 60px;
  z-index: 4;
  margin-top: 10px;
  font-size: 1.1em;
  color: #435f7a;
  opacity: .5;
  cursor: pointer;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap .attachment {
    margin-top: 17px;
    right: 65px;
  }
}
#frame .content .message-input .wrap .attachment:hover {
  opacity: 1;
}
#frame .content .message-input .wrap button {
 float: right;
    border: none;
    width: 50px;
    padding: 13px 0;
    cursor: pointer;
    background: #32465a;
    color: #f5f5f5;
}
@media screen and (max-width: 735px) {
  #frame .content .message-input .wrap button {
    padding: 16px 0;
  }
}
#frame .content .message-input .wrap button:hover {
  background: #435f7a;
}
#frame .content .message-input .wrap button:focus {
  outline: none;
}
input#search
{
	display:none;
}
input[type="radio"], input[type="checkbox"] {
    margin: 18px 11px 0px !important; 
    line-height: normal;
}
#upic
{
border-radius: 50%;
    border: 3px solid skyblue;
    float: left;
}
p.preview
{
    display:none;
}
i.fa.fa-chevron-down.expand-button
{
	display:none;
}

legend {
  font-size:90%;
  text-align:right;
  }
  #warning_msg {
  color: red;
  font-size: 13px;
  margin-left: 1em !important;
}

#warning_groupmsg
{
   color: red;
    font-size: 13px;
    margin-left: 1em !important;
    float: left;
    width: 100%;
    margin-top: -40px;
}
#warning_singlemsg
{
    color: red;
    font-size: 13px;
    margin-left: 1em !important;
    float: left;
    width: 100%;
    margin-top: -40px;
}
#warning_checkbox
{
 color: red;
 font-size: 13px;
 margin-left: 1em !important;	
}

.ks-text {
    position: relative;
    display: inline-block;
}

.ks-text .tooltiptext {
   visibility: hidden;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    font-size: 10px;
    position: absolute;
    z-index: 1;
    background-color: #2c3e50;
	width:100px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.ks-text:hover .tooltiptext {
    visibility: visible;
}
.t-center.s-text8.footer_bt
{
	margin-top:40px !important;
}
</style>
	<?php require_once('templates/header.php');?>
	
	
<div class="container-fluid" id="frame">

<div class="create_group ">

<button type="button" style=" border: 0;background: transparent;color: #337ab7;outline: 0;float: right;margin-top: 16px;font-size: 31px;">
		<span class="ks-text" data-toggle="modal" data-target="#addmember">
									<i class="fa fa-user-plus" aria-hidden="true"></i>
									<span class="tooltiptext">Create Group</span>
								</button>

</div>

<!---edit chat room-->
<div class="modal fade" id="editchatroom" role="dialog">
  <input type="hidden" name="send_msg" id="send_msg" value="">
 <input type="hidden" name="edit_group_name" id="edit_group_name" value="">
 <div id="chatroomedit"></div>
  </div>
  <!---close chat room-->


 <div class="modal fade" id="addmember" role="dialog">
    <div class="modal-dialog" style="margin: 0;margin-top: 21%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"style="background-color: red; border-radius: 50%;width: 5%;">&times;</button>
          <div id="memberadded"></div>
          <button type="button"  class="btn btn-warning"><h4 class="modal-title" style="color:#fff;font-size:11px">Create Group</h4></button>
        </div>
        <div class="modal-body">
         
		 
			 <input id="group_name" style="width: 100%; padding: 6px 20px;margin: 8px 0;box-sizing: border-box;background-color: #e6e0e0;"  placeholder="Group Name">
			 <p id="warning_msg" style="display:none">Please enter group name</p>
			<br>
			 <input type="text" name="search_user" style="width: 100%; padding: 6px 20px;margin: 8px 0;box-sizing: border-box;background-color: #e6e0e0;" id="search_user" placeholder="Search Contacts..." />
              <p id="warning_checkbox" style="display:none">Please select one user aleast</p>
			  <br>
			 <br>
			  <fieldset>
    <legend>Select users:</legend>
			 <ul data-spy="scroll" class="adding_usergroupchat " style="width: 100px;height: 300px;overflow-y: auto;overflow-x: hidden;width:450px;">
		<?php
            if (isset($_SESSION['id'])) {
                 $member_id = $_SESSION['id'];
            }  
			
			 $sender_name=$_SESSION['username'];
			 
			 $query=mysqli_query($con, "SELECT name, user_picture FROM users WHERE id = '$member_id'");
			 $res = mysqli_fetch_assoc($query);
			   $user_name=$res['name'];
			  $user_picture=$res['user_picture'];
			  echo "<input type='hidden' id='sender_image' value='".$user_picture."'>";
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
                        
						$name=$friendsa['name'];
						?>
					<li style="height:50px;" class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')" >
					<input type="checkbox" style="float:left;" name="friend" id="usersname" upic="<?php echo $friendsa['user_picture'];?>" uid="<?php echo $friendsa['id']; ?>" value="<?php echo $friendsa['id']; ?>">
					<div class="wrap">
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>"  id="upic"  alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;" >
				<?php } ?>
						<div class="meta">
							<p class="name"  style="margin-top: 8px;float: left; "><?php echo $friendsa['name']; ?></p>
						</div>
					</div>
				</li>
				 <?php
                    } else {
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
						$name=$friendsa['name'];
                        ?>
			<li style="height:50px;" class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')">
			<input type="checkbox"  style="float:left;" name="friend" id="usersname" upic="<?php echo $friendsa['user_picture'];?>" aid="<?php echo $friendsa['id']; ?>" value="<?php echo $friendsa['id']; ?>">	
					<div class="wrap" >
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt=""  id="upic" width="50" height="50"  style="float:left;border-radius:50%;border:3px solid skyblue;" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
				<?php } ?>
						<div class="meta" style="margin-left:20%;">
							<p class="name" style="margin-top: 8px;float: left;"><?php echo $friendsa['name']; ?> </p>
						</div>
					</div>
				</li>
				<?php
                    }
                }
            } else {



                echo 'You do not have friends ';
            }
            ?>
			</ul>
			  </fieldset>
        </div>
        <div class="modal-footer">
		 <button type="submit" id="add_member" class="btn btn-info"  style="font-size:11px;">Create Group</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="font-size:11px;">Close</button> 
        </div>
         
      </div>
      
    </div>
  </div>
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
			<?php
			if (isset($_SESSION['id'])) {
                 $member_id = $_SESSION['id'];
            }  
			
			 $sender_name=$_SESSION['username'];
			 
			 $query=mysqli_query($con, "SELECT name, user_picture FROM users WHERE id = '$member_id'");
			 $res = mysqli_fetch_assoc($query);
			   $user_name=$res['name'];
			  $user_picture=$res['user_picture'];
             
				if($user_picture== ""){ ?>
				<img src="users-images/user.png" alt="" />
				<?php }else {?>
				<img id="profile-img" src="users-images/<?php echo $user_picture;?>" class="online" alt="" />
				<?php } ?>
                 
				<p><?php echo $user_name;?></p>
				<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
						<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
						<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
						<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
					</ul>
				</div>
				<div id="expanded">
					<label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="mikeross" />
					<label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="ross81" />
					<label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="mike.ross" />
				</div>
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" name="search_text" id="search_text" placeholder="Search Contacts..." />
		</div>
		<div id="contacts">
		<ul class="user" style="font-size: 13px;margin: 0px 2px;">
			<?php
            if (isset($_SESSION['id'])) {
                 $member_id = $_SESSION['id'];
            }  
			
			 $sender_name=$_SESSION['username'];
			 
			 $query=mysqli_query($con, "SELECT name, user_picture FROM users WHERE id = '$member_id'");
			 $res = mysqli_fetch_assoc($query);
			   $user_name=$res['name'];
			  $user_picture=$res['user_picture'];
			  echo "<input type='hidden' id='sender_image' value='".$user_picture."'>";
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
                        
						$name=$friendsa['name'];
						?>
				<li class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')" id="chat_username<?php echo $friendsa['id']; ?>">
					<div class="wrap">
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt=""  style="border: 2px solid skyblue;"/>
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>"  id="upic"  alt="" style="border: 2px solid skyblue;" >
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $friendsa['name']; ?></p>
						</div>
					</div>
				</li>
				 <?php
                    } else {
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
						$name=$friendsa['name'];
                        ?>
						<li class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')">
					<div class="wrap" >
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt=""  id="upic"  />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>" alt="">
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $friendsa['name']; ?> </p>
						</div>
					</div>
				</li>
				<?php
                    }
                }
            } else {



                echo 'You do not have friends ';
            }
            ?>
			
		
			
			</ul>
	<ul id="viewgroupchatuser">
			<div id="group_chatreq"></div>
			</ul>
		<ul class="user1">				 
				<div id="viewupcomingrequest"></div>
		</ul>
		</div>
		<!--<div id="bottom-bar">
			<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
			<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
		</div>-->
	</div>
	<div class="content" id="single_chat" style="display:none;">
	
		<div class="contact-profile" id="contact-single"> 
			<!--<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
			<p>Harvey Specter</p>
			<div class="social-media">
				<i class="fa fa-facebook" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				 <i class="fa fa-instagram" aria-hidden="true"></i>
			</div>-->
		</div>
		<div class="messages" id="single_message">
		<ul>
		<div id="singlechat_area"></div>
		</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="text" style="margin-bottom:47px !important; border: 1px solid #32465a !important; width:96%;" class="singlechat" placeholder="Write your message..." />
      <!--<input type="hidden" name="chk_user" value="single" id="chk_user">-->
			<button class="submit" id="single_submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
			 <p id="warning_singlemsg" style="display:none">Please enter Message</p>
		</div>
	</div>
	
	
	<p id="groupdel"></p>
	<div class="content" id="group_chat" style="display:none;">
	<div id="groupuserlist"></div>
	<input type="hidden" id="totalchatmember" value="">
		<div class="contact-profile" id="contact-group" style="width: 100%;height: 60px;line-height: 60px;background: #33475a;margin-top: 10px;">
		
			<!--<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
			<p>Harvey Specter</p>
			<div class="social-media">
				<i class="fa fa-facebook" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				 <i class="fa fa-instagram" aria-hidden="true"></i>
			</div>-->
		</div>
		<div class="messages" id="group_message">
	    <ul>
		<div id="groupchat_area"></div>
		</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="hidden" id="send_msg" value="">
			<input type="text" style="margin-bottom:47px !important; border: 1px solid #32465a !important; width: 96%;" class="groupchat" placeholder="Write your message..." />
     <!-- <input type="hidden" name="chk_user" value="single" id="chk_user">-->
			<button class="submit" id="group_submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
			<p id="warning_groupmsg" style="display:none">Please enter Message</p>
		</div>
	</div>
	
	
	
	
	
		<div class="messages" id="sendrequest"  style="display:none;">
	    <ul id="contact-sendrequest">
		  
		</ul>
		<input type="hidden" value="" id="u_name">
		<input type="hidden" value="" id="u_img">
		</div>
		
		
		
		<div class="messages" id="acceptrequest"  style="display:none;">
	    <ul id="contact-acceptrequestrequest">
		  
		</ul>

		</div>
	


</div>
<?php //require_once('templates/footer.php');?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script>
var userid,uimage,uname;
function mydata(id,name,img)
{
	//alert("single");
	userid=id;
  uimage=img;
  uname=name;
  if(img=='')
	{
		img='user.png';
		
	}
	$("#single_chat").css("display", "block");
	$("#group_chat").css("display", "none");
	  $('#contact-single').empty();
    $("<img src='users-images/"+img+"' alt=''/><p style='font-family: Poppins-bold;font-size: 22px;margin-top:10px;'>"+name+"</p><div class='social-media'><p class='btn btn-danger' style='color:white;' onclick='remove_friend("+userid+")'>Remove Friend</p></div>").appendTo( "#contact-single" );
	var sender_id=<?php echo $member_id;?>;
$.ajax({
			url: 'view_chat.php',
			type: 'POST',
			async: false,
			data:{
				userid: userid,
				sender_id: sender_id,
			},
			success: function(response){
				$('#singlechat_area').html(response);
				$("#singlechat_area").scrollTop($("#singlechat_area")[0].scrollHeight);
				  setTimeout("display_chat()", 500);
			}
		});
	
}
</script>
<script>
function chatroom(chatroomname,chatroom_no,create_userid,userid)
{
	
	// alert(chatroom_no);
	 document.getElementById("send_msg").value = chatroom_no;
	 document.getElementById("edit_group_name").value = chatroomname;
	 //document.getElementById("totalchatmember").value = chatmember;

	 
	 
		//alert("group");
	$("#group_chat").css("display", "block");
	$("#single_chat").css("display", "none");
	$("#sendrequest").css("display", "none");
	$("#acceptreq").css("display", "none");
	
	 $('#contact-group').empty();
	 $("<img src='users-images/user.png' alt=''/><p>"+chatroomname+"</p><p id='chat_member' style='margin-top: 35px;font-size: 12px;margin-left: 60px;position: absolute;'></p><div class='social-media' style='display:none;'>"+chatroom_no+" </div>").appendTo( "#contact-group" );
	
	 $.ajax({
			 url: 'delete_group.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroom_no
		 },
		 success: function(response){
				 $('#groupdel').html(response);
			
		 }
		 });
	
 $.ajax({
			 url: 'fetch_groupchat.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroom_no
		 },
		 success: function(response){
				 $('#groupchat_area').html(response);
				  setTimeout("display_chatgroup();", 500);
		 }
		 });
		 
		  $.ajax({
			 url: 'viewgroupchatuser.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroom_no
		 },
		 success: function(response){
			  var chatmember = $('<div />').append(response).find('.xyz').html();
			  document.getElementById("totalchatmember").value = chatmember;
			  $('#groupuserlist').html(response);
		 }
		 });
		 
		 
		   $.ajax({
   url:"chat_membervalue.php",
   method:"POST",
   data:{
	   chatmembervalue:1,
	   chatroomno: chatroom_no
	   },
   success:function(data)
   {
	   // alert(data);
    $('#chat_member').html(data);
   }
  });
	
}
</script>




<script>
//$(".single").animate({ scrollTop: $(document).height() }, "slow");
$(document).on("click", "#single_submit", function(e) {
  
		 //alert("hello");
		 var sender_id=<?php echo $member_id;?>;
		var sender_name='<?php echo $sender_name;?>';
		var sender_img=$("#sender_image").val();
		var message = $(".singlechat").val();
		
		if(message=='')
		{
		$("#warning_singlemsg").css("display", "inline");		
			
		}
		else
		{
			
			 $.ajax({
			url: 'send_chat.php',
			type: 'POST',
			async: false,
			data:{
				userid: userid,
				uname: uname,
				uimage: uimage,
				sender_id: sender_id,
				sender_name: sender_name,
				sender_img: sender_img,
				message:message
			},
			success: function(response){
				
				$(".singlechat").val('');
				$("#warning_singlemsg").css("display", "none");	
				var sender_id=<?php echo $member_id;?>;
				$.ajax({
							url: 'view_chat.php',
							type: 'POST',
							async: false,
							data:{
								userid: userid,
								sender_id: sender_id,
							},
							success: function(response){
								$('#singlechat_area').html(response);
								$('#single_message').scrollTop($('#single_message')[0].scrollHeight);
								  setTimeout("display_chat()", 500);
								 
							}
						});

				//$("#single_message").animate({ scrollTop: $(document).height() }, "fast");
				
			}
				
		});
			
		}
		 
		

    return false;
	 
});
</script>






<script>
$("#single_message").animate({ scrollTop: $(document).height() }, "fast");
$(document).on("keypress", ".singlechat", function(e) {
     if (e.which == 13) {
		 
		 var sender_id=<?php echo $member_id;?>;
		var sender_name='<?php echo $sender_name;?>';
		var sender_img=$("#sender_image").val();
		var message = $(".singlechat").val();
		
		if(message=='')
		{
		$("#warning_singlemsg").css("display", "inline");		
			
		}
		else
		{
		 
		 		 $.ajax({
			url: 'send_chat.php',
			type: 'POST',
			async: false,
			data:{
				userid: userid,
				uname: uname,
				uimage: uimage,
				sender_id: sender_id,
				sender_name: sender_name,
				sender_img: sender_img,
				message:message
			},
			success: function(response){
				
				$(".singlechat").val('');
				$("#warning_singlemsg").css("display", "none");	
				
				var sender_id=<?php echo $member_id;?>;
				$.ajax({
							url: 'view_chat.php',
							type: 'POST',
							async: false,
							data:{
								userid: userid,
								sender_id: sender_id,
							},
							success: function(response){
								$('#singlechat_area').html(response);
							 $('#single_message').scrollTop($('#single_message')[0].scrollHeight);
								  setTimeout("display_chat()", 500);
								 
							}
						});

				//$("#single_message").animate({ scrollTop: $(document).height() }, "fast");
				
			}
				
		});   
		    
		}
		

    return false;
	 }
});
</script>
<script>
function display_chat()
{
	var sender_id=<?php echo $member_id;?>;
$.ajax({
			url: 'view_chat.php',
			type: 'POST',
			async: false,
			data:{
				userid: userid,
				sender_id: sender_id,
			},
			success: function(response){
				$('#singlechat_area').html(response);
			//	$("#singlechat_area").scrollTop($("#singlechat_area")[0].scrollHeight);
				 setTimeout("display_chat()", 500);
			}
		});
}
</script>


<script>
$("#group_message").animate({ scrollTop: $(document).height() }, "fast");
$(document).on("click", "#group_submit", function(e) {
     
		 
		// alert("group");
		 
		  var sender_id=<?php echo $member_id;?>;
		var sender_name='<?php echo $sender_name;?>';
		var sender_img=$("#sender_image").val();
		var message = $(".groupchat").val();
		var chatroomno=$("#send_msg").val();
		
		if(message=='')
				{
			$("#warning_groupmsg").css("display", "inline");	
			//alert("please enter a message");	
				}
				else

				{
					
					 $.ajax({
			url: 'sendgroupchat.php',
			type: 'POST',
			async: false,
			data:{
				sender_id: sender_id,
				sender_name: sender_name,
				sender_img: sender_img,
				message:message,
				chatroomno:chatroomno
			},
			success: function(response){
				$(".groupchat").val('');
				$("#warning_groupmsg").css("display", "none");	

				$.ajax({
			 url: 'fetch_groupchat.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroomno
		 },
		 success: function(response){
			 
		 $('#groupchat_area').html(response);
		 $('#group_message').scrollTop($('#group_message')[0].scrollHeight);
		//$("#groupchat_area").scrollTop($("#groupchat_area")[0].scrollHeight);
			 setTimeout('display_chatgroup()', 500);
				
		 }
		 });
			
			}
		});
						
					
				}
		 
		 
		 
    return false;
	
     
});
</script>



<script>
$("#group_message").animate({ scrollTop: $(document).height() }, "fast");
$(document).on("keypress", ".groupchat", function(e) {
     if (e.which == 13) {
		 
		 //alert("group");
		 
		  var sender_id=<?php echo $member_id;?>;
		var sender_name='<?php echo $sender_name;?>';
		var sender_img=$("#sender_image").val();
		var message = $(".groupchat").val();
		var chatroomno=$("#send_msg").val();
		
		if(message=='')
				{
			$("#warning_groupmsg").css("display", "inline");	
			//alert("please enter a message");	
				}
				else
				{
				   		 
		  $.ajax({
			url: 'sendgroupchat.php',
			type: 'POST',
			async: false,
			data:{
				sender_id: sender_id,
				sender_name: sender_name,
				sender_img: sender_img,
				message:message,
				chatroomno:chatroomno
			},
			success: function(response){
				$(".groupchat").val('');
				$("#warning_groupmsg").css("display", "none");

				$.ajax({
			 url: 'fetch_groupchat.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroomno
		 },
		 success: function(response){
			 
		 $('#groupchat_area').html(response);
	 $('#group_message').scrollTop($('#group_message')[0].scrollHeight);
			 setTimeout('display_chatgroup()', 500);
				
		 }
		 });
			
			}
		}); 
				    
				}

		 
    return false;
	
     }
});
</script>
<script>
function display_chatgroup()
{
	
	var chatroomno=$("#send_msg").val();
	//alert(chatroomno);
	//alert("welcome");
 $.ajax({
			 url: 'fetch_groupchat.php',
			 type: 'POST',
			 async: false,
			 data:{
			 chatroomno: chatroomno
		 },
		 success: function(response){
				 $('#groupchat_area').html(response);
			 $("#groupchat_area").scrollTop($("#groupchat_area")[0].scrollHeight);
				 setTimeout("display_chatgroup();", 500);
		 }
		 });
}

</script>
<script>
 $(document).on('click', '#add_member', function(){
	 
    var group_name = $("#group_name").val();
		var uid = $('input[name=friend]:checked').map(function(){
                  return this.value;
              }).get().join()
			  	
				if(group_name=='')
				{
				$("#warning_msg").css("display", "inline");	
				//alert("please enter a group name");	
				}
				else if(uid=='')
				{
				//alert("please select users atleast one");	
				$("#warning_checkbox").css("display", "inline");		
				}
				else
				{
	
		  	$.ajax({
				url:"create_usergroup.php",
				method:"POST",
				data:{
					group_name: group_name,
					uid: uid
				},
				success:function(data){
				$('.user').html(data);
				window.location.href='chatting.php';
				}
			});
		 }
		  });
		
	</script>
<script>
$(document).ready(function(){
	
$('#search_text').keyup(function(){
	finddroupchat();
   var search = $(this).val();
   function finddroupchat()
	{
		//alert("fhiiiiii");
		 $.ajax({
   url:"finddroupchat.php",
   method:"POST",
   data:{search:search},
   success:function(data)
   {
	   //alert(data);
    $('.user').html(data);
   }
  });
	}
   if(search== '')
   {
   $("#viewgroupchatuser").hide();
   window.location='chatting.php';
   }
   else
   {
	   finddroupchat();
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{search:search},
   success:function(data)
   {
	   //alert(data);
    $('.user').html(data);
   }
  });
   }
 
 //load_data();
 //load_data1();
// function load_data1(query)
 // {
  // $.ajax({
   // url:"fetch_username.php",
   // method:"POST",
   // data:{query:query},
   // success:function(data)
   // {
	   // //alert(data);
    // $('.user').html(data);
   // }
  // });
 // }
 // function load_data(query)
 // {
  // $.ajax({
   // url:"fetch_username1.php",
   // method:"POST",
   // data:{query:query},
   // success:function(data)
   // {
	   // //alert(data);
    // $('.user').html(data);
   // }
  // });
 // }
 // $('#search_text').keyup(function(){
  // var search = $(this).val();
 
  // if(search != '')
  // {
  // $("#viewgroupchatuser").hide();
   // load_data(search);
   
    // $.ajax({
   // url:"searchmyfriends.php",
   // method:"POST",
   // data:{search:search},
   // success:function(data)
   // {
	   // //alert(data);
    // $('.user').html(data);
   // }
  // });
  // }
  // else
  // {
   // load_data();
   // window.location='view_friends.php';
  // }
  });
 });
</script>
<script>
function send_request(uid,uname,uimg)
{

if(uimg=='')
	{
		uimg='user.png';
		
	}
	//alert("sendrequest");
	//alert(uid);
	//alert(uname);
	//alert(uimg);

	$("#sendrequest").css("display", "block");
	$("#group_chat").css("display", "none");
	$("#single_chat").css("display", "none");
	$("#acceptreq").css("display", "none");
	
	document.getElementById("u_name").value = uname;
	document.getElementById("u_img").value = uimg;
	
	

  $('#contact-sendrequest').empty();

  {	  
 $("<li class='sent'><img src='users-images/"+uimg+"' style='margin-left: 622px;border-radius: 50%;margin-top: 177px;border: 4px solid skyblue;'/><p style='width: 26%;margin-left: 58%;margin-top: 1%;'>"+uname+"</p><p class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1' style=' margin-left: 56%;margin-top: 1%;width: 166px;' onclick='sendingrequest("+uid+")' id='"+uid+"'>Add as Friends</p></li>"). appendTo( "#contact-sendrequest" );
  } 
}
</script>
<script>
function sendingrequest(uid)
{

 var uname = $("#u_name").val();
  var uimg = $("#u_img").val();
    var sender_id=<?php echo $member_id;?>;
		var sender_name='<?php echo $sender_name;?>';
		var sender_img=$("#sender_image").val();
		
		$.ajax({
                type: 'post',
                url: 'sendchat-request.php',
             
    			 data: {
    
                        uid: uid,
                        uname :uname,
    					uimg :uimg,
    					sender_id :sender_id,
    					sender_name :sender_name,
    					sender_img : sender_img
    					
                                   },
                success: function (result) {
    				$('#' + uid).html(result);
                 //$("#display").html(result).show();
    			 
    			 
    			  //$(".pexample").text("Hello world!");
    			   //$(".pexample:first").replaceWith("Hello world!");
                }
              });
  

}
</script>
<script>
function accpet_request(uid,uname,uimg)
{
	
	if(uimg=='')
	{
		uimg='user.png';
		
	}
	
	$("#srequest").css("display", "none");
	$("#chatroom").css("display", "none");
	$("#acceptrequest").css("display", "block");
	$("#sendrequest").css("display", "none");
    $("#group_chat").css("display", "none");
	$("#single_chat").css("display", "none");
	$('#contact-acceptrequestrequest').empty();
 
 $("<li class='sent'><img src='users-images/"+uimg+"' style='margin-left: 614px;border-radius: 50%;margin-top: 70px;'/><p style=' width: 26%;margin-left: 51%;font-family: Poppins-bold;margin-top: 1%;position: absolute;'>"+uname+"</p><p class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1' style='width: 15%;margin-left: 52%;margin-top: 3%;' onclick=\"acceptrequest('"+uid+"','"+uname+"','"+uimg+"')\" id='"+uid+"'>Accept Request</p><p class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1' style='width: 15%;margin-left: 52%;margin-top: 1%;' id='removereq' onclick=\"removerequest('"+uid+"','"+uname+"','"+uimg+"')\">Reject Request</p></li>"). appendTo( "#contact-acceptrequestrequest" );
 
}	
</script>

<script>
function acceptrequest(uid,uname,uimg)
{
$.ajax({
            type: 'post',
            url: 'accepting_request.php',
         data: {

                    uid: uid
					},
            success: function (result) {
				$('#' + uid).html(result);
				window.location='chatting.php';
            }
          });
	
}
</script>

<script>
function removerequest(uid,uname,uimg)
{
	
$.ajax({
            type: 'post',
            url: 'removeing_request.php',
         data: {

                    uid: uid
					},
            success: function (result) {
			$('#removereq').html(result);
				$("#contact-acceptrequestrequest").css('display','none');
				$("#viewupcomingrequest").css('display','none');
            }
          });
	   
}
</script>
<script>
function remove_friend(uid)
{
	
	var answer = confirm ("Are you sure you want to delete?");
	 if (answer)
  {
	//alert(uid);
	  $.ajax({
            type: 'post',
            url: 'deletefriends.php',
         data: {
                    uid: uid
					},
            success: function (result) {
				$('#' + uid).html(result);
				window.location='chatting.php';
            }
          });
		  } 
}
</script>
<script>
function groupsearch()
 {
  $.ajax({
   url:"groupsearch.php",
   method:"POST",
   data:{groupsearch:1},
   success:function(data)
   {
	   // alert(data);
    $('.adding_usergroupchat').html(data);
   }
  });
 } 
 </script>
<script>
$(document).ready(function(){
$('#search_user').keyup(function(){
	
   var search = $(this).val();
   
   if(search== '')
   {
	groupsearch();
   //$("#search_user").hide();
   //window.location='view_friends.php';
   }
   else
   {
  $.ajax({
   url:"fetch_usergroup.php",
   method:"POST",
   data:{search:search},
   success:function(data)
   {
	   //alert(data);
    $('.adding_usergroupchat').html(data);
   }
  });
   }
  });
 });
</script>

<script>
function delete_group(chatroomno)
{
	
		var uid="<?php echo $member_id;?>";
		
		var answer = confirm ("Are you sure you want to delete?");
	 if (answer)
  {
	//alert(uid);
	  $.ajax({
            type: 'post',
            url: 'deletegroupchat.php',
         data: {
                    uid: uid,
				chatroomno:chatroomno
					},
            success: function (result) {
				
				window.location='chatting.php';
            }
          });
		  } 

}
</script>
<script>
function leave_group(chatroomno)
{
	var answer = confirm ("Are you sure you want to delete?");
	var uid="<?php echo $member_id;?>";
	//alert("leave chat");
	//alert(chatroomno);
	//alert(uid);
	 if (answer)
  {
	  $.ajax({
            type: 'post',
            url: 'leavegroupchat.php',
         data: {
                    uid: uid,
				chatroomno:chatroomno
					},
            success: function (result) {
				
				window.location='chatting.php';
            }
          });
  }
		  } 
</script>
<script>
function editchatroom()
{
	
	var chatroomno = $("#send_msg").val();
	var chatroomname = $("#edit_group_name").val();
	// alert("editchatroom");
	// alert(chatroomno);
	// alert(chatroomname);
	 $.ajax({
            type: 'post',
            url: 'editchatroom.php',
         data: {
                    chatroomno: chatroomno,
				chatroomname:chatroomname
					},
            success: function (result) {
				 $('#chatroomedit').html(result);
				//window.location='chatting.php';
            }
          });
	
}

</script>
<script>
function updatechatroom(chatroomno,uid)
{
	
	var chatroomname = $("#chatroomname").val();
	var updatechat = $('input[name=updatechat]:checked').map(function(){
                  return this.value;
              }).get().join()
			 // alert(updatechat);
	//alert("updatechatroom");
	//alert(chatroomno);
	//alert(uid);
	
		$.ajax({
				url:"updatechatroom.php",
				method:"POST",
				data:{
					chatroomno: chatroomno,
					uid: uid,
					updatechat:updatechat,
					chatroomname:chatroomname
				},
				success:function(data){
				$('.user').html(data);
				window.location.href='chatting.php';
				}
			});
	
	
}

</script>
<script>
function updatesearch()
 {
  $.ajax({
   url:"updatesearch.php",
   method:"POST",
   data:{updatesearch:1},
   success:function(data)
   {
	   // alert(data);
    $('.adding_usergroupchat').html(data);
   }
  });
 } 
 </script>
<script>
function updatingsearch()
{
$('#update_user').keyup(function(){
	 var search = $(this).val();
   
   if(search== '')
   {
	updatesearch();
   //$("#search_user").hide();
   //window.location='view_friends.php';
   }
   else
   {
  $.ajax({
   url:"fetch_updategroup.php",
   method:"POST",
   data:{search:search},
   success:function(data)
   {
	   //alert(data);
    $('.adding_usergroupchat').html(data);
   }
  });
   }
	  });
}
	</script>
		<script>
	function viewreq()
	{
		
	 $.ajax({
   url:"viewrequest.php",
   method:"POST",
   data:{viewreq:1},
   success:function(data)
   {
	   //alert(data);
    $('#viewupcomingrequest').html(data);
   }
  });	
	}
	
	
	</script>
<script>

	 setInterval(function(){
		 viewreq();
  //load_last_notification()
 }, 500);

 function load_last_notification()
 {
	
  $.ajax({
   url:"fetch_notification.php",
   method:"POST",
   success:function(data)
   {
	  $('.contentmessagedata').html(data);
   }
  })
 }

</script>
<script>
setInterval(function(){
		 viewgrouprequest();
  //load_last_notification()
 }, 500);
 </script>
<script>
	function viewgrouprequest()
	{
		
	 $.ajax({
   url:"viewgrouprequest.php",
   method:"POST",
   data:{viewgrouprequest:1},
   success:function(data)
   {
	   //alert(data);
    $('#group_chatreq').html(data);
   }
  });	
	}
	
	
	</script>

<?php require_once('templates/footer.php');?>