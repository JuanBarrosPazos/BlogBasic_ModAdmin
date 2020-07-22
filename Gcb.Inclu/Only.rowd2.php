
<?php

$sqld =  "SELECT * FROM `admin` WHERE `ID` = '$_POST[ID]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);

?>