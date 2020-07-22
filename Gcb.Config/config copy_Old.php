<?php

	require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';

	if(isset($_POST['config'])){
							
	if($form_errors = validate_form()){ show_form($form_errors); } 
	
	else {	process_form();
			require '../Gcb.Connet/conection.php';
			error_reporting (0);
			global $db;
			$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
	if (!$db){ 	global $dbconecterror;
				global $db_name;
				$dbconecterror = $db_name." * ".mysqli_connect_error()."\n"; 
				print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
				show_form();
						} elseif($db) { config_one();
								 		crear_tablas();
								 		ayear();
										}
							}
						
	} else { show_form(); }

//////////////////////////////////////////////////////////////////////////////////////////////

function config_one(){
	
	if(file_exists('year.txt')){unlink("year.txt");
					$data1 = "\n \t UNLINK year.txt";}
			else {print("ERROR UNLINK year.txt </br>");
					$data1 = "\n \t ERROR UNLINK year.txt";}


	if(file_exists('ayear.php')){unlink("ayear.php");
					$data2 = "\n \t UNLINK ayear.php";}
			else {print("ERROR UNLINK ayear.php </br>");
					$data2 = "\n \t ERROR UNLINK ayear.php";}

	if(!file_exists('year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "year.txt");
				$data3 = "\n \t RENAME year_Init_System.txt TO year.txt";
			} else {print("ERROR RENAME year_Init_System.txt TO year.txt </br>");
				$data3 = "\n \t ERROR RENAME year_Init_System.txt TO year.txt";}
			}

	if(!file_exists('ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "ayear.php");
				$data4 = "\n \t RENAME ayear_Init_System.php TO ayear.php";
			} else {print("ERROR RENAME ayear_Init_System.php TO ayear.php </br>");
				$data4 = "\n \t ERROR RENAME ayear_Init_System.php TO ayear.php";}
			}
	
	global $cfone;
	$cfone ="\n SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4;

	}
	
//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){

	$errors = array();
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*\s]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*\s]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*\s]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\*\s]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 _ \.]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

			return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";

	$bddata = '<?php
				global $db;
				global $db_host;
				global $db_user;
				global $db_pass;
				global $db_name;
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';
	
	$filename = "../Gcb.Connet/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	
	
	print("	<table align='center'>
		
					<tr>
						<td colspan='2' align='center'>
								SE HA CREADO EL ARCHIVO DE CONEXIONES.
							</br>
								CON LAS SIGUIENTES VARIABLES.
						</td>
					</tr>
					<tr>
						<td>
								VARIABLE HOST ADRESS
						</td>
						<td>
								\$db_host = ".$host."; \n
						</td>		
					</tr>								

					<tr>
						<td>
								VARIABLE USER NAME
						</td>
						<td>
								\$db_user = ".$user."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE PASSWORD
						</td>
						<td>
								\$db_pass = ".$pass."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE BBDD NAME
						</td>
						<td>
								\$db_name = ".$name."; \n
						</td>		
					</tr>
													
				</table>
				
							");
							
			}	

//////////////////////////////////////////////////////////////////////////////////////////////
	
	function crear_tablas(){
	
	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/
					
	$admin = "CREATE TABLE `$db_name`.`admin` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'close',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
					global $table1;
					$table1 = "\t* OK TABLA ADMIN. \n";
				} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db)." \n";
					}
					
	/************** CREAMOS LA TABLA ARTICULOS ***************/

	$articulos = "gcb_".date('Y')."_articulos";
	$articulos = "`".$articulos."`";
	
	$tg = "CREATE TABLE `$db_name`.$articulos (
  `id` int(6) NOT NULL auto_increment,
  `refuser` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `refart` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `tit` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `titsub` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `datein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `conte` text(402) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `refart` (`refart`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg)){
					global $table2;
					$table2 = "\t* OK TABLA ".$articulos."\n";
				} else {
					print( "* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n");
					global $table2;
					$table2 = "\t* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n";
				}

  // PARA CUATRO IMAGENES;
  //`myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',

	/************** CREAMOS LA TABLA ARTICULOS AÑO PASADO ***************/
	
	global $dy;
	$dy = date('Y')-1;
	$articulos2 = "gcb_".$dy."_articulos";
	$articulos2 = "`".$articulos2."`";
	
	$tg2 = "CREATE TABLE `$db_name`.$articulos2 (
  `id` int(6) NOT NULL auto_increment,
  `refuser` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `refart` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `tit` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `titsub` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `datein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `conte` text(402) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `refart` (`refart`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg2)){
					global $table2b;
					$table2b = "\t* OK TABLA ".$articulos2."\n";
				} else {
					print( "* NO OK TABLA ".$articulos2.". ".mysqli_error($db)."\n");
					global $table2b;
					$table2b = "\t* NO OK TABLA ".$articulos2.". ".mysqli_error($db)."\n";
				}

  // PARA CUATRO IMAGENES;
  //`myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  //`myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',

  /************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	$visitas = "CREATE TABLE `$db_name`.`visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci";
		
	if(mysqli_query($db, $visitas)){
			print ("<table align='center'>
									<tr>
										<td>
											<a href='config2.php'>
														CREE EL USUARIO ADMINISTRADOR
											</a>
										</td>
									</tr>
								</table>
										");			
					global $table3;
					$table3 = "\t* OK TABLA VISITAS ADMIN. \n";
				} else {
					global $table3;
					$table3 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db)." \n";
					}
					
	$vd = "INSERT INTO `$db_name`.`visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
					global $table4;
					$table4 = "\t* OK INIT VALUES EN VISITAS ADMIN. \n";
				} else {
					global $table4;
					$table4 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db)." \n";
					}
					
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
global $cfone;
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = $cfone."\n - CONFIG INIT ".$datein.".\n * \$db_name: ".$db_name.". \n * \$db_host: ".$db_host.". \n \$db_user: * ".$db_user.". \n * \$db_pass: ".$db_pass."\n".$dbconecterror.$table1.$table2.$table2b.$table3.$table4."\n";
$filename = $logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	}	

///////////////////////

function modif(){
									   							
	$filename = "ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif2(){

	$filename = "year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear(){
	$filename = "year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 	modif();
									modif2();
								}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if(isset($_POST['config'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
												);
								   }
	
	if ($errors){
		print("<table align='center'>
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
		
	print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
				SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px\">

				<tr>
					<th colspan=2 class='BorderInf'>

							INIT CONFIG DATA
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=22 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=22 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=22 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=22 value='".$defaults['name']."' />
					</td>
				</tr>

				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' />
						<input type='hidden' name='config' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////


/* Creado por Juan Barros Pazos 2019 */
?>