<?php
require_once("ValidateForm.cls.php");
$Validity = new ClsJSFormValidation;
$FormName = "all";
$ControlNames=array("username"	=>array("''" =>"กรุณากรอกข้อมูล USERNAME"),
					"password"	=>array("''" =>"กรุณาใส่ข้อมูล รหัสผ่าน "),
					"name"	=>array("''" =>"กรุณาใส่ชื่อ-สกุล "),
					"identily"	=>array("''" =>"กรุณาใส่ข้อมูล รหัสบัตรประจำตัวประชาชน "),
					"address"	=>array("''" =>"กรุณาใส่ข้อมูลที่อยู่ในการจัดส่งสินค้า ")
					);
$SameFields=array("password","repassword");
$ErrorMsgForSameFields="ใส่รหัสผ่านไม่ตรงกัน";

$ValidationFunctionName="CheckValidity";
$JsCodeForFormValidation=$Validity->ShowJSFormValidationCode($FormName,$ControlNames,$ValidationFunctionName,$SameFields,$ErrorMsgForSameFields);
echo $JsCodeForFormValidation;
//onClick="return CheckValidity();"

?>

<?php if($_POST[submit]){
 $q="INSERT INTO `$db`.`member` (
`username` ,
`password` ,
`name` ,
`address` ,
`email` ,
`identily` ,
`tel` 
)
VALUES (
'$_POST[username] ', '$_POST[password]', '$_POST[name]', '$_POST[address]', '$_POST[email]', '$_POST[identily]  ', '$_POST[tel]'
);
";
	mysql_query($q);
	echo "คุณได้ลงทะเบียนกับเว็บไซต์ของเราเรียบร้อยแล้ว";
	exit;

}?>

<legend></legend>
<div id="stylized" class="myform">
<form name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><h1>สมัครสมาชิกใหม่</h1>
        <p>กรุณากรอกข้อมูลให้ครบทุกช่อง</p>
      
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
            <tr>
              <td width="33%" valign="top"><div align="right"><strong>ชื่อผู้ใช้</strong></div>
              <div align="right"><span class="small">Username</span>                </div></td>
              <td width="67%"><div align="left">
                <input name="username" type="text" id="username" />
              <span class="smallstar"><font color="#FF0000">*</font> ใส่ชื่อผู้ใช้ในการเข้าใช้งานระบบ</span></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right"><strong>รหัสผ่าน<br />
                <span class="small">Password</span></strong></div></td>
              <td><div align="left">
                <input name="password" type="password" id="password" />
              <span class="smallstar"><font color="#FF0000">*</font> กรอกรหัสผ่าน</span></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right"><strong>ยืนยันรหัสผ่าน<br />
                <span class="small">RePassword</span></strong></div></td>
              <td><div align="left">
                <input name="repassword" type="password" id="repassword" />
              <span class="smallstar"><font color="#FF0000">*</font> ยืนยันรหัสผ่านอีกครั้ง</span></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right"><strong>ชื่อ-สกุล<br />
                <span class="small">Name-Lastname</span></strong></div></td>
              <td><div align="left">
                <input name="name" type="text" id="name" />
              <span class="smallstar"><font color="#FF0000">*</font> ชื่อจริง-นามสกุล</span></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right"><strong>รหัสบัตรประชาชน<br />
                <span class="small">identily</span></strong></div></td>
              <td><div align="left">
                <input name="identily" type="text" id="identily" />
               <span class="smallstar"><font color="#FF0000">*</font> กรอกเลขประจำตัวประชาชน 13 หลัก</span></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right"><strong>ที่อยู่</strong></div>
                <div align="right"><strong><span class="small">ที่อยู่ในการจัดส่งสินค้า</span><br />
                </strong></div></td>
              <td><div align="left">
                <textarea name="address" cols="60" rows="5" id="address"></textarea>
              <span class="smallstar"><font color="#FF0000">*</font> ที่อยู่ ในการจัดส่งสินค้า</span></div></td>
            </tr>
            <tr>
              <td><div align="right"><strong>เบอร์โทร<br />
                <span class="small">ที่สามารถติดต่อได้</span></strong></div></td>
              <td><div align="left">
                <input name="tel" type="text" id="tel" />
              <span class="smallstar">เบอร์โทรที่สามารถติดต่อได้</span></div></td>
            </tr>
            <tr>
              <td><div align="right"><strong>Email<br />
                <span class="small">จดหมายอิเล็กทรอนิกส์</span></strong></div></td>
              <td><div align="left">
                <input name="email" type="text" id="email" />
              <span class="smallstar">ตัวอย่าง test@hostt.com</span></div></td>
            </tr>
            <tr>
              <td colspan="2"><!--<button  name="submit" type="submit">ลงทะเบียน</button> --></td>
            </tr>
            <tr>
              <td colspan="2"><div align="center">หมายเหตุ <font color="#FF0000">*</font> หมายถึง จำเป็นต้องกรอก </div></td>
            </tr>
          </table> 
        <em>
        <input type="submit" name="submit" id="submit"  value="ลงทะเบียน"  onClick="return CheckValidity();"/>
        </em></td>
    </tr>
  </table>
</form>
</div>



