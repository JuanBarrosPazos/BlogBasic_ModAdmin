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
			video {
				max-width: 98% !important;
				height: auto;
				max-height: 190px !important;
				overflow: hidden;
				border-radius: 8px;
				}
		</style>";

    global $db;
	global $db_name;
	
	//echo @$_SESSION['autor']."<br>";

	global $autor;
	global $g;
	global $titulo;

	if (strlen(trim(@$_SESSION['titulo'])) == 0){
		$titulo = '';
		$g = 'AND';
	}else{
		$titulo = trim($_SESSION['titulo']);
		$titulo = "AND `tit` LIKE '%".$titulo."%' ";
		$g = 'OR';
	}

	if (strlen(trim(@$_SESSION['autor'])) == 0){
		$autor = '';
	}else{
		$autor = trim($_SESSION['autor']);
		$autor = "$g `refuser` LIKE '%".$autor."%' ";
	}

	global $orden;
	$orden = "`id` DESC";

	//global $dd1;
	
	if ((isset($_POST["page"]))||(isset($_GET["page"]))){
		global $dyt1;
		global $dy1;
		$dy1 = "20".$_SESSION['dy'];
		$dyt1 = "20".$_SESSION['dy'];
	}
	elseif ((!isset($_POST['dy']))||($_POST['dy'] == '')){	
								global $dyt1;
								global $dy1;
								$dy1 = date('Y');
								$dyt1 = date('Y');
								$_SESSION['dy'] = date('y');
											} 
							 				else {	global $dyt1;
													global $dy1;
													$dy1 = "20".$_SESSION['dy'];
													$dyt1 = "20".$_SESSION['dy'];
													}
	
	if ((isset($_POST["page"]))||(isset($_GET["page"]))){
		global $dm1;
		$dm1 = "-".$_SESSION['dm'];
	}
	elseif (!isset($_POST['dm'])){ 	global $dm1;
									$dm1 = '';} 
											 else {	global $dm1;
													$dm1 = "-".$_SESSION['dm'];
													}
	global $fil;
	$fil = $dy1.$dm1."%";
	//$fil = $dy1."-%".$dm1."%";
	global $vname;
	$vname = "gcb_".$dyt1."_articulos";
	//$vname = "`".$vname."`";

	$result =  "SELECT * FROM `$db_name`.$vname WHERE `visible` = 'y' AND `datein` LIKE '$fil' $titulo $autor ";
	$q = mysqli_query($db, $result);
	global $row;
	@$row = mysqli_fetch_assoc($q);
	global $num_total_rows;
	@$num_total_rows = mysqli_num_rows($q);

	if(!$q || ($num_total_rows < 1)){
		echo "<div class='juancentra' style=\"margin-bottom:0.4em !important;\"><h5>** NO HAY DATOS EN ".$_SESSION['dyt1']." **</h5></div>";
	} else { }

	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 4;
	
	global $page;

	if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* Noticias: '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `visible` = 'y' AND `datein` LIKE '$fil' $titulo $autor  ORDER BY $orden $limit";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.116: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td aling='center'>
												<font color='#FF0000'>
													NO HAY DATOS 20".$_SESSION['dy']."
												</font>
											</td>
										</tr>
									</table>");
									
		} else {

    // INICIO DISEÑO PLANTILLA
	print ("<!-- Titulo -->
			<div class='projects-horizontal'> 
				<div class='intro text-center'>
					<h2 class='section-heading text-uppercase'>Noticias</h2>
				 <!--
                 	<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				  -->
                  </div>
		  	</div>
            <div class='row projects'><!-- Inicio class row-->
				");
			
	while($rowb = mysqli_fetch_assoc($qb)){

	if ($page > 1){
		global $pg;
		$pg = "<input type='hidden' name='page' value=".$page." />";
	}else{	global $pg;
			$pg = "<input type='hidden' name='page' value=1 />";
			}

	global $db;
	$sqlra =  "SELECT * FROM `gcb_admin` WHERE `ref`='$rowb[refuser]' LIMIT 1 ";
	$qra = mysqli_query($db, $sqlra);
	
	if(!$qra){ print("* ".mysqli_error($db)."</br>");
	} else { 
			while($rowautor = mysqli_fetch_assoc($qra)){
				global $autor;
				$autor = "<h6>".$rowautor['Nombre']." ".$rowautor['Apellidos']."</h6>";
				}
			}

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<p>
						<video controls>
                            <source src='../Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video></p>";
        } else { global $visual;
                 $visual = "<img class='card-img-top' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
	global $conte;
	$conte = substr($rowb['conte'],0,100);
	$conte = $conte." ...&nbsp;
        <form name='ver' method='POST' action='../Gcb.Artic/Articulo_Ver_index_Popup_Ver.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=500px, height=650px')\">
				<input name='id' type='hidden' value='".$rowb['id']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input name='refart' type='hidden' value='".$rowb['refart']."' />
				<input name='tit' type='hidden' value='".$rowb['tit']."' />
				<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
				<input name='datein' type='hidden' value='".$rowb['datein']."' />
				<input name='timein' type='hidden' value='".$rowb['timein']."' />
				<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
				<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
				<input name='conte' type='hidden' value='".$rowb['conte']."' />
				<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
				<input name='myvdo' type='hidden' value='".$rowb['myvdo']."' />
				<input type='submit' value='LEER MÁS...' class='botonleer' />
				<input type='hidden' name='oculto2' value=1 />
				".$pg."
			</form>";

	print ("<div class='col-sm-6 item'>
				<div class='row' style='text-align:left !important;'>
                        <div class='col-md-12 col-lg-5'>
							".$visual."
                        </div>
                        <div class='col'>
                            <h3 class='name'>".$rowb['tit']."</h3>
							<h7>".$rowb['titsub']."<br>".$rowb['datein']."</h7>
                           	<p class='description'>".$conte."</p>
                        </div>
				</div>
		 </div>");
		} // Fin While

        print(" </div> <!-- Fin class row-->");

				} 

    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="news.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

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
		print("</td></tr></table></div>
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
					if($optiondm == @$defaults['dm']){print ("selected = 'selected'");}
													print ("> $labeldm </option>");}	
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
		
	echo "<style>
			video {
				max-width: 98% !important;
				height: auto;
				max-height: 190px !important;
				overflow: hidden;
				border-radius: 8px;
				}
		</style>";

    global $db;
	global $db_name;

	global $dyt1;
	$dyt1 = date('Y')/*-1*/;
	if(!isset($_SESSION['dy'])){$_SESSION['dy'] = date('y')/*-1*/;
								$_SESSION['dm'] = '';
	} else { }

	global $fil;
	$fil = $dyt1."-%";
	//$fil = $dy1.$dm1.$dd1."%";
	global $vname;
	$vname = "gcb_".$dyt1."_articulos";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `visible` = 'y' AND `datein` LIKE '$fil'";
	$q = mysqli_query($db, $result);
	global $row;
	@$row = mysqli_fetch_assoc($q);
	global $num_total_rows;
	@$num_total_rows = mysqli_num_rows($q);

	if(!$q || ($num_total_rows < 1)){
		echo "<div class='juancentra' style=\"margin-bottom:0.4em !important;\"><h5>** NO HAY DATOS EN ".$_SESSION['dyt1']." **</h5></div>";
	} else { }

	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 4;
	
	global $page;

     if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
	}
	
   //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* Noticias: '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `visible` = 'y' AND `datein` LIKE '$fil' ORDER BY `id` DESC $limit";

	/*
	$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
				print ("<table align='center'>
							<tr><td aling='center'>
									<font color='#FF0000'>
										NO HAY DATOS 20".$_SESSION['dy']."
									</font>
							</td></tr></table>");
	} else {

    // INICIO DISEÑO PLANTILLA
	print ("<!-- Titulo -->
			<div class='projects-horizontal'> 
				<div class='intro  text-center'>
					<h2 class='section-heading text-uppercase'>Noticias</h2>
				 <!--
                 	<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				  -->
                  </div>
		  	</div>
            <div class='row projects'><!-- Inicio class row-->
				");
			
		while($rowb = mysqli_fetch_assoc($qb)){

	if ($page > 1){
		global $pg;
		$pg = "<input type='hidden' name='page' value=".$page." />";
	}else{	global $pg;
			$pg = "<input type='hidden' name='page' value=1 />";
			}

	global $db;
	$sqlra =  "SELECT * FROM `gcb_admin` WHERE `ref`='$rowb[refuser]' LIMIT 1 ";
	$qra = mysqli_query($db, $sqlra);
	
	if(!$qra){ print("* ".mysqli_error($db)."</br>");
	} else { 
			while($rowautor = mysqli_fetch_assoc($qra)){
				global $autor;
				$autor = "<h6>".$rowautor['Nombre']." ".$rowautor['Apellidos']."</h6>";
				}
			}

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<p>
						<video controls>
                            <source src='../Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video></p>";
        } else { global $visual;
                 $visual = "<img class='card-img-top' src='../Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    
	global $conte;
	$conte = substr($rowb['conte'],0,100);
	$conte = $conte." ...&nbsp;
	<form name='ver' method='POST' action='../Gcb.Artic/Articulo_Ver_index_Popup_Ver.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=500px, height=650px')\">
				<input name='id' type='hidden' value='".$rowb['id']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input name='refart' type='hidden' value='".$rowb['refart']."' />
				<input name='tit' type='hidden' value='".$rowb['tit']."' />
				<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
				<input name='datein' type='hidden' value='".$rowb['datein']."' />
				<input name='timein' type='hidden' value='".$rowb['timein']."' />
				<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
				<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
				<input name='conte' type='hidden' value='".$rowb['conte']."' />
				<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
				<input name='myvdo' type='hidden' value='".$rowb['myvdo']."' />
				<input type='submit' value='LEER MÁS...' class='botonleer' />
				<input type='hidden' name='oculto2' value=1 />
				".$pg."
			</form>";

	print ("<div class='col-sm-6 item'>
				<div class='row' style='text-align:left !important;'>
                        <div class='col-md-12 col-lg-5'>
							".$visual."
                        </div>
                        <div class='col'>
                            <h3 class='name'>".$rowb['tit']."</h3>
							<h7>".$rowb['titsub']."<br>".$rowb['datein']."</h7>
                           	<p class='description'>".$conte."</p>
                        </div>
				</div>
		 </div>");

		} // Fin While

        print(" </div> <!-- Fin class row-->");
            
            } 

    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="news.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

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
