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
	
	echo "<style> 
			.jcard { margin: 1px auto 6px auto !important; text-align: left; }
			video { background-color: #343434; }
			.img-fluid { max-height: 190px !important;}
		  </style>";

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

	// INICIO DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p03a.php';
			
	while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_f.php';

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<video class='img-fluid' controls>
                            <source class'vdo' src='../Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video>";
        } else { global $visual;
                 $visual = "<img class='img-fluid' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_d.php';

	// CUERPO DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p04b.php';

        } // Fin While

	// CUERPO DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p02c.php';

				} 

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_b.php';

			} 
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){

	// FORMULARIO FILTRO ARTICULOS AUTOR
	require '../Gcb.Artic/Articulo_Ver_news_showform.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	echo "<style> 
			.jcard { margin: 1px auto 6px auto !important; text-align: left; }
			video { background-color: #343434; }
			.img-fluid { max-height: 190px !important;}
		  </style>";

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

	// INICIO DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p03a.php';
			
		while($rowb = mysqli_fetch_assoc($qb)){

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gcb.Artic/Articulo_Ver_news_vertodo_f.php';

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<video class='img-fluid' controls>
                            <source class'vdo' src='../Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video>";
        } else { global $visual;
                 $visual = "<img class='img-fluid' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    
	require '../Gcb.Artic/Articulo_Ver_news_vertodo_d.php';

	// CUERPO DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p04b.php';

		} // Fin While

	// FIN DISEÑO HTML
	require '../Gcb.Artic/Articulo_ver_p02c.php';
            
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
