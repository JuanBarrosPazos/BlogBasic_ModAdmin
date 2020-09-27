<?php

	global $wancho;

	/*	METODO 02 SE CREA UNA JS COOKIE AL CARGAR EL INDEX CON EL VALOR DEL SCREEN.W */
	
		if (isset($_COOKIE['wancho'])){
			// echo 'COOKIE: '. $_COOKIE['wancho'];
			$wancho = $_COOKIE['wancho'];
		}else{ $wancho = 100; }
	
	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("../Gcb.Img.Art/".$rowb['myimg']);

	global $wwref;

	if ($wancho >= 992){ $wwref = 170; }
	elseif (($wancho < 992)&&($wancho >= 768)){ $wwref = 94; }
	elseif ($wancho < 768){ $wwref = 80; }
	else { $wwref = 100; }

	if ($alto > $ancho){
				// ME CENTRA LA IMAGEN VERTICALMENTE
				// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
				$porcenth = round((($wwref * 100) / $ancho),2);
				$newalto = round((($alto * $porcenth) / 100),2);
				$mrgtop = round((($newalto - $wwref) / 2),2); // para px
				$mrgtop = str_replace("-","",$mrgtop);
	$centra = "style=\"width: 100% !important; height: auto !important; margin-top: -".$mrgtop."px;\" ";

	} else { 	// ME CENTRA LA IMAGEN HORIZONTALMENTE
				// PORCENTAJE DE REDUCCIÓN DE ANCHURA IMAGEN
				$porcentw = round((($wwref * 100) / $alto),2);
				$newancho = round((($ancho * $porcentw) / 100),2);
				$mrgleft = round((($newancho - $wwref) / 2),2); // para px
				$mrgleft = str_replace("-","",$mrgleft);
				$centra = "style=\"margin-left: -".$mrgleft."px;\" ";
			}

?>
