<?php

	require 'Gcb.Connet/conection.php';
	require 'Gcb.Connet/conect.php';

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

	require 'Gcb.Artic/Articulo_Ver_p01a.php';

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
    
    // DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    $rut = "";
    //$rut = "../";

	require 'Gcb.Artic/Articulo_Ver_index_vertodo_d.php';

	require 'Gcb.Artic/Articulo_Ver_p01b.php';

	} // Fin While

	require 'Gcb.Artic/Articulo_Ver_p01c.php';
			
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
