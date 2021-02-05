<?php

    global $conte;
    $conte = substr($rowb['conte'],0,56);
    $conte = $conte." ...";	

    global $rutaurl;
    global $rutaurlart;
    global $rutaurlvdo;
    global $rutaurlimg;
    if ($rectifurl == 1){   $rutaurl = "../";
                            $rutaurlart = "Gcb.Artic/";
                            $rutaurlvdo = "upvdo/";
                                }
    else {  $rutaurl = ""; 
            $rutaurlart = "";
            $rutaurlvdo = "upvdo/";
    }

	if(strlen(trim($rowb['myvdo'])) > 0){
		global $visual;
		$visual = "<video controls width='98%' height='auto'>
						<source src='".$rutaurl."Gcb.Vdo.Art/".$rowb['myvdo']."' />
					</video>";
		global $delvdo;
		$delvdo = "<input type='submit' value='BORRAR VIDEO' />";
		global $upvdo;
		$upvdo = "<input type='submit' value='MODIFICA VIDEO' />";
	} else { global $visual;
			 $visual = "<img src='".$rutaurl."Gcb.Img.Art/untitled.png' width='92%' height='auto' />";
			 global $delvdo;
			 $delvdo = "";
			 global $upvdo;
			 $upvdo = "<input type='submit' value='CREAR VIDEO' />";
				}

    print ("<div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top:8px; padding-top: 0px; border-top: #fff solid 1px;\">

            <div class='whiletotala'>
                DATE IN<br>".strtoupper($rowb['datein'])."
            </div>

            <div class='whiletotala'>
                TITULO<br>".strtoupper($rowb['tit'])."
            </div>

            <div class='whiletotala' style=\"width:180px !important; text-align:left;\">
                <span style=\"display:block; text-align:center;\">
                    DESCRIPCION
                </span>".strtoupper($conte)."
            </div>

            <div class='whiletotala'>
                <img src='".$rutaurl."Gcb.Img.Art/".$rowb['myimg']."' width='92%' height='auto' />
            </div>
                                    
            <div class='whiletotala'>
                ".$visual."
            </div>
                                    
		</div>

		<div class=\"BorderInf\" style=\"text-align:center; display:block;\">

    <form name='ver' action='".$rutaurl.$rutaurlart."Articulo_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=auto')\" class='whiletotala'>
                ");

        require 'Inc_Artic_While_Total_Rows.php';
        
    print ("    <input type='submit' value='VER DETALLES' />
                <input type='hidden' name='oculto2' value=1 />
            </form>

		<form name='ver' action='".$rutaurl.$rutaurlart."Articulo_Modificar_02.php' method='POST' class='whiletotala'>
			");

            require 'Inc_Artic_While_Total_Rows.php';

		print("	<input type='submit' value='MODIFICA DATOS' />
				<input type='hidden' name='oculto2' value=1 />
			</form>

			<form name='ver' action='".$rutaurl.$rutaurlart."Articulo_Borrar_02.php' method='POST' class='whiletotala'>
			");

            require 'Inc_Artic_While_Total_Rows.php';

		print("	<input type='submit' value='BORRA DATOS' />
				<input type='hidden' name='oculto2' value=1 />
			</form>


	<form name='modifica_img' action='".$rutaurl.$rutaurlart."Articulo_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=550px,height=400px')\" class='whiletotala' >
			");
			
            require 'Inc_Artic_While_Total_Rows.php';

		print(" <input type='submit' value='MODIFICA IMAGEN' />
				<input type='hidden' name='oculto2' value=1 />
	</form>

		<form name='videonews' action='".$rutaurl.$rutaurlart.$rutaurlvdo."upvdo.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

            require 'Inc_Artic_While_Total_Rows.php';
			
	print( $upvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='videonews' action='".$rutaurl.$rutaurlart."Articulo_Vdo_Borrar.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

            require 'Inc_Artic_While_Total_Rows.php';
			
	print( $delvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>	

    </div>");

    /* Creado por Juan Manuel Barros Pazos 2020/21 */

    ?>