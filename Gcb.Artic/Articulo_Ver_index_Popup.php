<?php

	require_once 'Gcb.Connet/conection.php';
	require_once 'Gcb.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;

	require 'Gcb.Artic/Inc_Artic_Index_Pagina_Ini.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){

	require 'Gcb.Artic/Articulo_no_hay_datos_index.php';

	} else { 	
		
	print (" <!-- Titulo -->
			 <!-- <div class='row'>
				<div class='col-lg-12 text-center'>
					<h2 class='section-heading text-uppercase'>Noticias</h2>
					<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				</div>
		  	</div> -->
			<div class='row'> <!-- Inicio class row-->
			<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
			<ul class='timeline'> <!-- Inicio Ul class timeline -->
				");
	global $estilo;
	$estilo = array('timeline','timeline-inverted');
	global $estiloin;
	$estiloin = 0;

	while($rowb = mysqli_fetch_assoc($qb)){
		
        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<p><video controls width='90%' height='auto'>
                            <source src='Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video></p>";
        } else { global $visual;
                 $visual = "<img class='card-img-top' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    

				global $conte;
				$conte = substr($rowb['conte'],0,100);
				$conte = $conte." ...&nbsp;
				
	<form name='ver' method='POST' action='Gcb.Artic/Articulo_Ver_index_Popup_Ver.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=500px, height=650px')\">
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
			</form>";	

	print ("<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
			<img class='imgarticulo' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>
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

	require 'Gcb.Artic/Inc_Artic_Index_Pagina_Fin.php';

			} 
		
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				 ver_todo();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


/* Creado por Juan Manuel Barros Pazos 2020/21 */
