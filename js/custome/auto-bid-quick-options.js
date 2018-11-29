//$(document).ready(function() {
	  $('#clear_prebid').click(function(){
		  for(var i=0; i<=27; i++){
		  document.getElementById("bid_amt"+ i).value = "0";
		  }
		  //window.location.reload();
		 // window.setTimeout(function(){location.reload()},2000);
	todo_autobid_new();
	
});
//});

/*For Bet Only on middle no (10-17)*/
$('#middle_no_autobid').click(function(){
		  for(var i=10; i<=17; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		for(var i=0; i<=9; i++){
		  var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		 for(var i=18; i<=27; i++){
		  var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		 }
  todo_autobid_new();
});

/*For Bet Only on side no (00-09,18-27)*/
$('#side_no_autobid').click(function(){
		  for(var i=0; i<=9; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		 for(var i=18; i<=27; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		 }
		 for(var i=10; i<=17; i++){
		   var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		 todo_autobid_new(); 
});

/*For Bet Only on Small no (0-13)*/
$('#small_no_autobid').click(function(){
		  for(var i=0; i<=13; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		for(var i=14; i<=27; i++){
			var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		}
	todo_autobid_new();
});

/*For Bet Only on Big no (14-27)*/
$('#big_no_autobid').click(function(){
		  for(var i=14; i<=27; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		for(var i=0; i<=13; i++){
			var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		}
 todo_autobid_new();
});

/*For Bet On All no's (0-27)*/
$('#all_no_autobid').click(function(){
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		 todo_autobid_new();
		};
});

/*For Bet On Odd no's */
$('#odd_no_autobid').click(function(){
		  for(var i=1; i<=27; i+= 2){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		 for(var i=0; i<=26; i+= 2){
		 var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		todo_autobid_new();
});

/*For Bet On Even no's*/
$('#even_no_autobid').click(function(){
		  for(var i=0; i<=26; i+= 2){
		   var pay_amt = document.getElementById("default_bid"+ i).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		for(var i=1; i<=27; i+= 2){
		  var FinalValue = '00';
		  document.getElementById("bid_amt"+ i).value =FinalValue;
		};
		todo_autobid_new();
});

/*For Bet On Reverse no's*/
$('#reverse_no_autobid').click(function(){
		  for(var i=0; i<=27; i++){
		  var pay_amt = document.getElementById("default_bid"+ i).value;
		   var rrr = document.getElementById("bid_amt"+ i).value;
		   if(rrr>'00')
		   {
			 document.getElementById("bid_amt"+ i).value = '00';
			 //document.getElementById("subbtn").disabled = true;
		   }
		   if(rrr=='00')
		   {
			 document.getElementById("bid_amt"+ i).value = pay_amt;
			 //document.getElementById("subbtn").disabled = false;
		   }
		};
     todo_autobid_new();
});

/*For Bet Only on Random No's*/
$('#random_no_autobid').click(function(){
		  var slcVal = $("#coin_add").val();
		  //alert(x);
		  for(var i=0; i<=5; i++){ 
		  var x = Math.floor((Math.random() * 27) + 1);
		  //alert(x);
		  var pay_amt = document.getElementById("default_bid"+ x).value;
		  var FinalValue = +pay_amt;
		  document.getElementById("bid_amt"+ x).value =FinalValue;
		};
todo_autobid_new();
});