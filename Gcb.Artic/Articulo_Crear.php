<?php
session_start();

  	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

					master_index();

						if(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											//accion_Log();
											}
							} else {
										show_form();
								}
} else { require '../Gcb.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();

	if(strlen(trim($_POST['refart'])) != 0){	
			$secc1 = "gcb_".date('Y')."_articulos";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `refart` = '$_POST[refart]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
				$errors [] = "YA EXISTE EL ARTICULO.";
				}
		}

	if($_FILES['myimg']['size'] == 0){
		$errors [] = "Seleccione una fotograf&iacute;a.";
		global $img2;
		$img2 = 'untitled.png';
		}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		 
		if(!$ext_correcta){
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
		}
	
		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['titulo'])) == 0){
		$errors [] = "TITULO <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['titulo'])) < 6){
		$errors [] = "TITULO <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['titulo'])){
		$errors [] = "TITULO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['titulo'])){
		$errors [] = "TITULO  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	elseif(strlen(trim($_POST['titulo'])) != 0){	
			$secc1 = "gcb_".date('Y')."_articulos";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `tit` = '$_POST[titulo]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
			$errors [] = "YA EXISTE ESTE TITULO";
				}
		}

	if(strlen(trim($_POST['subtitul'])) == 0){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['subtitul'])) < 5){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	elseif(strlen(trim($_POST['subtitul'])) != 0){	
			$secc1 = "gcb_".date('Y')."_articulos";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `titsub` = '$_POST[subtitul]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
			$errors [] = "YA EXISTE ESTE SUBTITULO";
				}
		}
	
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "ARTICULO <font color='#FF0000'>Campo obligatorio.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) <= 50){
		$errors [] = "ARTICULO <font color='#FF0000'>Mas de 50 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) >= 402){
		$errors [] = "ARTICULO <font color='#FF0000'>Excedió más de 400 carácteres.</font>";
		}
		

	elseif (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-()¡!¿?@ áéíóúñ €]+$/',$_POST['coment'])){
			$errors [] = "ARTICULO  <font color='#FF0000'>Caracteres no permitidos. { } [ ] $ < >  # ...</font>";
			}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	global $secc;	
	global $_sec;
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	
	global $carpetaimg;
	$carpetaimg = "../Gcb.Img.Art";
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	global $new_name;
	$new_name = $_POST['refart'].".".$extension;


		/* GRABAMOS LOS DATOS EN LA TABLA DE ARTICULOS DE ESTE AÑO */

		global $db;
		global $db_name;

		global $tablename;
		$tablename = "gcb_".date('Y')."_articulos";
		$tablename = "`".$tablename."`";
		global $titulo;
		$titulo = strtoupper($_POST['titulo']);
		global $subtitul;
		$subtitul = strtoupper($_POST['subtitul']);

	$sqla = "INSERT INTO `$db_name`.$tablename (`refuser`, `refart`,`tit`,`titsub`,`datein`,`timein`,`datemod`,`timemod`,`conte`,`myimg`) VALUES ('$_POST[autor]', '$_POST[refart]', '$titulo', '$subtitul', '$_POST[datein]', '$_POST[timein]', '0000-00-00', '00:00:00', '$_POST[coment]', '$new_name')";

	if(mysqli_query($db, $sqla)){

			global $carpetaimg;
			global $new_name;

			print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						CREADO POR ".strtoupper($_sec)."
					</th>
				</tr>
												
				<tr>
					<td width=120px>
						REFERENCIA
					</td>
					<td width=100px>"
						.$_POST['refart'].
					"</td>
					<td rowspan='4' align='center' width='120px'>
				<img src='".$carpetaimg."/".$new_name."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						TITULO
					</td>
					<td>"
						.$_POST['titulo'].
					"</td>
				</tr>				
				
				<tr>
					<td>	
						SUBTITULO
					</td>
					<td>"
						.$_POST['subtitul'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						DATE IN
					</td>
					<td>"
						.$_POST['datein'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TIME IN
					</td>
					<td>"
						.$_POST['timein'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3  align='center'>
						ARTICULO
					</td>
				</tr>
				<tr>
					<td colspan=3>"
						.$_POST['coment'].
					"</td>
				</tr>
				<tr>
					<th colspan=3 class='BorderSup'>
						<a href=Articulo_Crear.php>CREAR UN NUEVO ARTICULO</a>
					</th>
				</tr>
			</table>");
			
		/************* CREAMOS LAS IMAGENES DEL ARTICULO EN EL DIRECTORIO Gcb.Img.Art ***************/

	if($_FILES['myimg']['size'] == 0){
				global $carpetaimg;
				global $new_name;
				copy("../Gcb.Img.Sys/untitled.png", $carpetaimg."/".$new_name);
		} 	
		else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
				$safe_filename = trim(str_replace('..', '', $safe_filename));

				$nombre = $_FILES['myimg']['name'];
				$nombre_tmp = $_FILES['myimg']['tmp_name'];
				$tipo = $_FILES['myimg']['type'];
				$tamano = $_FILES['myimg']['size'];
			
				$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $carpetaimg;
			global $new_name;
			$new_name = $_POST['refart'].".".$extension;
			$rename_filename = $carpetaimg."/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}

		}

	} 	else {print("* MODIFIQUE LA ENTRADA L.207: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto1'])){
		$defaults = $_POST;
		$_SESSION['refart'] = date('Y.m.d.H.i.s');
		$_SESSION['datein'] = date('Y-m-d');
		$_SESSION['timein'] = date('H:i:s');
		} 
	elseif(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'autor' => isset($_POST['autor']),  // ref autor
									'titulo' => '', // Titulo
								   	'subtitul' => '', // Sub Titulo
								   	//'refart' => @$_SESSION['refart'],  Referencia articulo
								   	'coment' => '',
									'myimg' => '',	
												);
								   					}
	
	if ($errors){
		print("	<table align='center'>
					<th style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
				}
		
	global $db;
	global $_sec;

	global $autor;
	$autor = @$_POST['autor'];

	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = @$rowautor['Nombre'];

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						CREAR ARTICULO DE ".strtoupper($_sec)."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UN AUTOR' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='autor'>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `admin` ORDER BY `Apellidos` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['autor']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
				}
		
			}  

	print ("	</select>
					</td>
			</tr>
	
		</form>	
			
			</table>				
						");
				
	if (isset($_POST['oculto1']) || isset($_POST['oculto'])) {
	if ($_POST['autor'] == '0') { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UN AUTOR PARA CREAR ARTICULOS.
											</font>
										</td>
									</tr>
								</table>");
												}	

//////////////////////////

		if ($_POST['autor'] == ''){print("
								<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													SELECCIONE UN AUTOR.
											</font>
										</td>
									</tr>
								</table>");} 
								
	elseif ($_POST['autor'] != '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							NUEVO ARTICULO DE ".strtoupper($_sec)."
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						

			<tr>								
						<td width=100px>
							REF AUTOR
						</td>
						<td>
			<input name='autor' type='hidden' value='".$defaults['autor']."' />".$defaults['autor']."
						</td>
			</tr>

				<tr>
					<td>
						TITULO
					</td>
					<td>

		<input type='text' name='titulo' size=20 maxlength=20 value='".@$defaults['titulo']."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						SUBTITULO
					</td>
					<td>
		<input type='text' name='subtitul' size=20 maxlength=20 value='".@$defaults['subtitul']."' />
					</td>
				</tr>
									
				<tr>
					<td>						
						REFERENCIA
					</td>
					<td>
		<input type='hidden' name='refart' value='".$_SESSION['refart']."' />".$_SESSION['refart']."
					</td>
				</tr>
				<tr>
					<td>						
						DATE IN
					</td>
					<td>
		<input type='hidden' name='datein' value='".$_SESSION['datein']."' />".$_SESSION['datein']."
					</td>
				</tr>
				<tr>
					<td>						
						TIME IN
					</td>
					<td>
		<input type='hidden' name='timein' value='".$_SESSION['timein']."' />".$_SESSION['timein']."
					</td>
				</tr>
					
				<tr>
					<td colspan=2 align='center'>
						ARTICULO
					</td>
				</tr>
				<tr>
					<td colspan=2 align='center'>
	<textarea cols='41' rows='9' onkeypress='return limitac(event, 400);' onkeyup='actualizaInfoc(400)' name='coment' id='coment'>".@$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 400 characters            
				</div>

					</td>
				</tr>
								
				<tr>
					<td>
						FOTOGRAFÍA
					</td>
					<td>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='CREAR ARTICULO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			</table>				
						"); 
											}
												}
	
			}	

/////////////////////////////////////////////////////////////////////////////////////////////////
/*
function accion_Log(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTO CREAR ".$ActionTime.". ".$secc.".\n\t Pro Name: ".$_POST['subtitul'].".\n\t Pro titulo: ".$_POST['titulo'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Gcb.Inclu/Master_Index_Artic.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';

?>