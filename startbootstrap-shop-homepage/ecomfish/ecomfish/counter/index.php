<?php

include_once ("./config.inc.php");
include_once("./counter.class.php");

unset($visited);
session_start();
 $statics = new counter();
 $conn = $statics -> connect();
 $statics->increment();
 $visitstoday = $statics->visitstoday();
 $visitstotal = $statics->visitstotal();
 print "Today visits: <b>".$visitstoday."</b>";
 print "<br>Total visits: <b>".$visitstotal."</b>";
 
 if (isset($daysearch)) {
 $daysearch = $year.$month.$day;
 if ($daysearch == "" ) { 
 print "<br>Enter correct values for search!!!"; 
 print "<FORM ACTION = \"?$daysearch\" METHOF=\"POST\">";
 print "<INPUT TYPE = \"HIDDEN\" NAME = \"daysearch\" VALUE=1>";
 print "Year: <br> <INPUT TYPE = \"TEXT\" NAME = \"year\" MAXLENGTH=4><br>";
 print "Month: <br> <INPUT TYPE = \"TEXT\" NAME = \"month\" MAXLENGTH=2><br>";
 print "Day: <br> <INPUT TYPE = \"TEXT\" NAME = \"day\" MAXLENGTH=2><br>";          
 print "<INPUT TYPE = \"SUBMIT\" NAME = \"see it!!!\">";    
 print "</FORM>";
  exit;}
 
 $visitsday = $statics->visitssearch($daysearch);
 print "<br>Total visits at : <b>".$year."/".$month."/".$day."/" ." was :" .$visitsday."</b>";
 }
 
 print "<FORM ACTION = \"?$daysearch\" METHOF=\"POST\">";
 print "<INPUT TYPE = \"HIDDEN\" NAME = \"daysearch\" VALUE=1>";
 print "Year: <br> <INPUT TYPE = \"TEXT\" NAME = \"year\" MAXLENGTH=4><br>";
 print "Month: <br> <INPUT TYPE = \"TEXT\" NAME = \"month\" MAXLENGTH=2><br>";
 print "Day: <br> <INPUT TYPE = \"TEXT\" NAME = \"day\" MAXLENGTH=2><br>";          
 print "<INPUT TYPE = \"SUBMIT\" NAME = \"see it!!!\">";    
 print "</FORM>";
 
 $statics -> disconnect($conn);
 session_register("visited");
 $visited=1;
?>
