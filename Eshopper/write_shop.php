<?php
include "session.php";
 include "dbConnect.php";



	$bPrice = $_POST['b_price'];

	$bImage = $_POST['b_image'];

	$bTitle = $_POST['b_title'];

	$bContent = $_POST['b_content'];

  $bBrand = $_POST['b_brand'];



	$sql = "INSERT INTO shop_board (b_no, b_title, b_content, b_price, b_hit, b_brand, b_image)
  values(null,'{$bTitle}','{$bContent}','{$bPrice}',0, '{$bBrand}', '{$bImage}' );";


	$result = $dbConnect->query($sql);

	if($result) { // query가 정상실행 되었다면,

		$msg = "정상적으로 글이 등록되었습니다.";

		$bNo = $dbConnect->insert_id;

		$replaceURL = './product-details_modify.php?bno=' . $bNo;

	} else {

		$msg = "글을 등록하지 못했습니다.";

?>

		<script>

			alert("<?php echo $msg?>");

			history.back();

		</script>

<?php

	}



?>

<script>

	alert("<?php echo $msg?>");

	location.replace("<?php echo $replaceURL?>");

</script>
