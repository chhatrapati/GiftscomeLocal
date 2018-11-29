<?php //session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<style>
.box { position: relative; padding: 30px 10px 5px; width: 100%; min-height: 150px; border: 1px solid #08a6cc; border-radius: 3px; background: #fff;}
.editable { border-color: #bd0f18; box-shadow: inset 0 0 10px #555; background: #f2f2f2;}
.text {outline: none;}
.edit, .save { width: 50px; display: block; position: absolute; top: 7px; right: 7px; padding: 4px 10px; border-top-right-radius: 2px;border-bottom-left-radius: 10px; text-align: center;
 cursor: pointer; box-shadow: -1px 1px 4px rgba(0,0,0,0.5);}
.edit { background: #557a11;color: #f0f0f0; opacity: 0; transition: opacity .2s ease-in-out;padding-right:3%;}
.save {display: none;background: #bd0f18;color: #f0f0f0;}
.box:hover .edit {opacity: 1;}
.s-text13:hover{color:#08a6cc;}
.s-text14{color:#08a6cc;}
.m-text3 {font-family: Montserrat-Regular;font-size: 13px;color: white;text-transform: uppercase;}
.size2 {width: 90%;height: 34px;margin-right:1px;}
.bg1 {background-color: #08a6cc;}
.bg1:hover{background-color:#000;}
.p-b-50 {padding-bottom: 135px;}
.box:hover {box-shadow: 0 0 11px rgba(33,33,33,.2); }
input#search {display: none;}
div[data-placeholder]:not(:focus):not([data-div-placeholder-content]):before {content: attr(data-placeholder);float: left;margin-left: 2px;color: #b3b3b3;}
i.fa.fa-plus-circle.addmore, i.fa.fa-minus-circle.delete{color:#fff;background-color:#08a6cc;cursor:pointer;width:30px; margin: 2px 0 0 5px;height:30px;line-height:30px;font-size: 29px;border-radius:50%;
text-align:center;transition:0.5s all;-webkit-transition:0.5s all;-moz-transition:0.5s all;-o-transition:0.5s all;-webkit-border-radius:50%;-moz-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;
-ms-transition:0.5s all;}
i.fa.fa-plus-circle.addmore:hover,i.fa.fa-minus-circle.delete:hover {background-color:#17233E;}
</style>
<div class="col-sm-3 col-md-8 col-lg-6 p-b-50">
 <div id="">
   <form id='students' method='post' name='students' action='index.php' style="width:100%;">
    <!--<div class="box">
      <span class="edit">edit</span>
      <span class="save">save</span>
      <div class="text s-text13" data-placeholder='Enter some text'>
      </div>
    </div>
    -->
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
      <button type="button" class='flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4 insert' style="width: 33%;float:left;">Submit</button>
	  <i class="fa fa-plus-circle addmore" aria-hidden="true"></i>
	   <i class="fa fa-minus-circle delete" aria-hidden="true"></i>
    </div>
    <div id="record_list" class="s-text13"></div>
  </form>
</div>
</div>
</div>
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