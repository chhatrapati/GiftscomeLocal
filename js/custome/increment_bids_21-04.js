function myFunction() {
	var slcVal = $("#slc").val();
    for(var i=0; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		  }
	todo();
}

  $(document).ready(function() {
	  $('#MyButton').click(function(){
		  var slcVal = $("#coin_add").val();
		 //var all = document.getElementById("all").checked;
		 var rates = document.getElementsByName('add_option');
var rate_value;
for(var i = 0; i < rates.length; i++){
    if(rates[i].checked){
        rate_value = rates[i].value; //alert(rate_value);
   
		  if(rate_value=='ALL')
		  {
			  for(var i=0; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		  }
		  }
		  
		 // var odd=$("#odd").is(":checked");
		 if(rate_value=='ODD')
		  {
			  for(var i=1; i<=27; i+= 2){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		  }
		  }
		  //var even=$("#even").is(":checked");
		  if(rate_value=='EVEN')
		  {
			  for(var i=0; i<=26; i+= 2){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		  }
		  }
	 }
}
	
	todo();
});
});

$(document).ready(function() {
	  $('#clear').click(function(){
		  for(var i=0; i<=27; i++){
		  document.getElementById("payout_amount"+ i).value = "00";
		  }
	todo();
});
});