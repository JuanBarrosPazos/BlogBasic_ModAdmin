<?php

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_Head_b.php';


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

	require '../Gcb.Inclu/Admin_Inclu_footer.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>