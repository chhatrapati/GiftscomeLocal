<?php
class Cl_DBclass
{
	/**
	 * @var $con will hold database connection
	 */
	public $con;
	
	/**
	 * This will create Database connection
	 */
	public function __construct()
	{
		$this->con = mysqli_connect('giftscome.db.11878407.c13.hostedresource.net', 'giftscome', 'Gift#2018', 'giftscome');
		if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
}