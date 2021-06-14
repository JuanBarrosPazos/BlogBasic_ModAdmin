<?php

	require 'Gcb.Connet/conection.php';
	require 'Gcb.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

         ayear();
         
         function articulos(){

          global $db;
          global $db_name;
          
          $articulos = "gcb_".date('Y')."_articulos";
          $articulos = "`".$articulos."`";
          
          $tg = "CREATE TABLE IF NOT EXISTS `$db_name`.$articulos (
          `id` int(6) NOT NULL auto_increment,
          `refuser` varchar(22) collate utf8_spanish2_ci NOT NULL,
          `refart` varchar(22) collate utf8_spanish2_ci NOT NULL,
          `tit` varchar(22) collate utf8_spanish2_ci NOT NULL,
          `titsub` varchar(22) collate utf8_spanish2_ci NOT NULL,
          `datein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
          `datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
          `conte` text collate utf8_spanish2_ci NOT NULL,
          `myimg1` varchar(30) collate utf8_spanish2_ci,
          `myimg2` varchar(30) collate utf8_spanish2_ci,
          `myimg3` varchar(30) collate utf8_spanish2_ci,
          `myimg4` varchar(30) collate utf8_spanish2_ci,
          PRIMARY KEY  (`id`),
          UNIQUE KEY `id` (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
            
          if(mysqli_query($db, $tg)){
                  global $dat3;
                  $dat3 = "\t* OK TABLA ".$articulos."\n";
                } else {
                  print( "* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n");
                  global $dat3;
                  $dat3 = "\t* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n";
                }
          }
        
        function modif(){
                                           
          $filename = "Gcb.Config/ayear.php";
          $fw1 = fopen($filename, 'r+');
          $contenido = fread($fw1,filesize($filename));
          fclose($fw1);
          
          $contenido = explode("\n",$contenido);
          $contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
          $contenido = implode("\n",$contenido);
          
          //fseek($fw, 37);
          $fw = fopen($filename, 'w+');
          fwrite($fw, $contenido);
          fclose($fw);
          global $dat1;
          $dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
        }
        
        function modif2(){
        
          $filename = "Gcb.Config/year.txt";
          $fw2 = fopen($filename, 'w+');
          $date = "".date('Y')."";
          fwrite($fw2, $date);
          fclose($fw2);
          global $dat2;
          $dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
        }
        
        
        function ayear(){
          $filename = "Gcb.Config/year.txt";
          $fw2 = fopen($filename, 'r+');
          $fget = fgets($fw2);
          fclose($fw2);
          
          if($fget == date('Y')){
            /*print(" <div style='clear:both'></div>
                <div style='width:200px'>* EL AÑO ES EL MISMO </div>".date('Y')." == ".$fget );
            */		}
          elseif($fget != date('Y')){ 
            print(" <div style='clear:both'></div>
                <div style='width:200px'>* EL AÑO HA CAMBIADO </div>"/*.date('Y')." != ".$fget */);
            modif();
            modif2();
            articulos();
            global $dat1;	global $dat2;	global $dat3;
            global $datos;
			$datos = $dat1.$dat2.$dat3."\n";
			
		// GRABAMOS EL LOG DE CAMBIO DE TABLAS ANUALES ARTICULOS
		global $dir;
		$dir = "Gcb.Log";
		
		global $logdocu;
		$logdocu = "AUTO_SYSTEM";
		global $logdate;
		$logdate = date('Y_m_d');
		global $logtext;
		$logtext = PHP_EOL."** MODIFICACION DE TABLAS ANUALES ARTICULOS => ".$logdate;
		$logtext = $logtext.PHP_EOL.".\t USER REF: ".$logdocu;
		$logtext = $logtext.PHP_EOL.$datos;
		
		global $filename;
		global $log;
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

            }
        }
        
///////////////////////////////////////////////////////////////////////////////////////////////

		ver_todo();

//////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $dyt1;
	$dyt1 = date('Y')-1; /* */
	global $fil;
	$fil = $dyt1."-%";
	//$fil = $dy1.$dm1.$dd1."%";
	global $vname;
	$vname = "gcb_".$dyt1."_articulos";
	$vname = "`".$vname."`";
	
	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);

	if(!$q){
		global $vname;
		$vname = "gcb_".($dyt1-1)."_articulos";
		$vname = "`".$vname."`";
		$result =  "SELECT * FROM $vname ";
		$q = mysqli_query($db, $result);	
	} else { }

	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	global $page;

    if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
		global $page;
        $page = $_GET["page"];
    }

    if (!$page) {
		global $page;
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

	$sqlb =  "SELECT * FROM `$db_name`.$vname ORDER BY `id` DESC $limit";

	/*
	$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){

			print ("<table align='center' style='border:none;'>
						<tr>
							<td style='text-align:center'>
								<h4>
									<a href='Gcb.Www/news.php'>
								NO HAY ENTRADAS EN ".$dyt1."
									<br>
								CONSULTAR NEWS
									</a>
								</h4>
							</td>
						</tr>
					</table>");
	} else { 	

	print ("<div class='row'> <!-- Titulo -->
				<div class='col-lg-12 text-center'>
				<h2 class='section-heading text-uppercase'>Noticias</h2>
				<!--
				<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				-->
				</div>
		  	</div>
			<div class='row'> <!-- Inicio class row-->
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
    $rut = "";
    //$rut = "../";

	require 'Gcb.Artic/Inc_Artic_Index_Form.php';

	require 'Gcb.Artic/Inc_Centra_Index_Img.php';

	print ("
	<li class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>
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
    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

			} 
		
	}

/////////////////////////////////////////////////////////////////////////////////////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */
