﻿<?php @session_start();?>
<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma;
	font-size: x-small;
}
-->
</style><p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<!--<p align="center"><img src="loading.gif">กำลังตรวจสอบ...</p>
 --><p>
<?php include("connect/inc.php");?>
  <?php
//=================================================================
if($_POST[LOGIN]){

	 $username = $_POST['username'];
	 $password = $_POST['password'];
	
 	 $q = "SELECT * FROM `member` WHERE `username` = '$username'
AND `password` = '$password'";
	$qr=mysql_query($q);
	$rs=mysql_fetch_array($qr);
	$Num_Rows = mysql_num_rows($qr);
	if($Num_Rows=='1'){//ถ้าเจอ Password admin
	 $_SESSION['USERNAME']= $username;
	 $_SESSION['STA']= $rs['Status'];
//===============================================================
	print("<script language=javascript>
	window.alert('ยินดีต้อนรับเข้าสู่ระบบ');
	self.location='index.php';
	</script>");
//===============================================================
	echo "<meta http-equiv=\"refresh\" content=\"0 url=index.php?main=profile\">";
	}else{//ถ้าไม่เจอ password admin
	echo "<meta http-equiv=\"refresh\" content=\"0 url=index.php?er=1\">";
	}
}
?>