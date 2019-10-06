<?php 
//Create 'cart' if it doesn't already exist
if (!isset($_SESSION['SHOPPING_CART'])){ $_SESSION['SHOPPING_CART'] = array(); }

//Add an item only if we have the threee required pices of information: name, price, qty
if (isset($_POST['qty'])){
	//Adding an Item
	//Store it in a Array
	$ITEM = array(
		//Item name		
		'name' => $_POST['add'],
		//Product id		
		'product_id' => $_POST['product_id'],
		//Item Price
		'price' => $_POST['price'], 
		//Item Price
		'psize_id' => $_POST['psize_id'], 
		//Qty wanted of item
		'qty' => $_POST['qty']		
		);

	//Add this item to the shopping cart
	$_SESSION['SHOPPING_CART'][] =  $ITEM;
	//Clear the URL variables
	@header('Location: ' . $_SERVER['PHP_SELF'].'?main=cart');
}
//Allowing the modification of individual items no longer keeps this a simple shopping cart.
//We only support emptying and removing
else if (isset($_GET['remove'])){
	//Remove the item from the cart
	unset($_SESSION['SHOPPING_CART'][$_GET['remove']]);
	//Re-organize the cart
	//array_unshift ($_SESSION['SHOPPING_CART'], array_shift ($_SESSION['SHOPPING_CART']));
	//Clear the URL variables
	@header('Location: ' . $_SERVER['PHP_SELF'].'?main=cart');
}
else if (isset($_GET['empty'])){
	//Clear Cart by destroying all the data in the session
	unset($_SESSION['SHOPPING_CART']);
	//session_destroy();
	//Clear the URL variables
	@header('Location: ' . $_SERVER['PHP_SELF'].'?main=cart');

}
else if (isset($_POST['update'])) {
	//Updates Qty for all items
	foreach ($_POST['items_qty'] as $itemID => $qty) {
		//If the Qty is "0" remove it from the cart
		if ($qty == 0) {
			//Remove it from the cart
			unset($_SESSION['SHOPPING_CART'][$itemID]);
		}
		else if($qty >= 1) {
			//Update to the new Qty
			$_SESSION['SHOPPING_CART'][$itemID]['qty'] = $qty;
		}
	}
	//Clear the POST variables
	@header('Location: ' . $_SERVER['PHP_SELF'].'?main=cart');
} 

?>
<html>

<head>
<title>My Shop - ตะกร้าสินค้า</title>
<script Language="Javascript">
<!--
function Conf(object) {
              if (confirm("โปรดยืนยันการสั่งซื้อ ?") == true) {
          return true;
                }
          return false;
                }
//-->
</script>
<style type="text/css">
.style1 {
	text-align: left;
}
.style2 {
	text-align: right;
}
</style>
<style>
BODY {
    FONT-FAMILY: Arial, Helvetica, sans-serif
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
<!--<div id="stylized" class="myform">
 --><center>
  <h1>ตะกร้าสินค้า<br>
  </h1>
  <div id="shoppingCartDisplay">
<form action="" method="post" name="shoppingcart">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><fieldset><legend><img src="icon/cart.gif" width="16" height="17"><strong>ตะกร้าสินค้า</strong></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0"  style="border-color:">
              <tr>
                <th>ลบ</th>
                <th  >ชื่อสินค้า</th>
                <th  >ราคาต่อหน่วย</th>
                <th  >จำนวน</th>
                <th  > รวม </th>
              </tr>
              <tr>
                <th colspan="5"><hr  color="#CCCCCC"></th>
              </tr>
              <?php 
        $_SESSION['total'] = 0;
        //Print all the items in the shopping cart
        foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
        ?>
              <?php
	$q="SELECT * FROM `product` WHERE `pro_id` = $item[product_id]";
	$qr=mysql_query($q);	
	$rs=mysql_fetch_array($qr);
		?>
              <tr id="item<?php echo $itemNumber; ?>">
                <td  ><center>
                    <font><a href="?main=<?=$_GET[main]?>&remove=<?php echo $itemNumber; ?>"><img src="icon/cross.gif" border="0"></a>
                </center></td>
                <td  ><span class="style1">
                  <?=$rs['pro_name']?></span></td>
                <td  ><p class="style2">&nbsp;<?php echo number_format($rs['price'],2,'.',','); ?>&nbsp;</p></td>
                <td  ><font>
                  <input name="items_psize_id[<?php echo $itemNumber; ?>]2" type="hidden" id="items_psize_id[<?php echo $itemNumber; ?>]" value="<?php echo $item['psize_id']; ?>" size="1" maxlength="5" />  <center>
                    </center>                  <div align="center">
                    <input name="items_qty[<?php echo $itemNumber; ?>]" type="text" id="item<?php echo $itemNumber; ?>_qty" value="<?php echo $item['qty']; ?>" size="1" maxlength="5" />
                    </div></td>
                <td  ><p class="style2">&nbsp;<?php echo number_format($item['qty'] * $item['price'],2,'.',','); ?>&nbsp;</p></td>
              </tr>
              <?php
        $_SESSION['total'] += $item['qty'] * $rs['price'];
        }
        ?>
              <tr id="itemtotal">
                <td   colspan="5" align="left"><hr color="#CCCCCC"></td>
              </tr>
              <tr id="itemtotal">
                <td   colspan="3" align="left"><b>&nbsp;&nbsp;ราคารวม</b></td>
                <td   colspan="2"><p align="right"><b><? echo number_format($_SESSION['total'],2,'.',','); ?>&nbsp;&nbsp;บาท</b></td>
              </tr>
              <tr id="vat">
                <td   colspan="3" align="left"><b>&nbsp;&nbsp;ภาษีมูลค่าเพิ่ม (7%)</b></td>
                <td   colspan="2"><p align="right"><b><? echo number_format(0.07*$_SESSION['total'],2,'.',','); ?>&nbsp;&nbsp;บาท</b></td>
              </tr>
              <tr id="total">
                <td   colspan="3" align="left"><b>&nbsp;&nbsp;ราคารวมทั้งสิ้น</b></td>
                <td   colspan="2"><p align="right"><b><? echo number_format((0.07*$_SESSION['total'])+$_SESSION['total'],2,'.',','); ?>&nbsp;&nbsp;บาท</b></td>
              </tr>
            </table>
            </fieldset>&nbsp;</td>
      </tr>
    </table>
    <?php $_SESSION['SHOPPING_CART_HTML'] = ob_get_flush(); ?>
<p>
      <label>
      <input type="submit" name="update" id="update" value="อัพเดตตะกร้าสินค้า">
      </label>
    </p>
</form>
<p> [<a href="?main=show_product">กลับไปซื้อต่อ</a>] - [<a href="?main=<?=$_GET[main]?>&empty">ลบสินค้าทุกรายการ</a>] - [<a href="?main=confirm_order" OnClick="return Conf(this)">ยืนยันการสั่งซื้อ</a>]</p>
</div>
</center>
<!--</div>
 --></body>
</html>