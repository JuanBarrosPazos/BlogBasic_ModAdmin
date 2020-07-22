<?php

	require 'Gcb.Connet/conection.php';
	require 'Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

		ver_todo();

//////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $dyt1;
	$dyt1 = date('Y');
	global $fil;
	$fil = $dyt1."-%";
	//$fil = $dy1.$dm1.$dd1."%";
	global $vname;
	$vname = "gcb_".$dyt1."_articulos";
	$vname = "`".$vname."`";
	
	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	global $nitem;
	$nitem = 3;
	
	global $page;

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
    echo '<h6>* N&uacute;mero de Noticias: '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.' p&aacute;ginas.</h6>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname ORDER BY `id` DESC $limit";

	/*
	$sqlb =  "SELECT * FROM `admin` WHERE `admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
				print ("<table align='center'>
							<tr>
								<td style='text-align:center'>
									<h4>
										<a href='Gcb.Docs/access.php' target='_blank'>
											NO HAY DATOS
										<br>
											CREE SU PRIMER ARTICULO
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
				global $conte;
				$conte = substr($rowb['conte'],0,100);
				$conte = $conte." ...&nbsp;
				
	<form name='ver' action='Gcb.Artic/Articulo_Ver_index_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px, height=600px')\">
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
				<input type='submit' value='LEER MÁS...' />
				<input type='hidden' name='oculto2' value=1 />
				</form>";	

		print ("
			<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
			<img class='rounded-circle img-fluid' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>
			</div>
			<div class='timeline-panel'>
			<div class='timeline-heading'>
				<h5>".$rowb['datein']."</h5>
				<h3>".$rowb['tit']."</h3>
				<h5 class='subheading'>".$rowb['titsub']."</h5>
			</div>
			<div class='timeline-body'>
				<p class='text-muted'>".$conte."</p>
			</div>
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

/* Creado por Juan Barros Pazos 2020 */
