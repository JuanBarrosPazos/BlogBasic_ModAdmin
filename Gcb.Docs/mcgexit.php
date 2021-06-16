<?php
session_start();
 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_Head_b.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

	global $userid;
	$userid = $_SESSION['id'];
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
 		
		
					
		if (isset($_POST['salir'])){ info();
							  		 salir();
									}
		elseif ($_POST['cerrar']){  master_index();
									desconex(); }
												
	} else { require '../Gcb.Inclu/table_permisos.php'; }
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
	global $db_name;
	global $userid;
	
	global $dir;
	$dir = "../Gcb.Log";

	global $dateadout;
	$dateadout = date('Y-m-d/H:i:s');

	$sqladout = "UPDATE `$db_name`.`gcb_admin` SET `lastout` = '$dateadout' WHERE `gcb_admin`.`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladout)){
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
					}
					
	$text = PHP_EOL."** FIN DE SESION ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']." => ".$dateadout;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = PHP_EOL.$text.PHP_EOL.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){

		require '../Gcb.Inclu.Menu/rutaadmin.php';
		require '../Gcb.Inclu.Menu/Master_Index.php';

				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconex(){

			print("<table align='center'style=\"margin-top:80px; margin-bottom:80px;\">
						<form name='salir' action='$_SERVER[PHP_SELF]' method='post'>
							<tr>
								<td valign='bottom' align='center'>
					<input type='submit' value='CONFIRME CERRAR SESION' class='botonnaranja' />
								</td>
							</tr>								
									<input type='hidden' name='salir' value=1 />
						</form>	
					</table>");
				} 
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function salir() {

			print("<table align='center'>
						<tr>
							<th style='text-align:center'>
								HA CERRADO SESION.
							</th>
						</tr>
	<embed src='../Gcb.Audi/sesion_close.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
					</table>");
				
			global $redir;
			// 600000 microsegundos 10 minutos
			// 60000 microsegundos 1 minuto
			$redir = "<script type='text/javascript'>
						function redir(){
							window.location.href='access.php?salir=1';
						}
						setTimeout('redir()',3000);
					</script>";
			print ($redir);
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Gcb.Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>