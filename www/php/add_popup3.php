<?php 
if (!empty($_POST))
	{		
		/*подключение к бд*/
    include('../php/connect.php');
		/*значения, которые необходиом занести в бд*/
		$table_add=$_POST['table_add'];
		$place=$_POST['place'];
		$group=$_POST['group'];
		$down=$_POST['down'];
		$up=$_POST['up'];
		$medal=$_POST['medal'];	
		/*данные для изменения*/
		$tr_id=$_POST['id'];
		$id_row=$_POST['row'];
		$action=$_POST['action'];		
  	$prize_group=$_POST['prize_group'];
		$prize_place=$_POST['prize_place'];

echo $prize_place."|".$prize_group;
/*формирование sql запроса к бд*/		
	if ($action == 1){
		echo $tr_id."|".$id_row;
		$query="INSERT INTO ".$table_add." (PRIZE_PLACE, PRIZE_GROUP, PRIZE_LOWRANGE, PRIZE_HIGHRANGE, PRIZE_TITLE, PRIZE_CAPTION) VALUES (".$place.",".$group.",".$down.",".$up.",'".$medal."',(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION))";
		}
		else {
			$query="UPDATE ".$table_add." SET PRIZE_PLACE = ".$place.", PRIZE_GROUP = ".$group.", PRIZE_LOWRANGE = ".$down.", PRIZE_HIGHRANGE = ".$up.", PRIZE_TITLE = '".$medal."', PRIZE_CAPTION =(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION) WHERE PRIZE_PLACE = ".$prize_place." AND PRIZE_GROUP=".$prize_group;
		}

		echo $query;
		$stid = oci_parse($conn,$query );
    oci_execute($stid);
    oci_commit($conn);
    oci_close($conn);
}
?>	