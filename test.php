<?php
error_reporting(0);
require_once('includes/config.php');
//phpinfo();

?>
<html>
<head>
</head>
<body>	
<div id='TextBoxesGroup'>
	<div id="TextBoxDiv1">
		<label>Textbox #1 : </label><input type='textbox' class="input-field" id='textbox1' required>
	</div>
</div>
<p id="warning" style="color:red;display:none;">Please input value fill</p>
<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--<script>
$(document.body).on("input", ".input-field:last", function (e) {
   $(this).next('#s').text($(this).val());
   var txt = $('#s').text();
 document.getElementById("value").value=txt;

  // alert(a);
   // if(a=='')
   // {
	   // alert('blank')
   // }
   // else
   // {
	  // alert(a); 
   // }
});
</script>-->
<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
		
    $("#addButton").click(function () {
		
		var last=$('.input-field:last').val();
		//alert(last);
				if(last=='')
				{
					//alert("fill");
					$("#warning").css('display','block');
				
				}
				else
				{
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);	           
	newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
	      '<input type="text" class="input-field" name="textbox' + counter + 
	      '" id="textbox' + counter + '" value="" >');
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");		
	counter++;
				}
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
</html>