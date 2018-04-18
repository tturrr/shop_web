<?php
include "session.php";
 include "dbConnect.php";


 	$bPrice = $_POST['b_price'];

 	$bImage = $_POST['b_image'];

 	$bTitle = $_POST['b_title'];

 	$bContent = $_POST['b_content'];

   $bBrand = $_POST['b_brand'];

 //$_POST['bno']이 있을 때만 $bno 선언

 	if(isset($_POST['bno'])) {

 		$bNo = $_POST['bno'];

 	}



 	//bno이 없다면(글 쓰기라면) 변수 선언

 	if(empty($bNo)) {

  }

  if(isset($bNo)) {

  	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크

  	$sql = 'SELECT count(b_title) as cnt from man_board where b_no = ' . $bNo;

  	$result = $dbConnect->query($sql);

  	$row = $result->fetch_assoc();

    if($row['cnt']) {

    		$sql = 'UPDATE man_board set b_brand="' . $bBrand .'" ,b_price="' . $bPrice .'" ,b_image="' . $bImage .'",  b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bNo;

    		$msgState = '수정';

    	//틀리다면 메시지 출력 후 이전화면으로

    	} else {

    		$msg = '';

    	?>

    		<script>

    			alert("<?php echo $msg?>");

    			history.back();

    		</script>

    	<?php

    		exit;

    	}

} else {

  	$sql = "INSERT INTO man_board (b_no, b_title, b_content, b_price, b_hit, b_brand, b_image)
    values(null,'{$bTitle}','{$bContent}','{$bPrice}',0, '{$bBrand}', '{$bImage}' );";
    $msgState = '등록';
}


//메시지가 없다면 (오류가 없다면)

if(empty($msg)) {

	$result = $dbConnect->query($sql);

	if($result) { // query가 정상실행 되었다면,

		$msg = "정상적으로 글이".$msgState."되었습니다.";
    if(empty($bNo)) {
		$bNo = $dbConnect->insert_id;
    }

		$replaceURL = './men_details_modify.php?bno=' . $bNo;

	} else {

		$msg = "글을 등록하지 못했습니다.";

?>

		<script>

			alert("<?php echo $msg?>");

			history.back();

		</script>

<?php

	}
}



?>

<script>

	alert("<?php echo $msg?>");

	location.replace("<?php echo $replaceURL?>");

</script>
