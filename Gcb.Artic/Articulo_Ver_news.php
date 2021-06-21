<?php
	//@session_start();

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

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
	
	if (strlen(trim($_POST['titulo'])) > 0) {
		
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
	
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_ab.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.116: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){

				require '../Gcb.Artic/Articulo_no_hay_datos.php';
				
				} else {
					
    // INICIO DISEÑO PLANTILLA
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_e.php';

			print("<div class='row'> <!-- Inicio class row-->
						<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
							<ul class='timeline'> <!-- Inicio Ul class timeline -->
								");
			
				global $estilo;
				$estilo = array('timeline','timeline-inverted');
				global $estiloin;
				$estiloin = 0;
	
		while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_c.php';

	print ("<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>
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
				
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_b.php';

			} 
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){

	global $page;
	global $defaults;

	if(isset($_POST['oculto'])){$_SESSION['titulo'] = $_POST['titulo'];
								$_SESSION['autor'] = $_POST['autor'];
								$_SESSION['dy'] = $_POST['dy'];
								$_SESSION['dm'] = $_POST['dm'];
								$defaults = $_POST;
		}
	else {	$defaults = array ('titulo' => @$_SESSION['titulo'],
								'autor' => @$_SESSION['autor'],
								'dy' => @$_SESSION['dy'],
								'dm' => @$_SESSION['dm']
							);
										}
	
	if ($errors){
		print("	<div  class='errors'>
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
		
		require "../Gcb.Config/ayear.php";
			
		$dm = array (	'' => 'MES TODOS',
						'01' => 'ENERO',
						'02' => 'FEBRERO',
						'03' => 'MARZO',
						'04' => 'ABRIL',
						'05' => 'MAYO',
						'06' => 'JUNIO',
						'07' => 'JULIO',
						'08' => 'AGOSTO',
						'09' => 'SEPTIEMBRE',
						'10' => 'OCTUBRE',
						'11' => 'NOVIEMBRE',
						'12' => 'DICIEMBRE',
										);
		
		$dd = array (	'' => 'DÍA TODOS',
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						);
											

	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRO NOTICIAS' />
						<input type='hidden' name='oculto' value=1 />
		<!-- --> 
	<input type='hidden' name='titulo' size=20 maxlenth=10 value='".$defaults['titulo']."' />
		

		<select name='autor'>
			
		<option value=''>SELECCIONE AUTOR</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gcb_admin` ORDER BY `Apellidos` ASC ";
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

	print ("</select>

				<select name='dy'>"
				);
							
					foreach($dy as $optiondy => $labeldy){
						
						print ("<option value='".$optiondy."' ");
						
						if($optiondy == @$defaults['dy']){print ("selected = 'selected'");}
														print ("> $labeldy </option>");
													}	
																	
			print ("	</select>
						<!--<select name='dm'>-->
						<input type='hidden' name='dm' value='' />
						");
		/*
				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == @$defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
		*/														
		print ("<!--</select>-->
				</td>
			</tr>
		</form>	
			</table>
			");
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_a.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){

				require '../Gcb.Artic/Articulo_no_hay_datos.php';

			} else {

    // INICIO DISEÑO PLANTILLA
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_e.php';

			print("<div class='row'> <!-- Inicio class row-->
					<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
						<ul class='timeline'> <!-- Inicio Ul class timeline -->
							");
			
				global $estilo;
				$estilo = array('timeline','timeline-inverted');
				global $estiloin;
				$estiloin = 0;

		while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_c.php';

	print ("<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>
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

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_b.php';

			} 
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = isset($_POST['ref']);
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gcb.Log";
	
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

	//require '../Gcb.Inclu/Admin_Inclu_footer.php';
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */
