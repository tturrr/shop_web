<?php

include "session.php";
 include "dbConnect.php";



	$bNo = $_POST['bno'];



	$coId = $_POST['coId'];


	$coContent = $_POST['coContent'];

  $coDate = $_POST['cdate'];



	$sql = 'INSERT into comment values(null, ' .$bNo . ', null, "' . $coContent . '", "' . $coId . '"  , "' . $coDate . '")';

	$result = $dbConnect->query($sql);

	$coNo = $dbConnect->insert_id;


	$sql = 'UPDATE comment set co_order = co_no where co_no = ' . $coNo;

	$result = $dbConnect->query($sql);

	if($result) {

?>

	<script>

		alert('댓글이 정상적으로 작성되었습니다.');

		location.replace("./product-details_modify.php?bno=<?php echo $bNo?>");

	</script>

<?php

	}

?>
