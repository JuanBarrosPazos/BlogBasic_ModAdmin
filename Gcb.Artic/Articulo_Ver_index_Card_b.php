<?php

	require_once 'Gcb.Connet/conection.php';
	require_once 'Gcb.Connet/conect.php';

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
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 4;

	require 'Gcb.Artic/Articulo_Ver_index_vertodo_a.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){

			require 'Gcb.Artic/Articulo_no_hay_datos_index.php';

	} else { 	

    // INICIO DISEÑO PLANTILLA
	//require 'Gcb.Artic/Articulo_Ver_news_vertodo_e.php';

			print("<div class='row projects'><!-- Inicio class row-->");

	while($rowb = mysqli_fetch_assoc($qb)){

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<video controls>
                            <source src='Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video>";
        } else { global $visual;
                 $visual = "<img class='img-fluid' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_d.php';

	print ("<div class='col-sm-6 item'>
				<div class='row'>
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
