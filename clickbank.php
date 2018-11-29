<?php session_start();
//error_reporting(0);
require_once('includes/config.php');
$ch = curl_init();
// set URL and other appropriate options  
curl_setopt($ch, CURLOPT_URL,  "https://api.clickbank.com/rest/1.3/products/list?site=giftscome");  
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Authorization: DEV-1C0RO2UR0VDIEGP4F87IG2QBANILPKAA:API-DEIQK6PUSUCOLLLKR1028EL8MBGT83CU"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  


$output = curl_exec($ch); 

//echo $output;
$array = json_decode($output,TRUE);
echo '<pre>';
print_r($array);
foreach($array as $key=> $val)
    {
		foreach($val as $key=> $values)
		{
			//print_r($values);
			foreach($values as $key=> $valnew)
		{
			$id = $valnew['id'];
			$title= $valnew['title'];
			//$des = $valnew['description'];
		}
		}
		
   
    }
echo $id;
echo $title;
//echo $des;
curl_close($ch);


?>