<?
include "dbconfig.php";
conndb();

$order_id = $_GET['order_id']; // รับ รหัสคำสั่งซื้อ ที่จะลบเข้ามา

// ลบใบสั่งซื้อ
$sql = "delete from orders where order_id=$order_id";
$result = mysql_query($sql);

// ลบรายการสั่งซื้อที่เป็นของใบสั่งซื้อด้านบน
$sql2 = "delete from orderdetails where order_id=$order_id";
$result2 = mysql_query($sql2);

CloseDB();
echo "<meta http-equiv='refresh' content='0;url=manageorder.php'>" ; 
?>