<?php
/*
 ในการทำเวบ E-Commerce นั้น คุณควรจะทำระบบสมาชิกด้วย โดยถ้าไม่ได้เป็นสมาชิกก็ไม่สามารถสั่งซื้อสินค้าได้
 ดังนั้นสิ่งที่ควรทำต่อเอง คือ
 - ทำระบบสมาชิก โดยต้องเป็นสมาชิก และ Login เข้าระบบก่อน ถึงสั่งซื้อสินค้าได้
 - ในการทำระบบสมาชิก คุณต้องศึกษาเรื่อง SESSION ให้ดี เพื่อเอาไว้เก็บสถานะว่า ตอนนี้ User ทำการ Login เข้าระบบหรือยัง ? ถ้ายังไม่ได้ Login ก็ต้องแจ้งให้ Login ก่อน ถึงสั่งซื้อสินค้าได้
*/

/*
 ในการใช้งานจริงนั้น คือ
 - พอลูกค้า Login สำเร็จ คุณก็สามารถเก็บรหัสลูกค้าเอาไว้ในตัวแปร SESSION ได้ และสามารถนำมาใช้ต่อภายในหน้านี้ได้เลย
 - พอคุณได้ รหัสลูกค้า ออกมาแล้ว ก็สามารถนำไปค้นหาต่อในตารางลูกค้าได้ว่า ลูกค้าคนนี้มี ชื่อ-นามสกุล , ที่อยู่ , ... เป็นอะไรได้อย่างง่ายดายเลย
*/

// ดังนั้นในตัวอย่างนี้ ผมจะสมมุติรหัสลูกค้าเอา ด้วยการ Random เลขเอานะครับ (ไม่อยากนำระบบสมาชิกมาลงไว้ด้วย เพราะเดี๋ยวจะยิ่งงงกันไปใหญ่)
//$customer_id = rand(10000, 99999); // ทำการ Random เลขสมาชิกที่มีค่าตั้งแต่ 10000 - 99999 ออกมา
$customer_id = $_SESSION[USERNAME]; // ทำการ Random เลขสมาชิกที่มีค่าตั้งแต่ 10000 - 99999 ออกมา


$order_date = date("Y-m-d"); // เก็บ วัน/เดือน/ปี ที่สั่งซื้อ
$order_time = date("H:i:s"); // เก็บเวลาที่สั่งซื้อ

// สร้างหมายเลขคำสั่งซื้อโดยเอาพวกเลข วัน ชั่วโมง วินาที ที่สั่งซื้อมาต่อเข้าด้วยกัน (คุณอาจใช้วิธีอื่นๆก็ได้)
$tmp1 = date("dmy");
$tmp2 = date("H");
$tmp3 = date("is");
$order_id = $tmp1.$tmp2.$tmp3;

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {	text-align: left;
}
-->
</style>
</head>

<body>
<center>
<strong>ใบแจ้งค่ารายการสินค้าที่สั่งซื้อ</strong>
<?php

// ทำการเก็บข้อมูลเกี่ยวกับใบสั่งซื้อสินค้าไว้ในตาราง orders (ส่วนข้อมูลสินค้าที่สั่งซื้อนำไปเก็บแยกอีกตารางหนึ่งเอา)
$insert1 = "insert into orders(order_id,username,order_date,order_time) VALUES ('$order_id','$customer_id','$order_date','$order_time')";
$result1 = mysql_query($insert1);
?>

</center>
<center>
<br>
<center>
  <table width="90%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><fieldset>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3" style="border-collapse: collapse; border: 1px dotted #008000">
        <tr>
          <td   colspan="5"><center>
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="50%" >&nbsp;<b>หมายเลขคำสั่งซื้อ : <? echo $order_id; ?></b></td>
                  <td width="50%" >&nbsp;<b>วันที่สั่งซื้อ : <? echo date("d/m/Y");; ?><br>
                    &nbsp;เวลา : <? echo date("H:i:s"); ?></b></td>
                </tr>
                <!-- ในที่นี้ขอสมมุติ ชื่อ-นามสกุล ที่อยู่ของผู้สั่งซื้อ ให้เป็นค่าคงที่ไปก่อนเลยนะครับ แต่ในการใช้งานจริง คุณสามารถดึงเอาจากตารางลูกค้าในฐานข้อมูลออกมาแสดงได้โดยง่ายดายเลย -->
                <tr>
                  <td width="50%"  >&nbsp;ชื่อ - นามสกุล ของผู้สั่งซื้อ : </td>
                  <td width="50%"  >&nbsp;คุณ <?php
	 $q2="SELECT * FROM `member` WHERE `username` = '$_SESSION[USERNAME]'";
	$qr2=mysql_query($q2);	
	$rs2=mysql_fetch_array($qr2);
	echo $rs2[name];
				  ?></td>
                </tr>
                <tr>
                  <td width="50%"  >&nbsp;ที่อยู่ ของผู้สั่งซื้อ : </td>
                  <td width="50%"  ><?=$rs2[address]?></td>
                </tr>
              </table>
          </center></td>
        </tr>
        <tr>
          <td colspan="5"  ><hr color="#CCCCCC"></td>
          </tr>
        <tr>
          <td  >            <div align="left">ชื่อสินค้า
            </div></td>
          <td  >            <div align="left">ราคาต่อหน่วย
            </div></td>
          <td  ><center>
            จำนวน
          </center></td>
          <td colspan="2"  ><center>
            รวม
          </center></td>
        </tr><tr>
          <td colspan="5"  ><center>
            <hr color="#CCCCCC">
          </center>            </td>
          </tr>
        <?php 
        foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
        ?>
        <?php
	$q="SELECT * FROM `product` WHERE `pro_id` = $item[product_id]";
	$qr=mysql_query($q);	
	$rs=mysql_fetch_array($qr);
		?>
        <tr id="item<?php echo $itemNumber; ?>">
          <td width="625"  ><p class="style1">&nbsp;
                  <?=$rs['pro_name']?></p></td>
          <td width="183"  ><p class="style2">&nbsp;<?php echo number_format($item['price'],2,'.',','); ?>&nbsp;</p></td>
          <td width="83"  ><p align="right"><?php echo number_format($item['qty'],0,'.',','); ?>&nbsp;</p></td>
          <td width="229"  ><p align="right" class="style2">&nbsp;<?php echo number_format($item['qty'] * $item['price'],2,'.',','); ?>&nbsp;</p></td>
          <td width="46"  ><strong>บาท</strong></td>
        </tr>
        <?php
         $qty = $item['qty'];
         $price = $item['price'];
         $product_id = $item['product_id'];
         $psize_id = $item['psize_id'];

         // ทำการเก็บรายการสินค้าที่สั่งซื้อเอาไว้ในตาราง orderdetails โดยใช้ order_id เป็น Foreign Key ในการจับคู่กับใบสั่งซื้อสินค้าในภายหลัง
         $insert2 = "insert into orderdetails(orderdetails_id,order_id,pro_id,qty,price) VALUES ('','$order_id','$product_id','$qty','$price')";
         $result2 = mysql_query($insert2);
        }
        ?>
        <tr id="itemtotal">
          <td   colspan="5" align="left"><hr color="#CCCCCC"></td>
          </tr>
        <tr id="itemtotal">
          <td   colspan="3" align="left"><b>&nbsp;ราคารวม</b></td>
          <td><p align="right"><b><? echo number_format($_SESSION['total'],2,'.',','); ?>&nbsp;&nbsp;</b> </td>
          <td><b>บาท</b></td>
        </tr>
        <tr id="itemtotal">
          <td   colspan="3" align="left"><b>&nbsp;ภาษีมูลค่าเพิ่ม (7%)</b></td>
          <td><div align="right"><b><? echo number_format(0.07*$_SESSION['total'],2,'.',','); ?></b></div></td>
          <td><b>บาท</b></td>
        </tr>
        <tr id="itemtotal">
          <td   colspan="3" align="left"><b>ราคารวมทั้งสิ้น</b></td>
          <td><div align="right"><b><? echo number_format((0.07*$_SESSION['total'])+$_SESSION['total'],2,'.',','); ?>&nbsp;&nbsp;</b></div></td>
          <td><b>บาท</b></td>
        </tr>
        <tr id="itemtotal">
          <td   colspan="5" align="left"><br>
            <?php
		  $bank = "bank.php";
		  include($bank);
		  ?></td>
        </tr>
      </table>
      </fieldset>&nbsp;</td>
    </tr>
  </table>
</center>
<form>
<input type=button value="พิมพ์หน้านี้" onClick="window.print()">&nbsp;
</form> 

</center>
<?php
	//session_destroy();
	//session_unset("SHOPPING_CART");
	//session_unregister("SHOPPING_CART");
	unset($_SESSION['SHOPPING_CART'][$_GET['remove']]);


?>
</body>

</html>