<?php //require('include/function.php');?>
<div class="span3">
					<div class="sidebar">
						<ul class="widget widget-menu unstyled">
							<li><a href="user-profile.php?id=<?php echo toPublicId($_SESSION['id']);?>"><i class="menu-icon icon-tasks"></i>Manage Profile </a></li>			
							<li>
								<a href="user_logout.php">
									<i class="menu-icon icon-signout"></i>
									Logout
								</a>
							</li>
						</ul>

					</div><!--/.sidebar-->
				</div><!--/.span3-->
