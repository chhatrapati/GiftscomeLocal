<?php //session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<?php require_once('templates/common_css.php');?>
	<style>
	.box {
  position: relative;
  
  padding: 30px 10px 5px;
  width: 100%;
  min-height: 150px;
  border: 1px solid #08a6cc;
  border-radius: 3px;
  background: #fff;
}

.editable {
  border-color: #bd0f18;
  box-shadow: inset 0 0 10px #555;
  background: #f2f2f2;
}

.text {
  outline: none;
}

.edit, .save {
  width: 50px;
  display: block;
  position: absolute;
  top: 7px;
  right: 7px;
  padding: 4px 10px;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 10px;
  text-align: center;
  cursor: pointer;
  box-shadow: -1px 1px 4px rgba(0,0,0,0.5);
}

.edit { 
  background: #557a11;
  color: #f0f0f0;
  opacity: 0;
  transition: opacity .2s ease-in-out;
  padding-right:3%;
}

.save {
  display: none;
  background: #bd0f18;
  color: #f0f0f0;
}

.box:hover .edit {
  opacity: 1;
}
.s-text13:hover{
	color:#08a6cc;
	
}
.s-text14{
	color:#08a6cc;
	
}
.m-text3 {
    font-family: Montserrat-Regular;
    font-size: 13px;
    color: white;
    text-transform: uppercase;
}
.size2 {
    width: 90%;
    height: 34px;
	margin-right:1px;
}
.bg1 {
    background-color: #08a6cc;
}
.bg1:hover{
	 background-color:#000;
}
.p-b-50 {
    padding-bottom: 135px;
}
.box:hover {
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
</style>
</head>
<body class="animsition">
<?php
 require_once('templates/header.php');
//error_reporting(1);
//print_r($_SESSION);
?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/refer.png);">
		
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					
					<div class="row" id="productContainer">
				
				
				   <form id='students' method='post' name='students' action='index.php' style="width:40%;margin-left:30%;">
<div class="box">
  <span class="edit">edit</span>
  <span class="save">save</span>
  <div class="text s-text13">
    Hover this box and click on edit! - You can edit me then.
    <br>When you finished - click save and you saved it.
    </div>
</div>
  
    <div class="table-responsive">
        <table id="form_table" class="table table-bordered">
            <tr>
                <th class="s-text14">S. No</th>
                <th class="s-text14">Friend Email</th>
            </tr>
            <tr class='case'>
                <td class="s-text14"><span id='snum'>1.</span></td>
                <td class="s-text13"><input class="" type='email' placeholder="Enter Email To Refer" id='c1' name='c1[]' ></td>
               
            </tr>
        </table>
        <input type="hidden" name="is_submit" value="yes"/>
        <button type="button" class='flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4 delete' style="width: 33%;float:left;">- Delete</button>
        <button type="button" class='flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4 insert' style="width: 33%;float:left;">- Refer</button>
        <button type="button" class='flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4 addmore' style="width: 33%;float:left;">+ Add More</button>
    </div>
	
	<div id="record_list" class="s-text13"></div>
</form>
				
				

					</div>

											</div>
				</div>
			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

        <script  src="js/editable.js"></script>
<script>
    $(document).ready(function(){
        $(".addmore").on('click', function () {
            var count = $('table tr').length;
            var data = "<tr class='case s-text13'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input type='email' placeholder='Enter Email To Refer' id='c1' name='c1[]'></td></tr>";
            $('#form_table').append(data);
            i++;
        });
        $(".delete").on('click', function () {
            $('tr.case:last').remove();
        });
        //insert into database
        $('.insert').on('click', function(){
            $.ajax({
                url: 'refer_friend.php',
                method: 'post',
                data: $('form#students').serialize(),
                success: function(data){
                    $('#record_list').html(data);
                }
            });
        });
    });
</script>


</body>
</html>