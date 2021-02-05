
<?php

$sqld =  "SELECT * FROM `gcb_admin` WHERE `ref` = '$_SESSION[ref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>