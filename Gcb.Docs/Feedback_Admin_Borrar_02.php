<?php
session_start();

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_Head_b.php';
	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';
	require '../Gcb.Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if (@$_POST['oculto2']){ limpiatemp();
							 show_form();
							 info_01();
							}
	elseif($_POST['borrar']){ copyimgtemp();
							  process_form();
							  deletelog();
							  info_02();
		} else {show_form();}
	} else { require '../Gcb.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function anonimo() {
		require '../Gcb.Config/ayear.php';
		foreach($dy as $key => $value){
			//echo $key." => ".$value."<br>";
			global $db;
			global $db_name;
			global $tablename;
			if ($key != ""){ $tablename = "gcb_20".$key."_articulos";
							 $tablename = "`".$tablename."`"; 
			$sql =  "UPDATE `$db_name`.$tablename SET `refuser` = 'anonimo' WHERE $tablename.`refuser` = '$_POST[ref]' ";
			$q = mysqli_query($db, $sql);
				if(!$q){
					print("<font color='#FF0000'>Consulte L.174: </font></br>".mysqli_error($db)."</br>");
				} else { } // FIN ELSE
			}
		} // FIN FOREACH
	} //FIN FUNCTION ANONIMO

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function limpiatemp(){
	global $ctemp;
	$ctemp = "../Gcb.Temp";
	if(file_exists($ctemp)){$dir1 = $ctemp."/";
							$handle1 = opendir($dir1);
							while ($file1 = readdir($handle1))
									{if (is_file($dir1.$file1))
										{unlink($dir1.$file1);}
										}	
								//rmdir ($ctemp);
						} else {}
	}

function copyimgtemp(){
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
	}

function deletelog(){
	
		if (@$_SESSION['sref'] == "") { @$_SESSION['sref'] = $_POST['ref']; }
		else { }

		global $ruta;
		$ruta ="../Gcb.Log/";
		//print("RUTA: ".$ruta.".</br>");
		
		global $rutag;
		$rutag = "../Gcb.Log/{*}";
		//print("RUTA G: ".$rutag.".</br>");
			
		$directorio = opendir($ruta);
		global $num;
		$num=count(glob($rutag,GLOB_BRACE));
		if($num < 1){ }else{
		
		while($archivo = readdir($directorio)){
	
				$arch = substr($archivo, -15, 16);
				$arch = strtolower($arch);
				$ses = strtolower($_SESSION['sref'].".log");
	
			if(($archivo != ',') && ($archivo != '.') && ($archivo != '..') && ($arch == $ses)){
	
				unlink($ruta.$archivo);

			}else{}

		} // FIN DEL WHILE
		}
		closedir($directorio);
	
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$sql = "DELETE FROM `$db_name`.$table_name_f WHERE $table_name_f.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
			//print("* ");
	
	anonimo();
	/*
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
	*/

	print ("<table>
				<tr><td colspan=3  class='BorderInf'>
					SE HAN BORRADO TODOS LOS DATOS.
				</td></tr>");
	
		global $rutaimg;
		$rutaimg = "src='../Gcb.Temp/".$_POST['myimg']."'";
		require 'table_data_resum.php';
		require 'table_data_resum_feed.php';

		require 'Admin_Botonera.php';

	print("	<tr>
				<td colspan=3 class='BorderSup'>
						".$inicioadmin.$iniciobajas."
				</td>
			</tr>
		</table>"); // SE IMPRIME LA TABLA DE CONFIRMACION

	
	unlink("../Gcb.Img.User/".$_POST['myimg']);
	
	} // FIN PRIMER IF SI SE BORRA EL USER DE LA BBDD
	  // => ELSE BORRADO NO OK PRIMER QUERY
		else {print("<font color='#FF0000'>SE HA PRODUCIDO UN ERROR: </font>
					</br>&nbsp;&nbsp;".mysqli_error($db))."</br>";
					show_form ();
						}
		
	}	// FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){
	
	if($_POST['oculto2']){	$_SESSION['sref'] = $_POST['ref'];
							global $array_a;
							$array_a = 1;
							require 'admin_array_total.php'; 
				}

	if(@$_POST['borrar']){  global $array_a;
							$array_a = 1;
							require 'admin_array_total.php'; }
								   
	print("<table style='margin-top:1px;'>
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.</br>
						DIRECTORIOS Y TABLAS DE BBDD.</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>

				<tr>
					<th colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Feedback_Ver.php' >CANCELAR Y VOLVER</a>
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>");
			
			require 'admin_input_default_a.php';
			require 'feedback_table_show_form.php';

		 print("<tr>
					<td colspan='3' class='BorderSup'>
		<input type='submit' value='BORRAR DATOS PERMANENTEMENTE' class='botonrojo' />
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
$text = PHP_EOL."- USER BAJAS BORRARDO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

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

		
	global $rf;
	$rf = @$_POST['ref'];
	global $nombre;
	$nombre = @$_POST['Nombre'];
	global $apellido;
	$apellido = @$_POST['Apellidos'];
		
	global $orden;
	$orden = @$_POST['Orden'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Gcb.Log";

global $text;
$text = PHP_EOL."- USER BAJAS BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

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

/* Creado por Juan Barros Pazos 2021 */
?>