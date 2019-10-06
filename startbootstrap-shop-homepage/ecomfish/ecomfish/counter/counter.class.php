<?php
//********************************************
//************* Counter Class ****************
//			MARIO ENRIQUE LOPEZ GUZMAN
//		  COMMENTS:  mariotpc@gua.net
//
//This class is provided for count the number of hints
//to the web page for each date
//after you can plot the visits using the table statics...
//enjoy....
class counter
{
/****** Begin database ***************/
	function connect()
	{
		global $server, $user, $password, $database;

		$connection=mysql_connect($server, $user, $password) or die (mysql_error());
		$db=@mysql_select_db($database) or die (mysql_error());
		
		return $connection;
	}
	
	// Disconnect from DataBase.
	function disconnect($connection)
	{
		@mysql_close($connection);
	}

/****** end for database ***************/

	// Return the visits total.
	function visitstotal()
	{
		$result=@mysql_query("SELECT sum(today) as total FROM statics");
		$visitstotal=@mysql_result($result,0,"total");

		return $visitstotal;
	}

	function totalrows()
	{
		$result=@mysql_query("SELECT today FROM statics where date like '".date('Ymd')."%'");
		$totalrows=@mysql_num_rows($result);
		return $totalrows;
	}


	// Returns today visits.
	function visitstoday()
	{
		$result=@mysql_query("SELECT today FROM statics where date like '".date('Ymd')."%'");
		$visitstoday=@mysql_result($result,0,"today");
		return $visitstoday;
	}

	// Returns visits for specific day.
	function visitssearch($daysearch)
	{
		$result=@mysql_query("SELECT today FROM statics where date like '".$dayseach."%'");
		$visitssearch=@mysql_result($result,0,"today");
		return $visitssearch;
	}

	// Increment if 'visited' is not set.
	function increment()
	{
	 
	 global $visited;
	 global $statics;
		
  	if (!$visited)
		{
		  // return the total of rows for today.
		  $rows = $statics->totalrows();
			// If rows is zero then insert 1 to the table
		  if ($rows == 0 )
						$result=@mysql_query("INSERT INTO `statics` ( `id` , `today` , `date` ) VALUES ('', '1', NOW( ));");
					else
					  $result=@mysql_query("UPDATE statics SET today=today + 1 where date like '".date('Ymd')."%'");
		}
	}
}

?>
