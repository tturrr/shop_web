<?php

include "session.php";
 include "dbConnect.php";

 $sql = "SELECT chat_id, chat_content , chat_datetime FROM chat";

 $result = $dbConnect->query($sql);

 while($row = $result->fetch_array()){

   echo ($row['chat_id']);
   echo ($row['chat_content']);
   echo ($row['chat_datetime']);

}
?>
