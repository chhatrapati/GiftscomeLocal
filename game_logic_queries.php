<?php
/*Store Procedure for both lowest and highest bid and updation with parameter game id*/
Begin
set @game_id = (SELECT pgame_id);
DROP TABLE IF EXISTS `temp1`;
create temporary table temp1(dig int,dig1 int) AS (
SELECT 1 as tt,`bid_no`, SUM(`bid_amount`) as ba FROM `tbl_userbids` where game_id=@game_id group by `bid_no` order  by ba asc LIMIT 5);
set @var1 = (SELECT GROUP_CONCAT(bid_no)
   FROM temp1
   GROUP BY tt);
SELECT GROUP_CONCAT(bid_no)
   FROM temp1
   GROUP BY tt;
   
update tbl_game_payout set payout_amount = payout_amount + 200 where FIND_IN_SET(payout_digit, @var1) and game_id = @game_id;

DROP TABLE IF EXISTS `temp2`;
create temporary table temp2(dig3 int,dig4 int) AS (
SELECT 1 as tt1,`bid_no`, SUM(`bid_amount`) as ba FROM `tbl_userbids` where game_id=@game_id group by `bid_no` order  by ba desc LIMIT 5);
set @var12 = (SELECT GROUP_CONCAT(bid_no)
   FROM temp2
   GROUP BY tt1);
SELECT GROUP_CONCAT(bid_no)
   FROM temp2
   GROUP BY tt1;
   
update tbl_game_payout set payout_amount = payout_amount - 200 where FIND_IN_SET(payout_digit, @var12) and game_id = @game_id;
End
 
/*Select 5 number from D2 with the lowest total bids (tbl_userbids)*/
/*Update(Increase) payout values for these 5 numbers in (tbl_game_payout)*/
DROP TABLE IF EXISTS `temp1`;
create temporary table temp1(dig int,dig1 int) AS (
SELECT 1 as tt,`bid_no`, SUM(`bid_amount`) as ba FROM `tbl_userbids` where game_id=@game_id group by `bid_no` order  by ba asc LIMIT 5);
set @var1 = (SELECT GROUP_CONCAT(bid_no)
   FROM temp1
   GROUP BY tt);
SELECT GROUP_CONCAT(bid_no)
   FROM temp1
   GROUP BY tt;
   
update tbl_game_payout set payout_amount = payout_amount + 200 where FIND_IN_SET(payout_digit, @var1) and game_id = @game_id;

/*Select 5 number from D2 with the highest total bids (tbl_userbids)*/
/*Update(Decrease) payout values for these 5 numbers in (tbl_game_payout)*/

DROP TABLE IF EXISTS `temp2`;
create temporary table temp2(dig3 int,dig4 int) AS (
SELECT 1 as tt1,`bid_no`, SUM(`bid_amount`) as ba FROM `tbl_userbids` where game_id=@game_id group by `bid_no` order  by ba desc LIMIT 5);
set @var12 = (SELECT GROUP_CONCAT(bid_no)
   FROM temp2
   GROUP BY tt1);
SELECT GROUP_CONCAT(bid_no)
   FROM temp2
   GROUP BY tt1;
   
update tbl_game_payout set payout_amount = payout_amount - 200 where FIND_IN_SET(payout_digit, @var12) and game_id = @game_id;
?>
<?php
$sp1 = "CALL winnig_no($game_id)";
	$result1 = mysqli_query($con, $sp1) or die(mysqli_error($con));
	
	while($row1=mysqli_fetch_array($result1))
	{
		echo $row1[0];
	}
	 mysqli_free_result($result1); mysqli_next_result($con);
?>
<?php
// Total no of bids of users
SELECT SUM(`bid_amount`) FROM tbl_userbids WHERE user_id =104;
?>
<?php
/*condition of current time == game start time */
window.setInterval(function(){
	var currentDate2 = new Date(Date.now());	
	var diff2 =  ((currentDate2.getTime() - 19800857) - futureDate.getTime()) / 1000;
		  /// call your function here
		  // console.log("current date - "+ currentDate + " - " + currentDate.getTime());
		 //  console.log("current date2 - "+ currentDate2 + " - " + currentDate2.getTime());
		 //  console.log("future date - "+ futureDate + " - " + futureDate.getTime());
		//   console.log("difference - "+ diff2);	  
		  
		 if(diff2 >= 0){
		   location.reload();
		 }else{
		 }
		}, 2000);
?>
<?php
	$sp = "CALL winnig_no($id)";
	$result = mysqli_query($con, $sp) or die(mysqli_error($con));
	print_r($result);
	while($row=mysqli_fetch_array($result))
	{
		echo $row[0];
	}
	  mysqli_free_result($result);mysqli_next_result($con);
	 
	?>
	SELECT GROUP_CONCAT(bid_no)
   FROM temp3
   GROUP BY tt12;
   
   
   <?php
   BEGIN
set @game_id = (SELECT pgame_id);
DROP TABLE IF EXISTS `temp3`;
create temporary table temp3(dig int,dig1 int) AS (
SELECT 1 as tt12,`bid_no`, SUM(`bid_amount`) as ba FROM `tbl_userbids` where game_id=@game_id group by `bid_no` order  by ba asc LIMIT 5);
set @var1 = (SELECT GROUP_CONCAT(bid_no)
   FROM temp3
   GROUP BY tt12);
SELECT bid_no
   FROM temp3 ORDER BY bid_no ASC LIMIT 1;
END
   ?>
  <?php
			$pp = 6;
			$tot = 6;
$groups = 3;
$numbers = array();
for($i = 1; $i < $groups; $i++) {
    $num = rand(1, $tot-($groups-$i));
    $tot -= $num;
    $numbers[] = $num;
}
$numbers[] = $tot;
echo $numbers[0];?> + <?php echo $numbers[1];?> + <?php echo $numbers[2];?> = <?php echo $pp;?>