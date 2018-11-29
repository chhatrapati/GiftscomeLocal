<?php session_start(); error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$uid =$_SESSION['id']; ?>
<!DOCTYPE html>
<head>
<title>Game Statistics</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="admin/css/matrix-style.css" />
	<link rel="stylesheet" href="admin/css/matrix-media.css" />
	<style>
	.dataTables_filter {display:none;}
	div.dataTables_wrapper .ui-widget-header {
		border-right: medium none;
		border-top: 0px;
		font-weight: normal;
		margin-top: -1px;
	}
	.widget-title, .modal-header, .table th, div.dataTables_wrapper .ui-widget-header {
		background: none;
		border: none;
		height: 36px;
	}
	.dataTables_length {
		color: #878787;
		margin: 20px 14px 5px 0;
		position: relative;
		left: 5px;
		width: 50%;
		top: 0px;
	}
	.t_gz {
    padding: 9px;
    border: 2px solid #ccc!important;
    }
	.table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
    background-color: none!important;
}
	/*.left {background:#ede20e;color:#FF849E; }*/
	.left {background:#ffeaa7;color:#FF849E; }
	.middle {background:#fff;}
	/*.right {background:#ede20e; color:#49E2FF;}*/
		.right {background:#ffeaa7; color:#49E2FF;}
	.left span.winno {background: blue; color: #fff;text-align: center;padding:2px 5px 2px 5px;}
	.middle span.winno {background: red; color: #fff;text-align: center;padding:2px 5px 2px 5px;}
	.right span.winno {background: blue; color: #fff;text-align: center;padding:2px 5px 2px 5px;}
	/*th.odd_no{background-image:url(images/odd.png);    max-width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 35px;
    height: 35px;
    margin: 0 auto;}*/
    
}
 
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
<h2 class="l-text2 t-center">
Game Statistics
</h2>
</section>
<section class="bgwhite p-b-20">
<div class="container">    
<!-- Portfolio -->
<!--<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<canvas id="bar-chart" width="800" height="450"></canvas>-->
<!--<div class="col-lg-6">-->
<!--<h4 style="text-align: center;">Game V/S Users Bets</h4>-->
<!--<p style="text-align: center;">Last 50 games analysis for overall bets on game</p>-->
<!--<canvas id="graphCanvas_2"></canvas></div>-->
<br/>
<div class="col-md-12 col-xs-12">
							<div id="pp">
							<h4 style="text-align: center;">Winning No's From Past Games</h4>
<table id="example" class="table data-table"  cellspacing="0" width="100%">
			  <!-- <table class="table"> -->
   		<thead class="u_g_h">	
		                    <tr>
							<th class="name_game">Game Name</th>
							<?php 
								 for($nn=0; $nn<=27; $nn++){?>
								<th class="<?php if($nn<=9) { echo 'leftsec';} elseif($nn>9 && $nn<=17) { echo 'middle';} elseif($nn>17 && $nn<=27) { echo 'right';} ?>">
								<?php echo $nn;?>
								</th>
								<?php }	?>
							<th class="odd_no"><img src="images/odd.svg" alt="" width="30" height="30" /></th>
							<th class="even_no"><img src="images/even.svg" alt="" width="30" height="30" /></th>
							<th class="middle_no"><img src="images/middle.svg" alt="" width="30" height="30" /></th>
							<th class="small_no"><img src="images/less.svg" alt="" width="30" height="30" /></th>
							<th class="big_no"><img src="images/large.svg" alt="" width="30" height="30" /></th>
							<th class="side_no"><img src="images/side.svg" alt="" width="30" height="30" /></th>
						</tr>
					</thead>
					<tbody class="text-left">
						<?php
						$data = $user_obj->past_games();
						//print_r($data);
						while($res=mysqli_fetch_array($data)) {
							    $game_id = $res['id'];
			                    $game_name = $res['game_name'];
								$winn_no = $res['winning_no'];
							?>	
							<tr>
								<td class="t_gz"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<?php $i=0;
						        while($i<=27) {?>
								<td class="t_gz <?php if($i<=9) { echo 'left';} elseif($i>9 && $i<=17) { echo 'middle';} elseif($i>17 && $i<=27) { echo 'right';} ?>">
								<?php if($winn_no==''){?>
								<?php } elseif($winn_no==$i) {?>
								<span class="winno"><?php echo $winn_no;?></span>
								<?php }?>
								</td>
								<?php $i=$i+1;  }?>
								<td class="t_gz odd_no">
								<?php 
								 for($o=1; $o<=27; $o+= 2){
									 if($winn_no==$o)
									 {?>
										<img src="images/odd.svg" alt="" width="30" height="30" />
									 <?php } 
								 }
								?>
								</td>
								<td class="t_gz even_no">
								<?php 
								 for($e=0; $e<=26; $e+= 2){
									 if($winn_no==$e)
									 {?>
										 <img src="images/even.svg" alt="" width="30" height="30" />
									 <?php } 
								 }
								?>
								</td>
								<td class="t_gz middle_no">
								<?php 
								 for($m=10; $m<=17; $m++){
									 if($winn_no==$m)
									 {?>
										<img src="images/middle.svg" alt="" width="30" height="30" />
									<?php } 
								 }
								?>
								</td>
								<td class="t_gz small_no">
								<?php 
								 for($s=0; $s<=13; $s++){
									 if($winn_no==$s)
									 {?>
										<img src="images/less.svg" alt="" width="30" height="30" />
									 <?php } 
								 }
								?>
								</td>
								<td class="t_gz big_no">
								<?php 
								 for($b=14; $b<=27; $b++){
									 if($winn_no==$b)
									 {?>
										 <img src="images/large.svg" alt="" width="30" height="30" />
									 <?php } 
								 }
								?>
								</td>
								<td class="t_gz side_no">
								<?php 
								 for($side=0; $side<=9; $side++){
									 if($winn_no==$side)
									 {?>
										 <img src="images/side.svg" alt="" width="30" height="30" />
									<?php } 
								 }
								?>
								<?php 
								 for($side1=18; $side1<=27; $side1++){
									 if($winn_no==$side1)
									 {?>
										<img src="images/side.svg" alt="" width="30" height="30" />
									<?php } 
								 }
								?>
								</td>
								
							</tr>					
							<?php } //End While ?>				
						</tbody>
								</table>
								</div>
</div>
<div class="col-lg-12">
<h4 style="text-align: center;">Numbers V/S Game Coins</h4>
<p style="text-align: center;">Last 50 games analysis for overall game coins betted on each numbers</p>
<canvas id="graphCanvas"></canvas></div>
</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
<span class="symbol-btn-back-to-top">
<i class="fa fa-angle-double-up" aria-hidden="true"></i>
</span>
</div>
<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("chart-data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];
					var pp = [];

                    for (var i in data) {
                        name.push(data[i].bid_no);
                        marks.push(data[i].bid_amount);
						 pp.push(data[i].game_id);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Users Bids',
                                  backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#004182',
                                data: marks
                            }
                        ]
                    };
					
					

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
						data: chartdata,
						options: {
									scales: {
											yAxes: [{
											  scaleLabel: {
												display: true,
												labelString: 'Overall Game Coins',
												fontColor:'#212529',
												fontSize: '22',
											  }
											}],
											xAxes: [{
											  scaleLabel: {
												display: true,
												labelString: 'Lucky 27 Numbers',
												fontColor:'#212529',
												fontSize: '22',
											  }
											}]
									    },
								   title: {
											display: true,
											fontSize:16,
											padding:15,
											lineHeight:1.2,
											//text: ['Numbers V/S Game Coins', 'Last so games analysis for overall game coins betted on each numbers']
											text: ''
								          },
						 
						}
                    });
                });
            }
        }
</script>
<!--<script>
        $(document).ready(function () {
            showGraph_2();
        });


        function showGraph_2()
        {
            {
                $.post("chart-data_2.php",
                function (data)
                {
                    console.log(data);
                     var name_2 = [];
                    var marks_2 = [];

                    for (var i in data) {
                        name_2.push(data[i].game_id);
                        marks_2.push(data[i].bid_amount);
                    }

                    var chartdata_2 = {
                        labels: name_2,
                        datasets: [
                            {
                                label: 'Users Bids',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks_2
                            }
                        ]
                    };
					
					

                    var graphTarget_2 = $("#graphCanvas_2");

                    var barGraph_1 = new Chart(graphTarget_2, {
                        
								type: 'bar',
								data: chartdata_2,
								options: {
									scales: {
											yAxes: [{
											  scaleLabel: {
												display: true,
												labelString: 'Overall Bets',
												fontColor:'#212529',
												fontSize: '22',
											  }
											}],
											xAxes: [{
											  scaleLabel: {
												display: true,
												labelString: 'Game#',
												fontColor:'#212529',
												fontSize: '22',
											  }
											}]
									    },
								   title: {
											display: true,
											fontSize:16,
											padding:15,
											lineHeight:1.2,
											text: ''
								          },
						 
						}
							});
                  
					
                });
            }
        }
</script>-->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- jQuery Form Validation code -->
<script src="admin/js/jquery.dataTables.min.js"></script> 
<script src="admin/js/matrix.js"></script> 
<script src="admin/js/matrix.tables.js"></script>
</body>
</html>