<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}

</head>

<body>
<center><b><u><font size="5">รายการสินค้า</font></u></b></center><br>
<center>[ <a href="cartsystem/cart.php" onClick="NewWindow(this.href,'name','800','600','yes');return false"><font color="#003399">ตะกร้าสินค้า</font></a> ]<!--<? //if ($_SESSION['uid']==1) { ?> [ <a href="?main=cartsystem/manageorder"><font color="#003399">แสดงรายการคำสั่งซื้อ</font></a> ]<? //} ?>!--></center>
<br>
<center>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="99%" id="AutoNumber1" height="149">
  <tr>
    <td width="35%" bgcolor="#82053C" align="center" height="20"><b>
    <font color="#cccccc">ภาพสินค้า</font></b></td>
    <td width="51%" bgcolor="#82053C" align="center" height="20"><b>
    <font color="#cccccc">รายละเอียดสินค้า</font></b></td>
    <td width="14%" bgcolor="#82053C" align="center" height="20"><b>
    <font color="#cccccc">สั่งซื้อ</font></b></td>
  </tr>

<?php
if ($db->connect($host, $database, $user, $password, $persistent)) {
	$charset= "SET NAMES UTF8";
	$db->execute($charset);
	
	$sql = "SELECT * FROM  products  WHERE status='show' ";
	$db->query($sql);
	$Num_Rows = $db->numRows();
	$Per_Page = $pageLimit;
	////////////////////////////
	$Page = $_GET["Page"]; 
	if(!$_GET["Page"]) 
	{ 
		$Page=1; 
	} 
	
	$Prev_Page = $Page-1; 
	$Next_Page = $Page+1; 
	
	$Page_Start = (($Per_Page*$Page)-$Per_Page); 
	if($Num_Rows<=$Per_Page) 
	{ 
		$Num_Pages =1; 
	} 
	else if(($Num_Rows % $Per_Page)==0) 
	{ 
		$Num_Pages =($Num_Rows/$Per_Page) ; 
	} 
	else 
	{ 
		$Num_Pages =($Num_Rows/$Per_Page)+1; 
		$Num_Pages = (int)$Num_Pages; 
	} 

	$sql .= " ORDER BY id LIMIT $Page_Start , $Per_Page;";
	if ($db->query($sql)) { 
		$results = $db->getAll(); 
		//$no=1;
		
		foreach ($results as $res) { 	
?>
  <tr>
    <td width="35%" align="center" height="128">
    <? if(!empty($res['picture'])){ ?>
    <img border="0" src="images/product/thumb/<? echo $res['picture']; ?>" />
    <? }else{ ?>
    <img border="0" src="images/warning.png" alt="ไม่มีรูปภาพสินค้า" />
    
    <? } ?>
      </td>
<td width="51%" height="128" align="center" valign="top">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="border-collapse: collapse">
      <tr>
        <td width="27%" align="right" valign="top">
        <p align="right"><font size="2" color="#800000">
        รหัสสินค้า :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><font size="2" color="#000080"><? echo $res['id']; ?></font></td>
      </tr>
      <tr>
        <td width="27%" align="right" valign="top">
        <p align="right"><font size="2" color="#800000">
        ชื่อสินค้า :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><font size="2" color="#000080"><? echo $res['thai_name']; ?></font></td>
      </tr>
      <tr>
        <td width="27%" align="right" valign="top">
        <font size="2" color="#800000">
         :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><font size="2" color="#000080"><? echo $res['eng_name']; ?></font></td>
      </tr>
      <tr>
        <td width="27%" align="right" valign="top">
        <font size="2" color="#800000">
        หมวดหมู่ :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><font size="2" color="#000080">
<? echo $db->getValue("category","label",$cond); ?></font></td>
      </tr>
      <tr>
        <td width="27%" align="right" valign="top">
        <font size="2" color="#800000">ราคา
        :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><? echo $res['price']; ?> บาท</td>
      </tr>
      <tr>
        <td width="27%" align="right" valign="top">
          <font size="2" color="#800000">
            pv :</font></td>
        <td width="3%">&nbsp;</td>
        <td width="70%" align="left"><font size="2" color="#000080"><? echo $res['pv']; ?></font></td>
      </tr>
      <tr>
        <td align="right" valign="top"><font size="2" color="#800000">รายละเอียด</font></td>
        <td>&nbsp;</td>
        <td align="left"><font size="2" color="#000080"><? echo $res['detail']; ?></font></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      </table>
    </td>
    <td width="14%" align="center" height="128"><b>
    <font color="#000080"><a href="cartsystem/order.php?product_id=<? echo $res['id']; ?>" onClick="NewWindow(this.href,'name','800','600','yes');return false"><img src="images/shopping_cart.png" border="0" alt="สั่งซื้อสินค้า"></a></font></b></td>
  </tr>
  <?php
		} 
	} else { 
			$alt = $db->escapeStr($err = "มีข้อผิดพลาด: \r\n\t ".$db->error);
			alert($alt); 
	} 

  } else { 
		  $alt = $db->escapeStr($err = "มีข้อผิดพลาด: \r\n\t ".$db->error);
		  alert($alt); 
  } 

  
  ?>
                      <tr>
                      <td align="center" valign="top" style="background-color: #82053C;color: #cccccc; font-weight:bold;" colspan="9"  height="30">
  ทั้งหมด 
  <? echo $Num_Rows; ?>
&nbsp;รายการ แบ่งเป็น
<? echo $Num_Pages;?>
หน้า <br>
<? 
if($Prev_Page) 
{ 
echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&main=cartsystem/index'><img src=images/previous.png border=0 alt=หน้าต่อไป   align=absmiddle /></a> "; 
} 

for($i=1; $i<=$Num_Pages; $i++){ 
if($i != $Page) 
{ 
	echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&main=cartsystem/index'>$i</a> ]"; 
} 
else 
{ 
	echo "<b> $i </b>"; 
} 
} 
if($Page!=$Num_Pages) 
{ 
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&main=cartsystem/index'><img src=images/next.png border=0 alt=หน้าต่อไป  align=absmiddle /></a> "; 
} 
?>
                 </td>
                    </tr>

</table>
<br>
</center>
</body>
</html>