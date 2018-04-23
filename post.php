<?php
include "session.php";
include "dbConnect.php";

$chatid = $_POST['chatid'];
$datetime = $_POST['datetime'];
$chatContent = $_POST['chatContent'];



$sql = "INSERT INTO chat (chat_id,chat_content,chat_datetime)
VALUES('{$chatid}','{$chatContent}','{$datetime}');";

$resource= $dbConnect->query($sql);




?>
