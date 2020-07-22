<?php

  	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_popup.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////

				if($_POST['oculto2']){ process_form();
										//info();
								
				} else { }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	$sqlx =  "SELECT * FROM `admin` WHERE `ref` = '$_POST[refuser]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	
	print("<div id=\"Conte\" style=\"border: 1px solid #CCC; width:98%; text-align:center; padding: 10px 6px 2px 6px; margin-bottom: 6px;\">
			<h5>".$_POST['tit']."</h5>
			<p>
			<img src='../Gcb.Img.Art/".$_POST['myimg']."' style=\" width:98%; max-width:700px;\" />
			</p>
			<h6 style=\"text-align:left;\">".$_POST['conte']."</h6>
				<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
			<p style=\"text-align:right;\">
					<input style=\"margin-right:12px;\" type='submit' value='CERRAR VENTANA' />
			</p>
				</form>
		</div> ");

	}
			
/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
		
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Gcb.Log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER DETALLES ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_popup_02.php';
		
/* Creado por Juan Barros Pazos 2020 */

?>
