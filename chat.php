<table>
<?php
include "session.php";
 include "dbConnect.php";


 $sql = "SELECT * FROM chat";
 $result = $dbConnect->query($sql);
while( $->fetchInto( $result ) )
{
?>
<tr><td><?php echo($row[1]) ?></td>
<td><?php echo($row[2]) ?></td></tr>
<?php
}
?>
</table>
