<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='livechat/live_chat.css'>
<h4 class="list-heading" >Chat Box</h4>
<div id="container" class="massege-warapper">

<div id="result-wrapper">
	<div id="result" style="display:none;">
	</div>			
</div>
<form method='post' action="#" onsubmit="return post();" id="my_form" name="my_form">
<div id="form-container">
	<div class="form-text">
    	<input type="text" style="display:none" id="username" value="<?= $_SESSION['name'] ?>">
    	<input type="text" id="comment" />
    </div>
    <div class="form-btn">
    	<button type="submit" id="btn" name="btn" onclick="return post();"><i class="fa fa-paper-plane"></i> </button>
    </div>
</div>
</form>
</div>
<script>
$(document).ready(function()
    {
        $(document).bind('keypress', function(e) {
            if(e.keyCode==13){
				 
                 //$('#my_form').submit();
				  var comment = document.getElementById("comment").value;
				  var name = document.getElementById("username").value;
				  var game_id = '<?php echo $id;?>'
				  //alert(game_id);
				  if(comment && name)
				  {
					$.ajax
					({
					  type: 'post',
					  url: 'livechat/commentajax.php',
					  data: 
					  {
						 user_comm:comment,
						 user_name:name,
						 game_id:game_id
					  },
					  success: function (response) 
					  {
						document.getElementById("comment").value="";
					  }
					});
				  }
				 
				 $('#comment').val("");
 
             }
        });
	});
</script>
<script type="text/javascript">
$(document).ready(function() {
var game_id = '<?php echo $id;?>'
function post()
{

  var comment = document.getElementById("comment").value;
  var name = document.getElementById("username").value;
  if(comment && name)
  {
    $.ajax
    ({
      type: 'post',
      url: 'livechat/commentajax.php',
      data: 
      {
         user_comm:comment,
	     user_name:name,
		 game_id:game_id
      },
      success: function (response) 
      {
	    document.getElementById("comment").value="";
      }
    });
  }
  
  return false;
}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var game_id = '<?php echo $id;?>'
	window.setInterval(function(){
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "livechat/load.php",
		data: "game_id=" + game_id,  
		success: function(rr){
			//alert(rr);
			var res = rr;
			$("#result").show();
			$('#result').scrollTop($('#result')[0].scrollHeight);
			$("#result").html(rr);
			},
		});
        }, 2000);
});
</script>