<?php

	// METODO 00 CENTRA LAS IMAGENES CON UNA APROXIMACIÓN

	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("../Gcb.Img.Art/".$rowb['myimg']);

	if ($alto > $ancho){
				// ME CENTRA LA IMAGEN VERTICALMENTE
				// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
				$porcenth = round((8600 / $ancho),2);
				$newalto = round((($alto * $porcenth) / 100),2);
				$mrgtop = round((($newalto - 86) / 2),2); // para px
				$mrgtop = str_replace("-","",$mrgtop);
	$centra = "style=\"width: 100% !important; height: auto !important; margin-top: -".$mrgtop."px;\" ";

	} else { 	// ME CENTRA LA IMAGEN HORIZONTALMENTE
				// PORCENTAJE DE REDUCCIÓN DE ANCHURA IMAGEN
				$porcentw = round((9800 / $alto),2);
				$newancho = round((($ancho * $porcentw) / 100),2);
				$mrgleft = round((($newancho - 98) / 2),2); // para px
				$mrgleft = str_replace("-","",$mrgleft);
				$centra = "style=\"margin-left: -".$mrgleft."px;\" ";
		}

?>