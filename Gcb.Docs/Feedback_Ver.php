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

		if(@$_POST['todo']){ show_form();							
							ver_todo();
							info();
							}
								
		elseif(@$_POST['oculto']){
				if($form_errors = validate_form()){
								show_form($form_errors);
							} else {process_form();
									info();
									}
								}

		elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
											show_form();
											ver_todo();
										}

		else {show_form();
			  ver_todo();
				}

		} else { require '../Gcb.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if ( (strlen(@trim($_POST['Nombre'])) == 0) && (strlen(@trim($_POST['Apellidos'])) == 0) ){
		$errors [] = " <font color='#FF0000'>UNO DE LOS DOS CAMPOS OBLIGATORIO</font>";
		}
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	$nombre = $_POST['Nombre'];
	global $apellido;
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";
	global $orden;
	$orden = @$_POST['Orden'];
		
	if (strlen(@trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(@trim($_POST['Nombre'])) == 0){ $nom = $ape;}

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."feedback`";

	$sqlb =  "SELECT * FROM $table_name_a WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
 	
	$qb = mysqli_query($db, $sqlb);
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS BAJAS CONSULTAR";
	
	require 'Admin_Botonera.php';
	require 'Inc_While_Form_Feed.php';
		global $rutaimg;
		$rutaimg = "../Gcb.Img.User/";
	require 'Inc_While_Total_Feed.php';

			////////////////////		**********  		////////////////////
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	global $titulo;
	$titulo = "BAJAS TEMPORALES DEL SISTEMA<hr>";
	global $boton;
	$boton = "BAJAS VER TODAS";
	require 'Inc_Show_Form_01.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;

	if (($_SESSION['Nivel'] == 'admin')){ 

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."feedback`";

			if(isset($_POST['Orden'])){	global $orden;
										$orden = $_POST['Orden'];
			} elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
										global $orden;
										$orden = $_SESSION['Orden']; 
			} else { global $orden;
					 $orden ='`id` ASC';}

	require 'Paginacion_Head.php';

	$sqlb =  "SELECT * FROM $table_name_a  ORDER BY $orden $limit";
	/* $sqlb =  "SELECT * FROM $table_name_a ORDER BY $orden "; */
	$qb = mysqli_query($db, $sqlb);
	}
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "TODOS USUARIOS BAJAS CONSULTAR";

	require 'Admin_Botonera.php';
	require 'Inc_While_Form_Feed.php';
	global $ruta;
	$ruta = "";
	global $rutaimg;
	$rutaimg = "../Gcb.Img.User/";
	global $pagedest;
	$pagedest = "Feedback_Ver.php";
	require 'Inc_While_Total_Feed.php';

			////////////////////		**********  		////////////////////
		
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

function info(){


	global $orden;
	$orden = @$_POST['Orden'];
	
	if (@$_POST['todo']){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	global $rf;
	$rf = @$_POST['ref'];
	global $nombre;
	$nombre = @$_POST['Nombre'];
	global $apellido;
	$apellido = @$_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gcb.Log";

	global $text;
	$text = PHP_EOL."- USER BAJAS BUSQUEDA ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

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