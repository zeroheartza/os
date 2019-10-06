<?php
require_once("ValidateForm.cls.php");
$Validity = new ClsJSFormValidation;
$FormName = "all";
$ControlNames=array("group_name"=>array("''" =>"กรุณากรอกชื่อกลุ่มสินค้า")
					);
$ValidationFunctionName="CheckValidity";
$JsCodeForFormValidation=$Validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
//onClick="return CheckValidity();"

?>

<?php
$nametb = "group";
$namektb = "group_id";
?>
<?php
// ส่วนของการเพิ่ม ลบ แก้ไข ข้อมูล
if($_POST['ADD']){
$q="INSERT INTO `$db`.`$nametb` (
`group_id` ,
`group_name` 
)
VALUES (
NULL , '$_POST[group_name]');
";
mysql_query($q);	
}
if($_GET['del']){
$q="DELETE FROM `$db`.`$nametb` WHERE `$nametb`.`$namektb` = $_GET[del];
";
mysql_query($q);
delcom();	
//exit;
}
if($_GET['up']){
	$q="SELECT * FROM  `".$nametb."` WHERE  `"."$namektb"."` ="."".$_GET['up']." ";
	$qr=mysql_query($q);	
	$rs=mysql_fetch_array($qr);
}
?>
<?php
if($_POST['UPDATE']){
 $q="UPDATE `$db`.`$nametb` SET 
`group_name` = '$_POST[group_name]'";
$q.=" WHERE `$nametb`.`$namektb` = $_POST[$namektb];";
echo $q;
mysql_query($q);
}
?><div id="stylized" class="myform">

<form action="" method="post" enctype="multipart/form-data" name="frmMain">  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>        <legend></legend>        
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
          <tr>
            <td colspan="2" align="right"><div align="left">
              <h1><img src="icon/cart.gif" width="16" height="17" />ข้อมูลกลุ่มสินค้า</h1>
              <br />
             <p> เพิ่มและแก้ใขข้อมูลกลุ่มสินค้า</p>
            </div></td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
              <td width="762" align="left"><em>
                <?php if($_GET['up']){?>
                <input name="<?=$namektb?>" type="hidden" id="<?=$namektb?>" value="<?=$rs[$namektb]?>" />
                <?php }?>
              </em></td>
            </tr>
          <tr>
            <td width="158" align="right"><strong>ชื่อกลุ่มสินค้า</strong></td>
              <td align="left"><em>
                <input name="group_name" type="text" id="group_name" value="<?=$rs['group_name']?>
" size="50" />
              </em></td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
              <td align="left"><em>
                <?php if($_GET['up']){?>
                <input type="submit" name="UPDATE" id="UPDATE" value="UPDATE" />
                <?php }else{?>
                <input type="submit" name="ADD" id="ADD" value="ADD" onClick="return CheckValidity();" />
                <?php }?>
                <input type="button" name="cancel" id="cancel" value="Cancel" />
              </em></td>
            </tr>
        </table></td></tr>
  </table>
</form>

<?php
 $q="SELECT * 
FROM `$nametb` 
ORDER BY `$nametb`.`$namektb` ASC  ";
$qr=mysql_query($q);
$total=mysql_num_rows($qr);
$e_page=20; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}   
$q.=" LIMIT ".$_GET['s_page'].",$e_page";
$qr=mysql_query($q);
if(mysql_num_rows($qr)>=1){   
	$plus_p=($chk_page*$e_page)+mysql_num_rows($qr);   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1; 
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Tahoma;
	font-size: x-small;
}
-->
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#999999">
  <tr>
    <td>      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td height="20" colspan="2" align="center" bgcolor="<?=$CH?>"><div align="left"><strong>ชื่อกลุ่มสินค้า</strong></div>
            <div align="left"></div>            <div align="left"></div></td>
          <td height="20" colspan="2" align="center" bgcolor="<?=$CH?>"><a href="?main=<?=$_GET[main]?>"><strong><img src="icon/add.png" alt="เพิ่ม" width="16" height="16" border="0" /></strong></a></td>
          </tr>
        <?php
$i=1;
while($rs=mysql_fetch_array($qr)){
?>
        <?php 
$bg = ($bg=="$CLTB1")?"$CLTB2":"$CLTB1";
?>
        <tr bgcolor="<?php echo $bg?>" onmouseover="bgColor='<?=$CLOVER?>'" onmouseout="bgColor='<?=$bg?>'">
          <td height="20" align="left"><img src="icon/bottom-empty.gif" width="19" height="16" />            <?=$rs['group_name']?></td>
            <td width="144" height="20" align="left">&nbsp;</td>
            <td width="19" height="20" align="center"><a href="?main=<?=$_GET[main]?>&up=<?=$rs[$namektb]?>" class="updateItem"><img src="icon/edit.png" alt="แก้ไข" width="16" height="16" border="0" /></a></td>
            <td width="21" align="center"><a href="?main=<?=$_GET[main]?>&del=<?=$rs[$namektb]?>" class="updateItem"><img src="icon/cross.gif" alt="ลบ" width="16" height="16" border="0"  onClick='return Conf(this)' /></a></td>
          </tr>
        <?php $i++; } ?>
      </table>
   </td></tr>
</table>
<?php if($total>0){ ?>
<div class="browse_page">
  <div align="center">
    <?php   
 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);     
  ?>
    <br />
    ทั้งหมด  <?php echo $total ; ?>รายการ
    
  </div>
</div>
<div align="center">
  <?php } ?>
</div>
</div>
