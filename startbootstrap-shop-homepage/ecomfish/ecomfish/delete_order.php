<?
include "dbconfig.php";
conndb();

$order_id = $_GET['order_id']; // �Ѻ ���ʤ���觫��� ����ź�����

// ź���觫���
$sql = "delete from orders where order_id=$order_id";
$result = mysql_query($sql);

// ź��¡����觫��ͷ���繢ͧ���觫��ʹ�ҹ��
$sql2 = "delete from orderdetails where order_id=$order_id";
$result2 = mysql_query($sql2);

CloseDB();
echo "<meta http-equiv='refresh' content='0;url=manageorder.php'>" ; 
?>