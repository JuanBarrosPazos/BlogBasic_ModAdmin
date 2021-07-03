<?php

	require_once 'Gcb.Connet/conection.php';
	require_once 'Gcb.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){

	echo "<style>
				.container { max-width: 96% !important;}

				.card-img-top, video {
					max-width: 98% !important;
					display:block;
					height: auto;
					max-height: 190px !important;
					overflow: hidden;
					border-radius: 8px;
					}
			@media screen and (min-width:720px){
				.articles { width: auto;
							text-align:center !important;
							padding-left: 0.6%;
							margin: 1px auto 1px auto 1px;
							}
				.card { display: inline-block;
						max-width: 32.7%; 
						margin: 1px auto 12px auto !important;
						border-radius: 12px !important;
							}
					}
		</style>";
		
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

	// 	INICIA EL DISEÑO HTML
	require 'Gcb.Artic/Articulo_ver_p02a.php';
			
	while($rowb = mysqli_fetch_assoc($qb)){

        if(strlen(trim($rowb ['myvdo'])) > 0){
            global $visual;
            $visual = "<p>
						<video controls>
                            <source src='Gcb.Vdo.Art/".$rowb['myvdo']."' />
                        </video></p>";
        } else { global $visual;
                 $visual = "<img class='card-img-top' src='Gcb.Img.Art/".$rowb['myimg']."' alt=''>";
                 //$visual = "";
                    }
    
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_d.php';

	// 	CUERPO DEL DISEÑO HTML
	require 'Gcb.Artic/Articulo_ver_p02b.php';

	} // Fin While

	// 	FIN DEL DISEÑO HTML
	require 'Gcb.Artic/Articulo_ver_p02c.php';
			
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
