<?php if (!empty($_POST))
					{				
							$array=array();
							$i=0;	
							$taster=$_POST['taster'];
							while (isset($_POST['id'.$i]))
							{
								//Преобразование к красивому виду
								$array[]= array(								
								'cognac_id'=>$_POST['id'.$i],
								'opacity'=>$_POST['opacity'.$i],
								'color'=>$_POST['color'.$i],
								'taste'=>$_POST['taste'.$i],
								'bouquet'=>$_POST['bouquet'.$i],
								'mainpoint'=>$_POST['mainpoint'.$i],
								'note'=>$_POST['note'.$i],
								'typicality'=>$_POST['typicality'.$i]);

								//Проверка на то, заполнял ли дегустатор этот коньяк
								$q='SELECT COUNT(RATING_MAN) FROM TAST_RATING WHERE RATING_MAN='
								.$taster.'AND RATING_COGNAC='
								.$array[$i]['cognac_id'].
								'AND RATING_CAPTION=(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION)';	
								$s = oci_parse($conn,$q);

								oci_execute($s);
								$count=0;
								while ($row = oci_fetch_array($s)) {
									$count++;
								}
								
								
								if ($count==0) {
									$query = 'INSERT INTO TAST_RATING (RATING_MAN,RATING_COGNAC,RATING_CAPTION,RATING_POINT,RATING_OPACITY,RATING_COLOR,RATING_BOUQUET,RATING_TASTE,RATING_TYPICALITY,RATING_NOTE) VALUES ('.$taster.','.$array[$i]['cognac_id'].',(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION),'.$array[$i]['mainpoint'].','.$array[$i]['opacity'].','.$array[$i]['color'].','.$array[$i]['bouquet'].','.$array[$i]['taste'].','.$array[$i]['typicality'].',\''.$array[$i]['note'].'\')';
									$stid = oci_parse($conn,$query);
									$i++;
									oci_execute($stid);
								}
								else
								{
									$query = 'UPDATE TAST_RATING set RATING_MAN='.$taster.', RATING_COGNAC='.$array[$i]['cognac_id'].', RATING_CAPTION=(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION), RATING_POINT='.$array[$i]['mainpoint'].', RATING_OPACITY='.$array[$i]['opacity'].', RATING_COLOR='.$array[$i]['color'].', RATING_BOUQUET='.$array[$i]['bouquet'].', RATING_TASTE='.$array[$i]['taste'].', RATING_TYPICALITY='.$array[$i]['typicality'].', RATING_NOTE=\''.$array[$i]['note'].'\' WHERE RATING_MAN='
								.$taster.'AND RATING_COGNAC='
								.$array[$i]['cognac_id'].
								'AND RATING_CAPTION=(SELECT MAX(CAPTION_ID) FROM TAST_CAPTION)';
									$stid = oci_parse($conn,$query);
									$i++;
									oci_execute($stid);
								}
							}
							oci_commit($conn);
						}
		function debug( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log(" . implode($data) . " );</script>";
    else
        $output = "<script>console.log(". $data.");</script>";

    echo $output;
}

?>