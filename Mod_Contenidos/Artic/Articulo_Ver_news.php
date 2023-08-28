<?php
	//@session_start();

	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['oculto'])){
				if($form_errors = validate_form()){
						show_form($form_errors);
				} else {show_form();
						process_form();
						//info();
							}
			}	

	elseif ((isset($_GET['page'])) || (isset($_POST['page']))) { 
												show_form();
												process_form(); 
											}

	else { 	unset($_SESSION['titulo']);
			unset($_SESSION['autor']);
			unset($_SESSION['dy']);
			unset($_SESSION['dm']);	
			show_form();
			ver_todo();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if (strlen(@trim($_POST['titulo'])) > 0) {
		
		if (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['titulo'])){
			$errors [] = "<font color='#FF0000'>CARACTERES NO VALIDOS</font>";
			}
		}
	
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;

	require '../Artic/Inc_Artic_News_Pagina_Ini_process.php';
	

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.175 </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){

		require '../Artic/Articulo_no_hay_datos.php';
									
	} else {print ("<div class='row'> <!-- Titulo -->
						<div class='col-lg-12 text-center'>
						<h2 class='section-heading text-uppercase'>Noticias</h2>
						</div>
				  	</div>
					
			<div class='row'> <!-- Inicio class row-->
			<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
			<ul class='timeline'> <!-- Inicio Ul class timeline -->");
			
				global $estilo;
				$estilo = array('timeline','timeline-inverted');
				global $estiloin;
				$estiloin = 0;
	
		while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Artic/Inc_Artic_News_Form.php';

	print ("<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='../Img.Art/".$rowb['myimg']."' alt=''>
			</div>
			<div class='timeline-panel'>
			<div class='timeline-heading'>
				<h6>".$rowb['datein']."</h6>
				<h5>".$rowb['tit']."</h5>
			</div>
			<div class='timeline-body'>
				<p class='text-muted'>".$conte."</p>
			</div>
		<div id=\"".$refart."\"></div>
			</div>
		</li> <!-- Final Li contenedor -->
		");
		$estiloin = 1 - $estiloin;	

		} // Fin While

	print(" </ul> <!-- Fin Ul class timeline -->
			</div> <!-- Fin class col-lg-12 -->
  			</div> <!-- Fin class row-->
			");
				} 

	require '../Artic/Inc_Artic_News_Pagina_Fin_process.php';

			} 
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){

	// FORMULARIO FILTRO ARTICULOS AUTOR
	require '../Artic/Articulo_Ver_news_showform.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;

	require '../Artic/Inc_Artic_News_Pagina_Ini_todo.php';

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("</br><font color='#FF0000'>Consulte L.152 Artic/Articulo_Ver_news.php: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){

		require '../Artic/Articulo_no_hay_datos.php';

			} else {
	print ("<div class='row'> <!-- Titulo -->
				<div class='col-lg-12 text-center'>
					<h2 class='section-heading text-uppercase'>Noticias</h2>
				</div>
		  	</div>
					
			<div class='row'> <!-- Inicio class row-->
			<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
			<ul class='timeline'> <!-- Inicio Ul class timeline -->");
			
			global $estilo;
			$estilo = array('timeline','timeline-inverted');
			global $estiloin;
			$estiloin = 0;

		while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Artic/Inc_Artic_News_Form.php';

	print ("<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='../Img.Art/".$rowb['myimg']."' alt=''>
			</div>
			<div class='timeline-panel'>
			<div class='timeline-heading'>
				<h6>".$rowb['datein']."</h6>
				<h5>".$rowb['tit']."</h5>
			</div>
			<div class='timeline-body'>
				<p class='text-muted'>".$conte."</p>
			</div>
		<div id=\"".$refart."\"></div>
			</div>
		</li> <!-- Final Li contenedor -->
		");
		$estiloin = 1 - $estiloin;	

		} // Fin While

	print(" </ul> <!-- Fin Ul class timeline -->
			</div> <!-- Fin class col-lg-12 -->
  			</div> <!-- Fin class row-->
			");
						} 

	require '../Artic/Inc_Artic_News_Pagina_Fin_todo.php';

			} 
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db; 		global $rowout;
	global $nombre; 	global $apellido;

	global $orden;
	if((isset($_POST['Orden']))&&($_POST['Orden']|= '')){
		$orden = $_POST['Orden'];
	}else { $orden = '`id` ASC'; }
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = isset($_POST['ref']);
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

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

	//require '../Inclu/Admin_Inclu_footer.php';
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */
