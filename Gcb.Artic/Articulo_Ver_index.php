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
	
	// INICIO LA PAGINACION Y CONSULTA DE RESULTADOS
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_a.php';

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){

			// TABLA DE NO HAY DATOS
			require 'Gcb.Artic/Articulo_no_hay_datos_index.php';

		} else { 

    // INICIO DISEÑO PLANTILLA
	// TITULO CABECERA NOTICIAS
	//require 'Gcb.Artic/Articulo_Ver_news_vertodo_e.php';

	// INICIO CUERPO PLANTILLA
	require 'Gcb.Artic/Articulo_Ver_p01a.php';

	while($rowb = mysqli_fetch_assoc($qb)){

    // DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    $rut = "";
    //$rut = "../";
	
	// SE WHILE DE LA PLANTILLA
	require 'Gcb.Artic/Articulo_Ver_index_vertodo_c.php';
	// CUERPO DE LA PLANTILLA
	require 'Gcb.Artic/Articulo_Ver_p01b.php';

	} // Fin While

	// FIN DE LA PLANTILLA
	require 'Gcb.Artic/Articulo_Ver_p01c.php';

			} // FIN ELSE

	// FIN DE LA PAGINACION
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
