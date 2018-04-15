

<?php
    include "dbConnect.php";

    $replaceURL = 'login.php';  // location.replace 를 사용하여 저홈페이지로 확인버튼 누르지않아도 바로 이동이 가능하다.

    $memberId = $_POST['memberId'];
    $memberName = $_POST['memberName'];
    $memberPw = $_POST['memberPw'];
    $memberPw2 = $_POST['memberPw2'];
    $memberEmailAddress = $_POST['memberEmailAddress'];

    //PHP에서 유효성 재확인

    //아이디 중복검사.
    $sql = "SELECT * FROM register WHERE memberId = '{$memberId}'";
    $res = $dbConnect->query($sql);
    if($res->num_rows >= 1){

      echo("<script>alert('이미 존재하는 아이디가 있습니다.');</script>");
      exit;
    }

    //비밀번호 일치하는지 확인
    if($memberPw !== $memberPw2){
        echo '비밀번호가 일치하지 않습니다.';
        exit;
    }else{
        //비밀번호를 암호화 처리.
        $memberPw = md5($memberPw);
    }

    //닉네임, 생일 그리고 이름이 빈값이 아닌지
    if($memberName == ''){
        echo '이름 값이 없습니다.';
    }

    //이메일 주소가 올바른지
    $checkEmailAddress = filter_var($memberEmailAddress, FILTER_VALIDATE_EMAIL);

    if($checkEmailAddress != true){
        echo "올바른 이메일 주소가 아닙니다.";
        exit;
    }

    //이제부터 넣기 시작
    $sql = "INSERT INTO register (memberId,password,name,eMail)
    VALUES('{$memberId}','{$memberPw}','{$memberName}','{$memberEmailAddress}');";

    if($dbConnect->query($sql)){


?>
        <script>
      alert('회원가입 성공');
      location.replace("<?php echo $replaceURL?>");
      </script>
<?php
    }
?>
