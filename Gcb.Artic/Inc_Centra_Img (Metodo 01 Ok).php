<?php

	/* METODO 01 EN BASE A GET Y SCREEN.WIDTH	*/

	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("../Gcb.Img.Art/".$rowb['myimg']);

	global $wwref;
	global $wancho;
	if((!isset($_GET['wancho']))&&(!isset($_POST['leermas']))&&(!isset($_POST['leermenos']))&&(!isset($_POST['login']))&&(!isset($_GET['page']))&&(!isset($_GET['pagef']))&&(!isset($_POST['pagef']))&&(!isset($_POST['oculto1']))&&(!isset($_POST['oculto']))){

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='index.php?wancho='+screen.width;
					}
					setTimeout('redir()',1);
					</script>";
				print ($redir);
				$wancho = $_SESSION['wancho'];
		} else { if(isset($_GET['wancho'])) { // echo "ANCHO: ".$_GET['ancho'];
			$wancho = $_GET['wancho'];
			$_SESSION['wancho'] = $_GET['wancho'];
				} else { // echo "NO SE HA DETECTADO";
						 $wancho = $_SESSION['wancho'];
							}
						}

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
