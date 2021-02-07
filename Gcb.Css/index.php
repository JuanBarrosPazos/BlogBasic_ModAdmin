<?php

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01a.php';


//////////////////////////////////////////////////////////////////////////////////////////////

global $redir;
// 600000 microsegundos 10 minutos
// 60000 microsegundos 1 minuto
$redir = "<script type='text/javascript'>
                function redir(){
                window.location.href='../index.php';
            }
            setTimeout('redir()',2000);
            </script>";
print ($redir);



/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>