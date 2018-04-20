<?php
include "session.php";
 include "dbConnect.php";
 //$_GET['bno']이 있어야만 글삭제가 가능함.

 if(isset($_GET['bno'])) {

   $bNo = $_GET['bno'];

 }

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title></title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

	<article class="boardArticle">



		<?php

			if(isset($bNo)) {

				$sql = 'SELECT count(b_no) as cnt from women_board where b_no = ' . $bNo;

				$result = $dbConnect->query($sql);

				$row = $result->fetch_assoc();

				if(empty($row['cnt'])) {

		?>

    <script>

    			alert('글이 존재하지 않습니다.');

    			history.back();

    		</script>

        <?php

			exit;

				}

        $sql = 'SELECT b_title from women_board where b_no = ' . $bNo;

				$result = $dbConnect->query($sql);

				$row = $result->fetch_assoc();
    ?>

    <div id="boardDelete">

			<form id="form" name="form"action="./womens_delete_shop_update.php" method="post">

				<input type="hidden" name="bno" value="<?php echo $bNo?>">

        		</div>
        	</form>
          <script>document.form.submit();</script>

          <?php

  		//$bno이 없다면 삭제 실패

  		} else {

  	?>

  		<script>

  			alert('정상적인 경로를 이용해주세요.');

  			history.back();

  		</script>

  	<?php

  			exit;

  		}

  	?>

  	</article>

  </body>

  </html>
