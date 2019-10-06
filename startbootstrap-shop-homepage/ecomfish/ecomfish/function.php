  <?php 
$CH = "#b7ddf2"; //สีของหัวตาราง
$CLTB1 = "#FFFFFF"; //สีตรงสับสี
$CLTB2 = "#ebf4fb"; //สีตรงสับสี
$CLOVER = "#D7F4E0"; // สีตอนเมาส์โอเวอร์


function showms($showms){
print '<font color="#009933">"<div align="center"><strong>'.$showms.'</strong></div></font>';
}
?>
  <?php   
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $urlquery_str;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-4;
	if($chk_page>0){  
		echo "<a  href='?main=$_GET[main]&s_page=$pPrev' class='naviPN'>Prev&nbsp;&nbsp;</a>";
	}
	if($total_p>=11){
		if($chk_page>=4){
			echo "<a $nClass href='?main=$_GET[main]&s_page=0'>1</a><a class='SpaceC'>. . .</a>";   
		}
		if($chk_page<4){
			for($i=0;$i<$total_p;$i++){  
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?main=$_GET[main]&s_page=$i'>".intval($i+1)."</a> ";   
				}
				if($i==$total_p-1 ){ 
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?main=$_GET[main]&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}
		}
		if($chk_page>=4 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=5;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?main=$_GET[main]&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";   	
			}
			for($i=0;$i<$total_p;$i++){  
				if($i==$total_p-1 ){ 
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?main=$_GET[main]&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}									
		}	
		if($chk_page>=$lt_page){
			for($i=0;$i<=4;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?main=$_GET[main]&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";   
			}
		}		 
	}else{
		for($i=0;$i<$total_p;$i++){  
			$nClass=($chk_page==$i)?"class='selectPage'":"";
			echo "<a href='?main=$_GET[main]&s_page=$i' $nClass  >".intval($i+1)."</a> ";   
		}		
	} 	
	if($chk_page<$total_p-1){
		echo "<a href='?main=$_GET[main]&s_page=$pNext'  class='naviPN'>&nbsp;Next</a>";
	}
}  
function delcom(){
	echo "ลบข้อมูลเรียบร้อยแล้ว";
} 
function upcom(){
	echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
} 

function ToPage ($nameP){
	echo "<meta http-equiv=\"refresh\" content=\"0 url=$nameP\">";

}



function con_to_textdate($date_database) {//วันที่ปัจจุบันจากฐานข้อมูล
if($date_database=="0000-00-00"){
echo "-";
}else{
$NumMonth = substr($date_database,5,2);
$Numday = substr($date_database,8,2);
$Numday = ($Numday+1)-1;
$Numyear = (substr($date_database,0,4))+543;
if ($NumMonth=="01") {
   $mthai = "มกราคม"; 
}else if ($NumMonth=="02") {
    $mthai = "กุมภาพันธ์"; 
}else if ($NumMonth=="03") {
    $mthai = "มีนาคม "; 
}else if ($NumMonth=="04") {
    $mthai = "เมษายน" ;
}else if ($NumMonth=="05") {
    $mthai = "พฤษภาคม" ;
}else if ($NumMonth=="06") {
    $mthai = "มิถุนายน" ;
}else if ($NumMonth=="07") {
    $mthai = "กรกฎาคม" ;
}else if ($NumMonth=="08") {
    $mthai = "สิงหาคม" ;
}else if ($NumMonth=="09") {
    $mthai = "กันยายน" ;
}else if ($NumMonth=="10") {
    $mthai = "ตุลาคม" ;
}else if($NumMonth=="11") {
    $mthai = "พฤศจิกายน"; 
}else if ($NumMonth=="12") { 
    $mthai = "ธันวาคม" ;
	}
echo ($Numday.'&nbsp;'.' '.$mthai.'&nbsp;'.' '.$Numyear);
	}
}



//====สถานะใบสั่งซื้อ=====
function Consta($x){
if($x=="N"){
$y = "รอโอนเงิน ";
}else if($x=="R"){
$y =  "แจ้งการโอนเงินแล้ว<br>รอยืนยันจากเจ้าของร้าน";
}else if($x=="Y"){
$y =  "ชำระเงินแล้ว";
}
echo $y;
}

function Upsta($oder_id,$sta){
 $q="UPDATE `orders` SET `status` = '$sta' WHERE `orders`.`order_id` = '$_GET[order_id]';";
			$qr=mysql_query($q);
			//$obj=@mysql_fetch_object($qr);
			//$num=$obj->Tsum;
			//return $num;

}


?>
<?php
	function shpsize(){
	print'<select name="psize_id" id="psize_id">';
	$q ="SELECT * FROM `product_size`";
	$qr=mysql_query($q);
	while($rs=mysql_fetch_array($qr)){
    print '<option value="'.$rs[psize_id].'">'.$rs[psize_name].'</option>';
    }
    print'</select>';
	}
?>
</div>
