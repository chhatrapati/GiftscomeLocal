<section class="slider_img">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox" >
						<?php
						$query = "SELECT * FROM  slider where is_active =1";
						$result = mysqli_query($con, $query) or die(mysqli_error($con));
						$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

							$slider_id=$row['slider_id'];
							$slider_image=$row['slider_image'];
							$slider_title=$row['slider_title'];
							$slider_description=$row['slider_description'];
							?>	
							<!-- Slide One - Set the background image for this slide in the line below -->
							<div class="carousel-item <?php if($i==0){?> active <?php } ?>" style="background-image: url('admin/images/<?php echo $slider_image;?>')">
							</div>
							<?php $i++; }  ?>

						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="fa fa-caret-square-o-left arrow_slide" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="fa fa-caret-square-o-right arrow_slide" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
</section>