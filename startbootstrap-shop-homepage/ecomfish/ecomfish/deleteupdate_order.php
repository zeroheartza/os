<?
include "dbconfig.php";
conndb();

$order_id = $_GET['order_id']; // รับ รหัสคำสั่งซื้อ ที่จะลบเข้ามา

?>

<!-- ตรงจุดนี้คุณจะต้องเขียนส่วนที่ไว้ปรับปรุงคลังสินค้าเองครับ ว่าสินค้าเหลือจำนวนเท่าไร... ในที่นี้ไม่ได้ทำมาให้ครับ -->
<script>
     alert("ทำการปรับจำนวนสินค้าคงเหลือในคลังสินค้า เรียบร้อยแล้ว !!");
</script>


<?
// ลบใบสั่งซื้อ
$sql = "delete from orders where order_id=$order_id";
$result = mysql_query($sql);

// ลบรายการสั่งซื้อที่เป็นของใบสั่งซื้อด้านบน
$sql2 = "delete from orderdetails where order_id=$order_id";
$result2 = mysql_query($sql2);

CloseDB();
echo "<meta http-equiv='refresh' content='0;url=manageorder.php'>" ; 
?>