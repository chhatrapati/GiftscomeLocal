<?php //session_start();
require_once('includes/config.php');
?>
<!DOCTYPE html>
<head>
	<title>Refer Coins</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<?php require_once('templates/common_css.php');?>
<style>
.box {position: relative;padding: 30px 10px 5px;width: 100%;min-height: 150px;border: 1px solid grey;border-radius: 3px;background: #fff;}
.editable {border-color: #bd0f18;box-shadow: inset 0 0 10px #555;background: #f2f2f2;}
.text {outline: none;}
.edit, .save {width: 50px;display: block;position: absolute;top: 7px;right: 7px;padding: 4px 10px;border-top-right-radius: 2px;border-bottom-left-radius: 10px;
text-align: center;cursor: pointer;box-shadow: -1px 1px 4px rgba(0,0,0,0.5);}
.edit { background: #557a11;color: #f0f0f0;opacity: 0;transition: opacity .2s ease-in-out;padding-right:3%;}
.save {display: none;background: #bd0f18;color: #f0f0f0;}
.box:hover .edit {opacity: 1;}
div[data-placeholder]:not(:focus):not([data-div-placeholder-content]):before {content: attr(data-placeholder);float: left;margin-left: 2px;color: #b3b3b3;}
i.fa.fa-plus-circle.addmore, i.fa.fa-minus-circle.delete{color:#fff;background-color:#08a6cc;cursor:pointer;width:30px; margin: 2px 0 0 5px;height:30px;line-height:30px;font-size: 29px;
border-radius:50%;text-align:center;transition:0.5s all;-webkit-transition:0.5s all;-moz-transition:0.5s all;-o-transition:0.5s all;-webkit-border-radius:50%;-moz-border-radius:50%;
-o-border-radius:50%;-ms-border-radius:50%;-ms-transition:0.5s all;}
i.fa.fa-plus-circle.addmore:hover,i.fa.fa-minus-circle.delete:hover {background-color:#17233E;}
.s-text14 {color: #08a6cc;}
button.flex-c-m.size2.bg1.bo-rad-23.hov1.m-text3.trans-0-4.insert {width: 15%;float:left;height:35px;font-size: 18px;}
</style>
</head>
<body class="animsition">
<?php
require_once('templates/header.php');
require_once('includes/function.php');
//error_reporting(1);
//print_r($_SESSION);
?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Refer Friends
		</h2>
		<p class="m-text13 t-center">
			Refer Friends and Eran
		</p>
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php //require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-12 col-md-12 col-lg-12 p-b-50">
					<div id="">
				   <form id='students' method='post' name='students' action='' style="width:100%;">
    <div class="table-responsive">
        <table id="form_table" class="table table-bordered">
            <tr>
                <th class="s-text14">S. No</th>
                <th class="s-text14">Email</th>
            </tr>
            <tr class='case'>
                <td class="s-text14"><span id='snum'>1.</span></td>
                <td class="s-text13"><input class="input-field" type='email' placeholder="Enter Email To Refer" id='c1' name='c1[]' ></td>
            </tr>
        </table>
		<p id="warning" style="color:red;display:none;">Please enter valid email address</p>
        <input type="hidden" name="is_submit" value="yes"/>
        <button type="button" class='flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4 insert'>Submit</button>
        <i class="fa fa-plus-circle addmore" aria-hidden="true"></i>
	   <i class="fa fa-minus-circle delete" aria-hidden="true"></i>
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
			var last=$('.input-field:last').val();
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			//var email = document.getElementById("textEmail").value;
		//alert(last);
				if(last=='')
				{
					//alert("fill");
					$("#warning").css('display','block');
				
				}
				if (reg.test(c1.value) == false) 
        {
            $("#warning").css('display','block');
            return false;
        }

			else
			{
			$("#warning").css('display','none');
			var count = $('table tr').length;
            var data = "<tr class='case s-text13'><td><span id='snum" + count + "'>" + count + ".</span></td>";
            data += "<td><input class='s-text13 input-field' type='email' placeholder='Enter Email To Refer' id='c1' name='c1[]' style='border:1px solid #888888 !important;'/></td></tr>";
            $('#form_table').append(data);
            i++;
			}
        });
        $(".delete").on('click', function () {
            $('tr.case:last').remove();
        });
        //insert into database
        $('.insert').on('click', function(){
			var email=$('.input-field:last').val();
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		//alert(last);
				if(email=='')
				{
					//alert("fill");
					$("#warning").css('display','block');
				
				}
				if (reg.test(c1.value) == false) 
				{
					$("#warning").css('display','block');
					return false;
				}
			else
			{
				$("#warning").css('display','none');
            $.ajax({
                url: 'refer_friend.php',
                method: 'post',
                data: $('form#students').serialize(),
                success: function(data){
                    $('#record_list').html(data);
                }
            });
		}
        });
    });
</script>
</body>
</html>