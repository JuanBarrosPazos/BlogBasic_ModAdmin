<?php
session_start();

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_popup.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

	require '../Gcb.Inclu/Only.rowd.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

	if (isset($_POST['oculto2'])){
								show_form();
								//info_01();
								}
							elseif($_POST['imagenmodif']){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												//info_02();
												}
								
								} else {
											show_form();
									}

} else { require '../Gcb.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	*/
		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					global $img2;
					$img2 = 'untitled.png';
					}
					
		return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $secc;	
	$secc = $_SESSION['refuser'];
	$sqlx =  "SELECT * FROM `gcb_admin` WHERE `ref` = '$_SESSION[refuser]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";

	$_SESSION['dt'] = date('is');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	global $new_name;
	$new_name = $_SESSION['srefart']."_".$_SESSION['dt'].".".$extension;

	global $safe_filename;
	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
	$safe_filename = trim(str_replace('..', '', $safe_filename));

	$nombre = $_FILES['myimg']['name'];
	$nombre_tmp = $_FILES['myimg']['tmp_name'];
	$tipo = $_FILES['myimg']['type'];
	$tamano = $_FILES['myimg']['size'];
		  
	global $destination_file;
	$destination_file = '../Gcb.Img.Art/'.$safe_filename;
	

	if( file_exists( '../Gcb.Img.Art/'.$safe_filename) ){
		unlink('../Gcb.Img.Art/'.$safe_filename);
			}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
		
		unlink('../Gcb.Img.Art/'.$_SESSION['smyimg']);
		
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		global $new_name;
		global $rename_filename;
		$rename_filename = "../Gcb.Img.Art/".$new_name;	
		rename($destination_file, $rename_filename);
		$_SESSION['new_name'] = $new_name;

	global $db;
	global $db_name;
	
	global $dyt1;
	$dyt1 = trim($_POST['dyt1']);
	global $tablename;
	$tablename = "gcb_".$dyt1."_articulos";
	$tablename = "`".$tablename."`";

	$sqlc = "UPDATE `$db_name`.$tablename SET `myimg` = '$new_name' WHERE $tablename.`refart` = '$_SESSION[srefart]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			global $new_name;
			print("</br>
					MODIFICADO CORRECTAMENT");
	print( "<table align='center' style=\"margin-top:20px; text-align:left; width:96%; max-width:500px\" >
				<tr>
					<th colspan=3 class='BorderInf'>
						ARTICULO CREADO POR ".strtoupper($_sec)."
					</th>
				</tr>
				
				<tr>
					<td width=140px>
					REFERENCIA
					</td>
					<td width=140px>"
						.$_SESSION['srefart'].
					"</td>
					<td rowspan='4' align='center' width='auto'>
	<img src='../Gcb.Img.Art/".$new_name."' width='98%' height='auto' />
					</td>
				</tr>
				
				<tr>
					<td>
						TITULO
					</td>
					<td>"
						.$_POST['tit'].
					"</td>
				</tr>				
				
				<tr>
					<td>	
						SUBTITULO
					</td>
					<td>"
						.$_POST['titsub'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						DATE IN
					</td>
					<td colspan>"
						.$_POST['datein'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TIME IN
					</td>
					<td colspan=2>"
						.$_POST['timein'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						DATE MOD
					</td>
					<td colspan=2>"
						.$_POST['datemod'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TIME MOD
					</td>
					<td colspan=2>"
						.$_POST['timemod'].
					"</td>
				</tr>
				
				<tr>
					<td>
						CONTENIDO
					</td>
					<td colspan=2>"
						.$_POST['conte'].
					"</td>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' />
						<input type='hidden' name='oculto2' value=1 />
	</form>
					</td>
				</tr>
			</table>");
				}// FIN CONDICIONAL SE CUMPLE EL QUERY
				 else {
				print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						
							} // FIN ELSE SI NO SE CUMPLE EL QUERY

					// print("El archivo se ha guardado en: ".$destination_file);


			} 
			
			else {
					print("No se ha podido guardar el archivo en el direcctorio Gcb.Img.Art/");
			}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db; 	
	global $db_name;

	global $id;
	$id = $_POST['id'];
	global $img;
	$img = 	$_POST['myimg'];

	if(isset($_POST['oculto2'])){

	$_SESSION['smyimg'] = $_POST['myimg'];
	$_SESSION['srefart'] = $_POST['refart'];
	$_SESSION['refuser'] = $_POST['refuser'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'dyt1' => $_POST['dyt1'],
									'refuser' => $_SESSION['refuser'],
									'refart' =>  $_SESSION['refart'],
									'tit' => $_POST['tit'],
								    'titsub' => $_POST['titsub'],
									'datein' => $_POST['datein'],
									'timein' => $_POST['timein'],
									'datemod' => $_POST['datemod'],
									'timemod' => $_POST['timemod'],
									'conte' => $_POST['conte'],
									'myimg' => $img,
									);
								   		}
								   
		elseif($_POST['imagenmodif']){

				$defaults = array ( 'id' => $_POST['id'],
									'dyt1' => $_POST['dyt1'],
									'refuser' => $_SESSION['refuser'],
									'refart' =>  $_SESSION['refart'],
									'tit' => $_POST['tit'],
								    'titsub' => $_POST['titsub'],
									'datein' => $_POST['datein'],
									'timein' => $_POST['timein'],
									'datemod' => $_POST['datemod'],
									'timemod' => $_POST['timemod'],
									'conte' => $_POST['conte'],
									'myimg' => $_POST['myimg'],
									 );
										}
								   
	if ($errors){
		print("	<div  class='errorsimg'>
					<table align='left' style='border:none'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
		
	print("<table align='center' style=\"margin-top:90px; text-align:left; width:96%; max-width:500px\"  border=0>
			
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<td class='BorderInf' align='center'>
				<img src='../Gcb.Img.Art/".$_SESSION['smyimg']."' width='98%' height='auto' />
					</td>
					<td class='BorderInf'>
							LA IMAGEN ACTUAL DEL ARTICULO : </br></br>
							REFERENCIA: ".$_SESSION['srefart']."</br>
							TITULO: ".$_POST['tit'].".
					</td>
				</tr>
				
				<tr>
					<td>
							Seleccione una Fotografía:	
					</td>
					<td>
					<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

				<tr align='center' height=30px>
					<td>
					</td>
					<td >

						<input name='id' type='hidden' value='".$defaults['id']."' />
						<input name='dyt1' type='hidden' value='".$defaults['dyt1']."' />
						<input name='refuser' type='hidden' value='".$_SESSION['refuser']."' />
						<input name='refart' type='hidden' value='".$_SESSION['refart']."' />
						<input name='tit' type='hidden' value='".$defaults['tit']."' />
						<input name='titsub' type='hidden' value='".$defaults['titsub']."' />
						<input name='datein' type='hidden' value='".$defaults['datein']."' />
						<input name='timein' type='hidden' value='".$defaults['timein']."' />
						<input name='datemod' type='hidden' value='".$defaults['datemod']."' />
						<input name='timemod' type='hidden' value='".$defaults['timemod']."' />
						<input name='conte' type='hidden' value='".$defaults['conte']."' />		
						<input name='myimg' type='hidden' value='".$defaults['myimg']."' />
			
						<input type='submit' value='MODIFICAR IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
		</form>																				
					</td>
				</tr>
			
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
					</td>
				</tr>
				
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>");

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Gcb.Inclu/Master_Index_Admin.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
/*
function info_02(){

	global $db;
	global $rowout;
	
	global $destination_file;	
	global $rename_filename;

global $nombre;
global $apellido;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];

	global $dir;
	$dir = "../Gcb.Log";

global $text;
$text = PHP_EOL."- ADMIN MODIFICAR IMG MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".@$nombre." ".@$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename;

	$logdocu = $_SESSION['srefuser'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////

function info_01(){

	global $db;
	global $rowout;
	
	global $nombre;
	global $apellido;
	global $destination_file;	

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $dir;
	$dir = "../Gcb.Log";

global $text;
$text = PHP_EOL."- ADMIN MODIFICAR IMG SELECCIONADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
?>