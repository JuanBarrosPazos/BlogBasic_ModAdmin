<?php
session_start();

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';
	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['delete'])){	delete();
								show_form();
							  	listfiles();
							}
	
		elseif(isset($_POST['oculto2'])){	show_form();
								  	ver_todo();
							  		listfiles();

				} else {	show_form();
							listfiles();
						}
								
			} else { require '../Gcb.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){

	global $db;
	global $db_name;
	
	if((isset($_POST['oculto1']))||(isset($_POST['oculto2']))||(isset($_POST['delete']))){
					$_SESSION['tablas'] = strtolower($_POST['tablas']);
					$defaults = array ('Orden' => isset($ordenar),
								   	   'tablas' => strtolower($_POST['tablas']),
								   						);
					// print($_SESSION['tablas']);
										}
	else{unset($_SESSION['tablas']);}
	
	$tablas = array (	'' => 'TABLAS',
						'admin' => 'ADMIN SYS',
						'gcb_' => 'ARTICULOS',);														
		

	if($_SESSION['Nivel'] == 'admin'){
		
	print("<table align='center' style='border:1; margin-top:2px' width='auto'>
				
		<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
			
			<input type='hidden' name='Orden' value='".@$defaults['Orden']."' />
				<tr>
					<td align='center'>
							EXPORTE TABLAS BBDD.
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left; margin-right:6px''>
						<input type='submit' value='SELECCIONE USUARIO / TABLA' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

			<select name='tablas'>");
				foreach($tablas as $option => $label){
							print ("<option value='".$option."' ");
							if($option == $defaults['tablas']){print ("selected = 'selected'");}
															print ("> $label </option>");
														}	
		print ("</select>
					</div>
				</td>
			</tr>
		</form>	
			</table>"); 
	}
	
			////////////////////		**********  		////////////////////

	if ((isset($_POST['oculto1'])) || (isset($_POST['todo'])) ) {
			
	if ($_SESSION['tablas'] == '') { 
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr align='center'>
							<td>
								<font color='red'>
							SELECCIONE UNA TABLA O NOMBRE DE USUARIO
								</font>
							</td>
						</tr>
					</table>");
				}	
					
	if ($_SESSION['tablas'] != '') {

	global $nom;
	$nom = strtolower($_SESSION['tablas']);
	if (strtolower($_SESSION['tablas']) == 'admin'){$nom = $nom;}
	else{$nom = $nom."%";}
	$nom = "LIKE '$nom'";
	
/* Se busca las tablas en la base de datos */

	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES ";
	$consulta = "SHOW TABLES FROM $db_name $nom";
	$respuesta = mysqli_query($db, $consulta);
	if(!$respuesta){
	print("<font color='#FF0000'>194 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		
	} else {print( "<table align='center'>
						<tr>
							<th colspan=2 class='BorderInf'>
								NUMERO DE TABLAS ".mysqli_num_rows($respuesta).".
							</th>
						</tr>");
			while ($fila = mysqli_fetch_row($respuesta)) {
				if($fila[0]){
				print(	"<tr>
							<td class='BorderInfDch'>
											".$fila[0]."
							</td>
							<td class='BorderInf'>
				<form name='exporta' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='tablas' value='".$defaults['tablas']."' />
					<input name='tabla' type='hidden' value='".$fila[0]."' />
					<input type='submit' value='EXPORTA TABLA ".strtoupper($fila[0])."' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
							</td>
						<tr>");
				}
					}
			print("</table>");		
				}
			}
		}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
	
		require 'export_bbdd.php';

	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){
	
	global $ruta;
	$ruta ="bbdd/";
	
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob("bbdd/{*}",GLOB_BRACE));
	if($num < 1){print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' class='BorderInf'>NO HAY ARCHIVOS PARA DESCARGAR</td></tr>");
	}else{
		
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' colspan='3' class='BorderInf'>ARCHIVOS RESPALDO BBDD </td></tr>");
	while($archivo = readdir($directorio)){
		if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			print("<tr>
			<td class='BorderInfDch'>
			<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
			<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
			<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
			<input type='submit' value='ELIMINAR' >
			<input type='hidden' name='delete' value='1' >
			</form>
			</td>
			<td class='BorderInfDch'>
			<form name='archivos' action='".$ruta.$archivo."' target='_blank' method='post'>
			<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
			<input type='submit' value='DESCARGAR'>
			</form>
			</td>
			<td class='BorderInf'>".strtoupper($archivo)."</td>
			");
		}else{}
	} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}

function delete(){unlink($_POST['ruta']);}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Gcb.Inclu/Master_Index_bbdd.php';
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>