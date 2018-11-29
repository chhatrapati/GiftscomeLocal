function myFunction() {
	//alert('hi');
	var slcVal = $("#slc").val();
    for(var i=0; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		  }
	todo_new();
}

  /*$(document).ready(function() {
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
});*/

$(document).ready(function() {
	  $('#clear').click(function(){
		  for(var i=0; i<=27; i++){
		  document.getElementById("payout_amount"+ i).value = "00";
		  }
		  //window.location.reload();
		 // window.setTimeout(function(){location.reload()},2000);
	todo_new();
	
});
});

/*For Bet Only on middle no (10-17)*/
$('#middle_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=10; i<=17; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet Only on side no (00-09,18-27)*/
$('#side_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=0; i<=9; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		};
		 for(var i=18; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 }
		 todo_new(); 
});

/*For Bet Only on Small no (0-13)*/
$('#small_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=0; i<=13; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet Only on Big no (14-27)*/
$('#big_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=14; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet On All no's (0-27)*/
$('#all_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  //alert(slcVal);
		  for(var i=0; i<=27; i++){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet On Odd no's */
$('#odd_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=1; i<=27; i+= 2){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet On Even no's*/
$('#even_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  for(var i=0; i<=26; i+= 2){
		   var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*For Bet On Reverse no's*/
$('#reverse_no').click(function(){
		  var slcVal = $("#coin_add").val(); //alert(slcVal);
		  for(var i=0; i<=27; i++){
		   var rrr = document.getElementById("payout_amount"+ i).value;
		   if(rrr>'00')
		   {
			 document.getElementById("payout_amount"+ i).value = '00';
			 //document.getElementById("subbtn").disabled = true;
		   }
		   if(rrr=='00')
		   {
			 document.getElementById("payout_amount"+ i).value = slcVal;
			 //document.getElementById("subbtn").disabled = false;
		   }

		  todo_new();
		 
		};
});
/*Half of current value*/
$('#half').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  if(pay_amt%2==0)
		  {
		  var FinalValue = +pay_amt * +0.5;//alert(FinalValue);
		  }
		  else
		  {
		  var FinalValue = +pay_amt * +'0.5' +0.5;//alert(FinalValue);
		  }
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*onendhalf of current value*/
$('#onendhalf').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		   if(pay_amt%2==0)
		  {
		  var FinalValue = +pay_amt * +1.5;//alert(FinalValue);
		  }
		  else
		  {
		  var FinalValue = +pay_amt * +1.5 +0.5;//alert(FinalValue);
		  }
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*Double of current value*/
$('#double').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'2';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});

/*five Mul of current value*/
$('#five').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'5';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});
/*ten mul of current value*/
$('#ten').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'10';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});
/*fifteen mul of current value*/
$('#fifteen').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'15';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});
/*twenty mul of current value*/
$('#twenty').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'20';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});
/*twentyfive mul of current value*/
$('#twentyfive').click(function(){ //alert('er');
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("payout_amount"+ i).value;
		  var FinalValue = +pay_amt * +'25';//alert(FinalValue);
		  document.getElementById("payout_amount"+ i).value =FinalValue;
		 todo_new();
		};
});
/*For Bet Only on Random No's*/
$('#random_no').click(function(){
		  var slcVal = $("#coin_add").val();
		  //alert(x);
		  for(var i=0; i<=5; i++){ 
		  var x = Math.floor((Math.random() * 27) + 1);
		  //alert(x);
		  var pay_amt = document.getElementById("payout_amount"+ x).value;
		  var FinalValue = +pay_amt + +slcVal;
		  document.getElementById("payout_amount"+ x).value =FinalValue;
		 todo_new();
		};
});
$(function () {
        $("#mySelect").change(function () {
        var selectedValue = $(this).val();
        console.log(selectedValue);
   var btn= $("button:contains('"+selectedValue+"')");
   if(btn){
   btn.click(); }
            });
    });