<div align="center">[ <a href="?main=cart" onClick="NewWindow(this.href,'name','800','600','yes');return false"><font color="#003399">ตะกร้าสินค้า</font></a> ]
  <?php
// ส่วนของการเพิ่ม ลบ แก้ไข ข้อมูล
if($_POST['ADD']){
$q="INSERT INTO `stock`.`machinery` (
`id_mc` ,
`id_product` ,
`id_cat` ,
`name` ,
`price` ,
`id_unit` 
)
VALUES (
NULL , '$_POST[id_product]', '$_POST[id_cat]', '$_POST[name]', '$_POST[price]', '$_POST[id_unit]'
);

";
mysql_query($q);	
}
if($_GET['method']=="delete"){
	$q="DELETE FROM tbl_member WHERE member_id='".$_POST['id']."' ";
	mysql_query($q);	
	exit;
}
if($_GET['method']=="getupdate"){
	$q="SELECT * FROM tbl_member WHERE member_id='".$_POST['id']."' ";
	$qr=mysql_query($q);	
	$rs=mysql_fetch_array($qr);
	exit;
}
?>
  <?php
$q="select * from machinery,category,unit WHERE category.id_cat = machinery.id_cat AND machinery.id_unit = unit.id_unit";
$q.=" ORDER BY machinery.id_mc DESC   ";
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
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
  <td width="17" height="20" align="center" bgcolor="#CCCCCC">#</td>
  <td width="17" height="20" align="center" bgcolor="#CCCCCC">ID</td>
  <td width="119" height="20" align="center" bgcolor="#CCCCCC"><div align="left">รหัสสินค้า</div></td>
  <td width="383" align="center" bgcolor="#CCCCCC"><div align="left">ชื่อสินค้า</div></td>
  <td width="57" align="center" bgcolor="#CCCCCC"><div align="left">หน่วยนับ</div></td>
  <td colspan="2" align="center" bgcolor="#CCCCCC">ราคาขายต่อหน่วย</td>
  <td width="165" height="20" align="center" bgcolor="#CCCCCC"><div align="left">หมวด</div></td>
  <td height="20" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?php
$i=1;
while($rs=mysql_fetch_array($qr)){
?>  
<?php 
$bg = ($bg=="#F4F9FF")?"#FAFAFA":"#F4F9FF";
?>
<tr bgcolor="<?php echo $bg?>" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='<?=$bg?>'">
  <td height="20" align="center"><?=($chk_page*$e_page)+$i?></td>
  <td align="center"><?=$rs['id_mc']?></td>
  <td height="20" align="left">&nbsp; <?=$rs['id_product']?></td>
  <td height="20" align="left"><?=$rs['name']?></td>
  <td height="20" align="left"><?=$rs['name_unit']?> </td>
  <td width="40" height="20" align="left"><div align="right">
    <?=$rs['price']?>
  </div></td>
  <td width="75" align="left">&nbsp;บาท</td>
  <td height="20" align="center"><div align="left">
    <?=$rs['name_cat']?>    
    &nbsp;
    <?=$rs['title']?>
  </div>    </td>
  <td height="20" align="center"><a href="?main=order&product_id=<? echo $rs['id_mc']; ?>" class="updateItem">เพิ่มลงตะกร้า</a></td>
  </tr>
<?php $i++; } ?>
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
