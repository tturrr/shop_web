<?php
include "session.php";
 include "dbConnect.php";

	$bImage = $_POST['b_image'];

  $sql = 'UPDATE shop_board set b_image="' . $bImage . '" where b_no = ' . $bNo;

  $result = $dbConnect->query($sql);


  $sql1 = "SELECT * FROM shop_board order by b_no desc";
  $result1 = $dbConnect->query($sql1);
  $row = $result1->fetch_assoc();

  if($result){

    $replaceURL = './product-details.php?bno=' . $row['b_'];
  }

?>

  <script>

  	alert("<?php echo $msg?>");

  	location.replace("<?php echo $replaceURL?>");

  </script>
