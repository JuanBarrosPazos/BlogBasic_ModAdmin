<?php
session_start();

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_Head_b.php';
	require '../Gcb.Inclu/mydni.php';
	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// NIVEL PLUS NO TIENE PERMITIDO BORRAR OTROS USUARIOS NI EL MISMO
if /*(*/($_SESSION['Nivel'] == 'admin')/* || ($_SESSION['Nivel'] == 'plus'))*/{

	master_index();

	if (isset($_POST['oculto2'])){	show_form();
									info_01();
									}
	elseif($_POST['borrar']){ process_form();
							  global $refnorm;
							  $refnorm = $_SESSION['iniref'];
							  info_02();
	} else { show_form(); }
		} else { require '../Gcb.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){

	global $table;
	$table = "<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>
						SE HA BORRADO ESTE USUARIO.
					</th>
				</tr>
				
				<tr>
					<td width=150px>
						ID:
					</td>
					<td width=200px>"
						.$_POST['id'].
					"</td>
					
					<td rowspan=5 align='center'>
		<img src='../Gcb.Temp/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						Referencia:
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nivel:
					</td>
					<td>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nombre:
					</td>
					<td>"
						.$_POST['Nombre'].
					"</td>
				</tr>

				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td >
						Tipo Documento:
					</td>
					<td colspan=2>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td colspan=2>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td colspan=2>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan=2>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan=2>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan=2>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Direcci&oacute;n:
					</td>
					<td colspan=2>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 1:
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 2:
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Last In:
					</td>
					<td colspan=2>"
						.$_POST['lastin'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Last Out:
					</td>
					<td colspan=2>"
						.$_POST['lastout'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nº Visitas:
					</td>
					<td colspan=2>"
						.$_POST['visitadmin'].
					"</td>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='Admin_Borrar_01.php'  \">
							<input type='submit' value='VOLVER A ADMIN BORRAR' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>";	

	global $db;
	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	// BORRAMOS EL USUARIO
	$sql = "DELETE FROM `$db_name`.`gcb_admin` WHERE `gcb_admin`.`id` = '$_POST[id]' LIMIT 1 ";
	// SI SE CUMPLE EL QUERY
	if(mysqli_query($db, $sql)){
	
	global $ctemp;
	$ctemp = "../Gcb.Temp";
	global $imgorg;
	$imgorg = "../Gcb.Img.User/".$_POST['myimg'];
	
	if (!file_exists($ctemp)) {
		mkdir($ctemp, 0777, true);
		copy($imgorg, $ctemp."/".$_POST['myimg']);
	}else{
		copy($imgorg, $ctemp."/".$_POST['myimg']);
				}

	print ($table); // SE IMPRIME LA TABLA DE CONFIRMACION

	unlink("../Gcb.Img.User/".$_POST['myimg']);

	// SE GRABAN LOS DATOS EN LOG DEL ADMIN
	global $deletet2;
	global $deletet;
	$deletet = $deletet2;

	} // FIN PRIMER IF SI SE BORRA EL USER DE LA BBDD
	  // => ELSE BORRADO NO OK PRIMER QUERY
		else {print("<font color='#FF0000'>SE HA PRODUCIDO UN ERROR: </font>
					</br>&nbsp;&nbsp;".mysqli_error($db))."</br>";
					show_form ();
						}
	
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
function show_form(){

	if($_POST['oculto2']){
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
									'lastin' => $_POST['lastin'],
									'lastout' => $_POST['lastout'],
									'visitadmin' => $_POST['visitadmin']);
								   		}
	if(isset($_POST['borrar'])){
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
									'lastin' => $_POST['lastin'],
									'lastout' => $_POST['lastout'],
									'visitadmin' => $_POST['visitadmin']);
								   		}
								   
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td colspan=3 class='BorderInf' align='center'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						</br>
						TODAS LAS TABLAS Y DIRECTORIOS.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</td>
				</tr>
				<tr>
					<td colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Admin_Borrar_01.php' >
													CANCELAR
							</a>
						</font>
					</td>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
				<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
				<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
				<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />
		<tr>
			<td width=120px>	
						Nivel:
			</td>
			<td width=100px>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='94px'>
<img src='../Gcb.Img.User/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />

			</td>
		</tr>
					
		<tr>
			<td>	
				NOMBRE:
			</td>
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td>
				APELLIDOS:
			</td>
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				DOCUMENTO:
			</td>
			<td>
				".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				N&Uacute;MERO:
			</td>
			<td>
				".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				CONTROL:
			</td>
			<td colspan='2'>
				".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				MAIL:
			</td>
			<td colspan='2'>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td>
				USUARIO:
			</td>
			<td colspan='2'>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td>
				PASSWORD:
			</td>
			<td colspan='2'>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>

		<tr>
			<td>
				DIRECCION:
			</td>
			<td colspan='2'>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				TELEFONO 1:
			</td>
			<td colspan='2'>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr>
			<td class='BorderInf'>
				TELEFONO 2:
			</td>
			<td class='BorderInf' colspan='2'>
				".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
				
		<tr align='right'>
			<td colspan='3'>
				<input type='submit' value='ELIMINAR DATOS PERMANENTEMENTE' />
				<input type='hidden' name='borrar' value=1 />
			</td>
		</tr>
	</form>														
		</table>"); 
	
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

function info_02(){

	global $nombre;
	global $apellido;	
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gcb.Log";
	
	global $ddr;
	global $deletet;	
	global $text;
	$text = PHP_EOL."- USER BORRARDO ".$ActionTime.PHP_EOL."\t ID: ".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL.$deletet.PHP_EOL.$ddr;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	global $nombre;
	global $apellido;
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	global $orden;
	$orden = isset($_POST['Orden']);	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gcb.Log";

global $text;
$text = PHP_EOL."- USER BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

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
