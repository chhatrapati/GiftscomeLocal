<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$cat_name=$_POST['cat_name'];
	$question=addslashes($_POST['question']);
	$answer=addslashes($_POST['answer']);

    $sql=mysqli_query($con,"insert into tbl_faq(cat_name,question,answer) values('$cat_name','$question','$answer')");
    $_SESSION['msg']="Faq Inserted Successfully !!";
	
	

}

if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from tbl_faq where id = '".$id."'");
                  $_SESSION['delmsg']="Record deleted !!"; ?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/manage-faq.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Faq</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>
<?php require_once('include/header.php');?>
<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Faq</a> </div>
  </div>
  <div class="container-fluid">
	 <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
	  <?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-faq.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>
								
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
         <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Faq">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">		
		<form class="form-horizontal"name="addfaq" id ="addfaq" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Faq Category</label>
		<div class="controls">
		<select name="cat_name" id="cat_name" class="span8 tip" required>
		<option value="0" selected>Select Faq category</option> 
		<?php $query=mysqli_query($con,"select * from tbl_faq_categories");
		while($row=mysqli_fetch_array($query))
		{?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
		<?php } ?>
		</select>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Question</label>
		<div class="controls">
		<input type="text"  name="question" id="question" placeholder="Enter question" class="span8 tip" required>
		</div>
		</div>

		
		<div class="control-group">
		<label class="control-label" for="basicinput">Answer</label>
		<div class="controls">
		<textarea  name="answer" id="answer" placeholder="Enter answer" rows="6" class="span8 tip"></textarea>  
		</div>
		</div>
		
		

		<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
			<button type="reset" name="reset" class="btn btn-success">Cancel</button>
			<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
		
		
        </div>
      </div>
    </div>
	</div>
	
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Faq List">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table" id="example">
             <thead>
										<tr>
											<th>#</th>
											<th>Question</th>
											<th>Category </th>
											<th>Answer</th>
											<th>Creation Date</th>
											<th>Active</th>
											<th>Action</th>
										</tr>
			</thead>
              <tbody>

									<?php 
									    $query=mysqli_query($con,"select tbl_faq.*, tbl_faq_categories.cat_name from tbl_faq join tbl_faq_categories on tbl_faq_categories.id=tbl_faq.cat_name");
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{ ?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['question']);?></td>
											<td><?php echo htmlentities($row['cat_name']);?></td>
											<td><?php echo substr($row['answer'],0,50);?>...</td>
											<td><?php echo htmlentities($row['create_date']);?></td>
											<td class="">
											<?php $stylepopular= ''; $stylenotpopular= '';?>
											<?php 
											if($row['is_active']==0)
											{
												$stylepopular= "style= display:none";
											}
											
											if($row['is_active']==1)
											{
												$stylenotpopular= "style= display:none";
											}
											
											?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'tbl_faq');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'tbl_faq');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
										  <td>
											<a href="edit-faq.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="manage-faq.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part-->
<?php require_once('include/common_js.php');?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/jquery.validate.js"></script>
<?php require_once('tiny-myc.php');?>
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script>
<script type="text/javascript"> 
$.validator.addMethod(
          "notEqualTo",
          function(elementValue,element,param) {
            return elementValue != param;
          },
          "Value cannot be {0}"
        );

 // Setup form validation on the #register-form element
 $("#addfaq").validate({
    
        // Specify the validation rules
        rules: {
            cat_name:  { required : true,notEqualTo: 0},
            question:{ required : true},
			answer:{ required : true},
			
        },
        
        // Specify the validation error messages
        messages: {
            cat_name:  { required:"Please select category.",notEqualTo: "Select Faq category"},
            question:{ required :"Please enter question"},
			answer:{required : "Please enter answer"},
			
        },
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		},
        
        submitHandler: function(form) {
            form.submit();
        }
    });
  </script>
  <script>
	tinyMCE.init({
		mode: "textareas",
		theme: "simple",
		// update validation status on change
		onchange_callback: function(editor) {
			tinyMCE.triggerSave();
			$("#" + editor.id).valid();
		}
	});
	$(function() {
		var validator = $("#myform").submit(function() {
			// update underlying textarea before submit validation
			tinyMCE.triggerSave();
		}).validate({
			ignore: "",
			rules: {
				title: "required",
				content: "required"
			},
			errorPlacement: function(label, element) {
				// position error label after generated textarea
				if (element.is("textarea")) {
					label.insertAfter(element.next());
				} else {
					label.insertAfter(element)
				}
			}
		});
		validator.focusInvalid = function() {
			// put focus on tinymce on submit validation
			if (this.settings.focusInvalid) {
				try {
					var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
					if (toFocus.is("textarea")) {
						tinyMCE.get(toFocus.attr("id")).focus();
					} else {
						toFocus.filter(":visible").focus();
					}
				} catch (e) {
					// ignore IE throwing errors when focusing hidden elements
				}
			}
		}
	})
	</script>
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
<script>
		
		function funisactive(id,is_active,table_name)
		{
			 $.ajax({  
			 type: "POST",  
			 url: "change_active.php",  
			 data: "id=" + id + "& is_active=" + is_active + "& table_name=" + table_name,  
			 success: function(){  
				//success (not finished)
				if(is_active=='1')
				{
				document.getElementById('imgnotpopular'+id).style.display='none';
				document.getElementById('imgpopular'+id).style.display='block';
				}
				else
				{
				document.getElementById('imgnotpopular'+id).style.display='block';
				document.getElementById('imgpopular'+id).style.display='none';
				}
				
				}  
			 });  
		  return false;  
		   
		}
</script>
<script>
</script>
</body>
</html>
<?php }?>