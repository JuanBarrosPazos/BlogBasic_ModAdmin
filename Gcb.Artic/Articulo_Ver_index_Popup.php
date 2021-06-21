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
	
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_a.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){

			require 'Gcb.Artic/Articulo_no_hay_datos_index.php';

	} else { 	
		
    // INICIO DISEÑO PLANTILLA
	//require 'Gcb.Artic/Articulo_Ver_news_vertodo_e.php';

			print("<div class='row'> <!-- Inicio class row-->
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
    
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_d.php';

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

	require 'Gcb.Artic/Articulo_Ver_index_vertodo_b.php';

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
