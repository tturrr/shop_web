<?php
include "session.php";
 include "dbConnect.php";

$loginsucURL = "index.php";
$loginfailURL = "login.php";
$memberId = $_POST['memberId'];
$memberPw = md5($memberPw = $_POST['memberPw']);

$sql = "SELECT * FROM register WHERE memberId = '{$memberId}' AND password = '{$memberPw}'";
$res = $dbConnect->query($sql);


$row = $res->fetch_array(MYSQLI_ASSOC);


if ($row != null)
 {   $_SESSION['ses_userid'] = $row['memberId'];?>

          <script>

        location.replace("<?php echo $loginsucURL?>");
        </script>
        <?php

  }


  if($row == null)
  {
      ?>
         <script>
       alert('로그인 실패 아이디와 비밀번호가 일치하지 않습니다.');
       location.replace("<?php echo $loginfailURL?>");
       </script>
       <?php
  }



?>
