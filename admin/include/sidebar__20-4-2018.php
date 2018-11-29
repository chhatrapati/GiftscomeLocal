<?php
error_reporting(0);
$pagename = basename($_SERVER['REQUEST_URI']);
?>
<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i>Forms</a>
<ul id='navigation'>
  <?php
 $id=$_SESSION['id'];
  $query=mysqli_query($con,"select * from admin where id='$id'");
	$row=mysqli_fetch_array($query);
		
		 $role=$row['role'];
	//echo $role; exit;		
		if($role=='super_admin')
		{
$q = mysqli_query($con,"SELECT sec_id, sec_name, sec_group,sec_group_url FROM menu ORDER BY create_date ASC");
// prepare data 
            $groupUrl = Array();
            $groups = Array();
            while ($w = mysqli_fetch_assoc($q)) {

                if (!isset($groups[$w['sec_group']]))
                    $groups[$w['sec_group']] = Array();
                $groups[$w['sec_group']][] = $w;


                $groupUrl[$w["sec_group_url"]] = $w["sec_group"];
            }
// display data
      foreach ($groups as $group_name => $sections) {
                echo '<li class="submenu"><a href="#">' . $group_name . '</a>';
                if ($groupUrl[$pagename] == $group_name) {
                    echo '<ul style="display:block">';
                } else {
                    echo '<ul>';
                }
                foreach ($sections as $section) {
                    echo '<li><a href="' . $section['sec_group_url'] . '">' . $section['sec_name']  . '</a>';
                }
                echo '</li></ul></li>';
            }
		}
		else	
		{
			 $id=$_SESSION['id'];
		$query1="select * from menu where sec_id in(select menu_id from role where user_id='$id')";	
			 $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
		  while ($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
			   {
				echo '<li>';
				?>
<a href="<?php echo $row1['sec_group_url'];?>"><i class="fa fa-user"></i> <span><?php echo $row1['sec_name'];?></span></a> 

						 
		<?php echo '</li>'; }} ?>
</ul>
</div>

  