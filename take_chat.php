<?php

include "session.php";
 include "dbConnect.php";

 $sql = "SELECT chat_id, chat_content , chat_datetime FROM chat";

 $result = $dbConnect->query($sql);


 while($row = $result->fetch_array()){

                  //넘어온 결과를 한 행씩 $row라는 배열에 담음.

      if($row!=null)
      {
         $result['success']=true;
         $result['chat_id']="$row[0]";
         $result['chat_content']="$row[1]";
         $result['chat_datetime']="$row[2]";

      } else {
         $result['success'] = false;
         $result['msg'] = "아이디 혹은 비밀번호를 정확히 입력해주세요.";
      }
 } catch(exception $e) {
      $result['success']   = false;
       $result['msg']      = "$id";
      $result['code']      = $e->getCode();
   }
   finally {
      echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
   }



?>
