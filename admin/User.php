<?php
//require_once('include/function.php');
require_once('DBclass.php');
require_once('include/config.php');
/**
 * This User will have functions that hadles user registeration,
 * login and forget password functionality
 * @author muni
 * @copyright www.smarttutorials.net
 */
class User_Info
{
	/**
	 * @var will going contain database connection
	 */
	protected $_con;
	
	/**
	 * it will initalize DBclass
	 */
	public function __construct()
	{
		$db = new DBclass();
		$this->_con = $db->con;
	}
	
	/*Code of fetch total_users*/
	public function total_users(){
				$sql = mysqli_query($this->_con,"SELECT COUNT(*) as allusers FROM users");
				$result=mysqli_fetch_array($sql);
				$total_users = $result['allusers'];
				return $total_users;
		
	}
	
	/*Code of fetch total_products*/
	public function total_products(){
				$sql = mysqli_query($this->_con,"SELECT COUNT(*) as allproducts FROM products");
				$result=mysqli_fetch_array($sql);
				$total_products = $result['allproducts'];
				return $total_products;
		
	}
	/*Code of fetch total no of orders*/
	public function total_orders(){
				$sql = mysqli_query($this->_con,"SELECT COUNT(*) as allorders FROM orders");
				$result=mysqli_fetch_array($sql);
				$total_orders = $result['allorders'];
				return $total_orders;
		
	}
	/*Code of fetch total no of pending orders*/
	public function total_pending_orders(){
				$status='Delivered';
				$sql = mysqli_query($this->_con,"SELECT COUNT(*) as pending_orders FROM Orders where orderStatus!='$status' || orderStatus is null");
				$result=mysqli_fetch_array($sql);
				$pending_orders = $result['pending_orders'];
				return $pending_orders;
		
	}
	/*Code of fetch total no of todays orders*/
	public function total_todays_orders(){
				$f1="00:00:00";
				$from=date('Y-m-d')." ".$f1;
				$t1="23:59:59";
				$to=date('Y-m-d')." ".$t1;
				$sql = mysqli_query($this->_con,"SELECT COUNT(*) as todays_orders FROM Orders where orderDate Between '$from' and '$to'");
				$result=mysqli_fetch_array($sql);
				$todays_orders = $result['todays_orders'];
				return $todays_orders;
		
	}
	 /*Get all users list by added new*/
	 public function total_new_user(){
		$sql = mysqli_query($this->_con,"select COUNT(*) as new_users FROM users order by regDate desc limit 12");
		$result=mysqli_fetch_array($sql);
		$new_users = $result['new_users'];
		return $new_users;
	  
	 }
	 /*Code of fetch game history reocrds - winning no's, total bids, total wons*/
	public function get_game_history(){
				date_default_timezone_set('UTC');// change according timezone
			    $currentTime = date( 'Y-m-d H:i:s', time () );
				$query_new=mysqli_query($this->_con, "select id,game_name from tbl_game  WHERE game_start_time < '".$currentTime."'");
		        return $query_new;
		
	}
	/*Code of fetch game history reocrds - total no of bids on game*/
	public function get_total_noof_bids($game_id){
				$sql22 = mysqli_query($this->_con,"select SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$game_id';");
				$result=mysqli_fetch_array($sql22);
				$total_bids =$result['SUM(bid_amount)'];
				return $total_bids;
		
	}
	/*Code to send email*/
	public function send_email($to,$sub,$msg){
			$to = $to;
			$subject = $sub;
			require_once('../PHPMailer/class.phpmailer.php');
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'mail.giftscome.com.cp-28.hostgatorwebservers.com';
			$mail->Port = 25;
			$mail->SMTPAuth = true;
			$mail->Username = 'info@giftscome.com.cp-28.hostgatorwebservers.com';
			$mail->Password = 'Codechefs@2018';
			$mail->isHTML(true);
			$mailContent = '<html><body>';
			$mailContent .=$msg;
			$mailContent .= '</body></html>';
			$mail->setFrom("info@giftscome.com.cp-28.hostgatorwebservers.com","Giftscome");
			$mail->addAddress($to);
			$mail->Subject = $subject;
			$mail->msgHTML($mailContent);
			$mail->Body = ($mailContent);
			$mail->send();
		
	}
}