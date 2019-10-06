<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma;
	font-size: x-small;
}
-->
</style> <?php
 $host="localhost";
 $user="root";
 $pw="1234";
 $db="ecomfish";
 mysql_connect($host,$user,$pw)or die ("Connect Not Host ");
 mysql_select_db($db)or die (" Connect Not Database ");
//===========================
$charset= "SET NAMES 'utf8'";
mysql_db_query($db,$charset) or die('Invalid query ' . mysql_error()); 

$charset = "SET CHARACTER_SET_RESULTS = 'utf8'";
mysql_db_query($db,$charset) or die('Invalid query ' . mysql_error());
//=============ToDay=========
$date_y = date("y")+2000;
$thai_y = $date_y+543;
$day = date("j/n/");
$timeday = date("H:i:s");    
$today =  $day.$thai_y.' ['.$timeday.'.]';
// today
//===========================


	extract($_POST);
	extract($_GET);
	extract($_REQUEST);
 ?>