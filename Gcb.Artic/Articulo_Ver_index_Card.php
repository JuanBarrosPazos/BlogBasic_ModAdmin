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
						margin: 1px 2px 12px 2px !important;
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

	print ("<table align='center' style='border:none;'>
				<tr><td style='text-align:center'>
		<h4><a href='Gcb.Www/news.php'>NO HAY ENTRADAS EN ".$dyt1."<br>CONSULTAR NEWS</a></h4>
			</td></tr></table>");
	} else { 

    // INICIO DISEÑO PLANTILLA
	print ("<!-- Titulo -->
		 	<!-- <div class='row'> 
				<div class='col-lg-12 text-center'>
				<h2 class='section-heading text-uppercase'>Noticias</h2>
				<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				</div>
		  	</div> -->
            <div class='row articles'><!-- Inicio class row-->
				");
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

	print ("<div class='card col-sm-6 col-md-4'>
                <div class='card-body'>
                    <h4>".$rowb['tit']."</h4>
                    <h7>".$rowb['titsub']."<br>".$rowb['datein']."</h7>
                        ".$visual."
				<h7 class='description'>".$conte."</h7>
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
