<?php
$loginlURL = "login.php";
    include "session.php";


    unset($_SESSION['ses_userid']);

    if($_SESSION['ses_userid'] == null){


    }

    ?>
       <script>
     alert('로그아웃 되었습니다.');
     location.replace("<?php echo $loginlURL?>");
     </script>
     <?php


?>
