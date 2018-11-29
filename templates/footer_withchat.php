<footer>

			<div class="t-center s-text8 footer_bt">
				GiftsCome  © 2018-19
			</div>
		
	</footer>
	<script>
    var siteurl = '<?php echo $config['site_url']; ?>';
    var session_uname = '<?php echo $sesUsername; ?>';
    var session_img = '<?php echo $ses_picname; ?>';
</script>

<!--ZeChat Box CSS-->
<link type="text/css" rel="stylesheet" media="all" href="chat/app/includes/chatcss/chat.css" />
<!--ZeChat Box CSS-->

<script type="text/javascript" src="chat/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="chat/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Media Uploader -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<!-- Zechat js -->
<script type="text/javascript" src="chat/app/plugins/smiley/js/emojione.min.js"></script>
<script type="text/javascript" src="chat/app/plugins/smiley/smiley.js"></script>
<script type="text/javascript" src="chat/app/includes/chatjs/lightbox.js"></script>
<script type="text/javascript" src="chat/app/includes/chatjs/chat.js"></script>
<script type="text/javascript" src="chat/app/includes/chatjs/custom.js"></script>


<script type="text/javascript" src="chat/app/plugins/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="chat/app/plugins/uploader/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<?php require_once('contact-list.php');?>


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

<script>
    $(window).load(function() {
        $('.Dboot-preloader').addClass('hidden');
    });
</script>
	<!--<div class="main-section">
	<div class="row border-chat">
		<div class="col-md-12 col-sm-12 col-xs-12 first-section">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-6 left-first-section">
					<p>Chat</p>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-6 right-first-section">
					<a href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>
					
				</div>
			</div>
		</div>
	</div>

	<div class="row border-chat">
		<div class="col-md-12 col-sm-12 col-xs-12 second-section">
			<div class="chat-section">
				<ul>
				
				<div id="chatdisplay"></div>
				
			
						
				</ul>
			</div>
		</div>
	</div>
		<form id="configform">
	<div class="row border-chat">
		<div class="col-md-12 col-sm-12 col-xs-12 third-section">
		
		  
			<div class="text-bar">
				<input type="text" id="name" placeholder="Enter Name" style="border-bottom: 1px solid #17a2b8 !important;" >
				<textarea id="chat_msg" placeholder="Write messege" rows="10" cols="40" name="message"></textarea><a href="#" id="chat">
				<i class="fa fa-arrow-right" aria-hidden="true"></i></a>				
			</div>
		</div>
	</div>
	</form>
</div>
<style>
#chatdisplay li {
    word-break: break-all;
}
textarea#chat_msg{
    width: 90%;
    margin-left: -15px;
    padding: 10px 10px;
    border: 1px solid #fff;
    height: 35px;
    overflow: hidden;
}
.main-section{
  width: 300px;
  position: fixed;
  right:50px;
  bottom:-395px;
}
.first-section:hover{
  cursor: pointer;
}
.open-more{
  bottom:0px;
  transition:2s;
}
.border-chat{
  border:1px solid #17a2b8;
  margin: 0px;
}

.first-section {
    background-color: #17a2b8;
}
.first-section p{
  color:#fff;
  margin:0px;
  padding: 10px 0px;
}
.first-section p:hover{
  color:#fff;
  cursor: pointer;
}
.right-first-section{
   text-align: right;
}
.right-first-section i{
  color:#fff;
  font-size: 15px;
  padding: 12px 3px;
}
.right-first-section i:hover{
  color:#fff;
}
.chat-section ul li{
  list-style: none;
  margin-top:10px;
  position: relative;
}
.chat-section{
  overflow-y:scroll;
  height:300px;
}
.chat-section ul{
  padding: 0px;
}
.left-chat img,.right-chat img{
  width:50px;
  height:50px;
  float:left;
  margin:0px 10px;
}
.right-chat img{
  float:right;
}
.second-section{
  padding: 0px;
  margin: 0px;
  background-color: #F3F3F3;
  height: 300px;
}
.left-chat,.right-chat{
  overflow: hidden;
}
.left-chat p,.right-chat p{
  background-color:#FD8468;
  padding: 10px;
  color:#fff;
  border-radius: 5px; 
  float:left;
  width:60%;
  margin-bottom:20px;
}
.left-chat span,.right-chat span{
  position: absolute;
  left:80%;
  top:60px;
  color:#17a2b8;
  font-size:10px;
}
.right-chat span{
  left:45px;
}
.right-chat p{
  float:right;
  background-color: #FFFFFF;
  color:#FD8468;
}
.third-section{
  border-top: 1px solid #EEEEEE;
}
.text-bar input{
  width:90%;
  margin-left:-15px;
  padding:10px 10px;
  border:1px solid #fff;
}
.text-bar a i{
  background-color:#17a2b8;
  color:#fff;
  width:30px;
  height:30px;
  padding:7px 0px;
  border-radius: 50%;
  text-align: center;
}
.left-chat:before{
  content: " ";
  position:absolute;
  top:0px;
  left:55px;
  bottom:150px;
  border:15px solid transparent;
  border-top-color:#FD8468; 
}
.right-chat:before{
  content: " ";
  position:absolute;
  top:0px;
  right:55px;
  bottom:150px;
  border:15px solid transparent;
  border-top-color:#fff; 
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
<script>
$(document).ready(function(){
    	$(".left-first-section").click(function(){
            $('.main-section').toggleClass("open-more");
        });
    });
    $(document).ready(function(){
    	$(".fa-minus").click(function(){
            $('.main-section').toggleClass("open-more");
        });
    });
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	function displaychat()
	{
	  $.ajax({
      type: 'post',
      url: 'frontchat.php',
      success: function(rr) {
        $("#chatdisplay").html(rr);
      }
    });
	}
	setInterval(function(){displaychat();},1000);
    $("#chat").click(function(){
        var name=$("#name").val();
		 var msg=$("#chat_msg").val();
		 //alert(name);
		// alert(msg);
		 $('#configform')[0].reset();
		 
		 $.ajax(
            {
      type: 'post',
      url: 'sendmsg.php',
      data: { 
        name: name, 
        msg: msg 
      },
      success: function (response) {
       // alert(response);
      }
    });
	});
});
</script>-->