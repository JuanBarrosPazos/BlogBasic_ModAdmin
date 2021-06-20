<?php
session_start();

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_head_b.php';
	require '../Gcb.Inclu/mydni.php';
	require 'plantilla_news.php';
	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if(isset($_POST['oculto'])){
		
			if($form_errors = validate_form()){
				show_form($form_errors);
					} else {
						process_form();
						show_form();
							}
		} else { show_form();}
} else { require 'table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();
	
	/* VALIDAMOS EL CAMPO NIVEL. */
	
	if(strlen(trim($_POST['plantillanews'])) == 0){
		$errors [] = "<font color='#FF0000'>SELECCIONE PLANTILLA WEB NEWS</font>";
		}
	
	return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	// CREA EL ARCHIVO MYDNI.TXT $_SESSION['mydni'].
		$filename = "plantillanews.php";
		$fw2 = fopen($filename, 'w+');
		$mydni = '<?php $_SESSION[\'plantillanews\'] = \''.$_POST['plantillanews'].'\'; ?>';
		fwrite($fw2, $mydni);
		fclose($fw2);
	
		$_SESSION['plantillanews'] = $_POST['plantillanews'];

	/**************************************/

	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO CORRETAMENTE
					</th>
				</tr>
								
				<tr>
					<td  align='center'>
						INDEX PLANTILLA WEB NEWS<BR> "
						.$_POST['plantillanews'].
					"</td>
				</tr>
				
			</table>");

		}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if((isset($_POST['oculto']))||(isset($_POST['ocultoch']))){
		$defaults = $_POST;
		} else {$defaults = array ( 'plantillanews' => $_SESSION['plantillanews']); }
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					<tr>
						<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
	
	// ARRAY PARA RADIO BOTTOM
	$plantilla = array ('Articulo_Ver_news.php' => 'PLANTILLA CASILLAS INVERTED & DETALLES CARD EXTENDIDA ',
						/*
						'Articulo_Ver_index_Popup.php' => 'PLANTILLA CASILLAS INVERTED & DETALLES POPUP',
						'Articulo_Ver_index_Card.php' => 'PLANTILLA CARD VERTICAL 1 & DETALLES POPUP',
						'Articulo_Ver_index_Card_b.php' => 'PLANTILLA CARD HORIZONTAL & DETALLES POPUP ',
						'Articulo_Ver_index_Card_c.php' => 'PLANTILLA CARD VERTICAL 2 & DETALLES POPUP ',
						*/
						);	

/*******************************/

		global $c;
		$c=count($plantilla);
		global $a;
		$a=0;
		echo "<div class='juancentra'>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >

		<legend style='text-align:center !important' >
		PLANTILLAS WEB PARA news<br>INDEX PLANTILLA ACTUAL NEWS<br>".$_SESSION['plantillanews']."
		</legend><hr>";

		foreach ($plantilla as $key => $value){
				if ($a<$c){ $a++;}else { }
			echo"
			<div class='gestplantillas'>
			<input id='".$a."' name='plantillanews' type='radio' value='".$key."'";
			
			if($_SESSION['plantillanews'] == $key) {print(" checked=\"checked\"");} else { }
			
			echo" required />
			<label for='".$a."'>".$a." ".$value."</label><br>
				<div style='text-align:center;'>
					<img src='plantillas_img_news/p0".$a."a' />
					<img src='plantillas_img_news/p0".$a."b' />
				</div>
			</div><hr>";
		} // FIN FOREACH

		echo "<div style='text-align:center;'>
				<input type='submit' value='GRABAR NUEVA PLANTILLA NEWS' class='botonverde' />
			  <input type='hidden' name='oculto' value=1 />
				</div></form></fieldset></div>";

	} // FIN FUNCTION show_form()

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		require '../Gcb.Inclu.Menu/rutaartic.php';				
		require '../Gcb.Inclu.Menu/Master_Index.php';

	} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_footer.php';
		
/* Creado por Juan Barros Pazos 2021 */
?>
