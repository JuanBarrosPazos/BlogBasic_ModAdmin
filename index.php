<?php

	require 'Gcb.Inclu/error_hidden.php';
	require 'Gcb.Inclu/Admin_Inclu_01c.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['limpia'])){
						deltables();
						deldir();
						deltablesb();
						rewrite();
						config_one();
						//inittot();
			 			show_form();
	}

	elseif(isset($_POST['config'])){$_SESSION['inst'] = "noinst";						
	if($form_errors = validate_form()){show_form($form_errors);} 
	else {	process_form();
			require 'Gcb.Connet/conection.php';
			$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
			if (!$db){ 	global $dbconecterror;
						$dbconecterror = $db_name." * ".mysqli_connect_error().PHP_EOL;
						print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
						show_form();
							} elseif($db) { config_one();
									 		crear_tablas();
											ayear();
											global $tablepf;
											print($tablepf);
											}
							}
							
	} else { inittot();
			 show_form();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function inittot(){
	@include 'Gcb.Connet/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ //print ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				$_SESSION['inst'] = "noinst";
				global $inst;
				$inst = '';
	}else{
	global $inst;
	$inst = 1;
	global $sqltadm;
	$sqltadm = "SELECT * FROM `$db_name`.`admin` ";
	if(($inst == 1)&&(@mysqli_num_rows(mysqli_query($db, $sqltadm)) < 1)){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							EXISTE UNA INSTALACION INCOMPLETA
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						CONTINUAR CON ESTA INSTALACIÓN
					</th>
				</tr>
				<tr>
					<td align='center' class='BorderInf'>
						<a href='Gcb.Config/config2.php'>
							CREE EL USUARIO ADMINISTRADOR
			 			</a>
							</br></br>
					</td>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' />
			<input type='hidden' name='limpia' value=1 />
			</br></br>
				</td>
			</fomr>
				</tr>";
}elseif(($inst == 1)&&(@mysqli_num_rows(mysqli_query($db, $sqltadm)) >= 1)){
			$_SESSION['inst'] = "inst";
			global $link;
			$link = "<tr>
						<th align='center' class='BorderInf'>
							<font color='#FF0000'>
								EXISTE UNA INSTALACION ANTERIOR
							</font>
						</th>
					</tr>
					<tr>
						<th align='center'>
							MANTENER TABLAS Y DIRECTORIOS
						</th>
					</tr>
					<tr>
				<form name='inscancel' action='Gcb.Config/config2.php' method='post' >
						<td align='center' class='BorderInf'>
				<input type='submit' value='CONTINUE CON LA CONFIGURACIÓN ACTUAL' />
				<input type='hidden' name='inscancel' value=1 />
				</br></br>
						</td>
				</form>
					</tr>
					<tr>
						<th align='center'>
							INICIAR UNA INSTALACIÓN LIMPIA
						</th>
					</tr>
					<tr>
				<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
					<td  align='center'>
						<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' />
						<input type='hidden' name='limpia' value=1 />
						</br></br>
					</td>
				</fomr>
					</tr>";
	}else{ 	$_SESSION['inst'] = "noinst";
			global $link;
		   	$link = "<tr>
		   				<td>
							<a href='config2.php'>
		   						CREE EL USUARIO ADMINISTRADOR
							</a>
						</td>
					</tr>";
				} // NO HAY DATOS EN LA BBDD
			} // CONDICIONAL SI CONECTO A LA BBDD
}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){

	unset($_SESSION['showf']);
	
	$_SESSION['inst'] = "noinst";

	if(file_exists('Gcb.Config/year.txt')){unlink("Gcb.Config/year.txt");
					$data1 = PHP_EOL."\tUNLINK Gcb.Config/year.txt";}
			else {print("DON`T UNLINK Gcb.Config/year.txt </br>");
					$data1 = PHP_EOL."\tDON'T UNLINK Gcb.Config/year.txt";}

	if(file_exists('Gcb.Config/ayear.php')){unlink("Gcb.Config/ayear.php");
					$data2 = PHP_EOL."\tUNLINK Gcb.Config/ayear.php";}
			else {print("DON'T UNLINK Gcb.Config/ayear.php </br>");
					$data2 = PHP_EOL."\tDON'T UNLINK Gcb.Config/ayear.php";}

	if(!file_exists('Gcb.Config/year.txt')){
			if(file_exists('Gcb.Config/year_Init_System.txt')){
				copy("Gcb.Config/year_Init_System.txt", "Gcb.Config/year.txt");
				$data3 = PHP_EOL."\tRENAME Gcb.Config/year_Init_System.txt TO Gcb.Config/year.txt";
			} else {print("DON'T RENAME Gcb.Config/year_Init_System.txt TO Gcb.Config/year.txt </br>");
				$data3 = PHP_EOL."\tDON'T RENAME Gcb.Config/year_Init_System.txt TO Gcb.Config/year.txt";}
			}

	if(!file_exists('Gcb.Config/ayear.php')){
			if(file_exists('Gcb.Config/ayear_Init_System.php')){
				copy("Gcb.Config/ayear_Init_System.php", "Gcb.Config/ayear.php");
				$data4 = PHP_EOL."\tRENAME Gcb.Config/ayear_Init_System.php TO Gcb.Config/ayear.php";
			} else {print("DON'T RENAME Gcb.Config/ayear_Init_System.php TO Gcb.Config/ayear.php </br>");
				$data4 = PHP_EOL."\tDON'T RENAME Gcb.Config/ayear_Init_System.php TO Gcb.Config/ayear.php";}
			}

	if(!file_exists('Gcb.Img.Art/untitled.png')){
			if(file_exists('Gcb.Img.Sys/untitled.png')){
				copy("Gcb.Img.Sys/untitled.png", "Gcb.Img.Art/untitled.png");
				$data5 = PHP_EOL."\tRENAME Gcb.Img.Art/ayear_Init_System.php TO Gcb.Img.Art/ayear.php";
			} else {print("DON'T CCOPY Gcb.Img.Art/untitled.png </br>");
				$data5 = PHP_EOL."\tDON'T CCOPY Gcb.Img.Art/untitled.png";}
			}
			
	if(!file_exists('Gcb.Img.User/untitled.png')){
			if(file_exists('Gcb.Img.Sys/untitled.png')){
				copy("Gcb.Img.Sys/untitled.png", "Gcb.Img.User/untitled.png");
				$data6 = PHP_EOL."\tRENAME ayear_Init_System.php TO ayear.php";
			} else {print("DON'T CCOPY Gcb.Img.User/untitled.png </br>");
				$data6 = PHP_EOL."\tDON'T CCOPY Gcb.Img.User/untitled.png";}
			}
			
	global $cfone;
	$cfone = PHP_EOL."SUSTITUCION DE ARCHIVOS:".isset($data1).isset($data2).isset($data3).isset($data4).isset($data5).isset($data6);

	//modif();
	//modif2();
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function deldir(){

	unlink("Gcb.Connet/conection.php");

	// BORRA CONTENIDO DE LOS DIRECTORIOS DENTRO DEL USUARIO
	$carpeta1 = "Gcb.Img.Art";
	if(file_exists($carpeta1)){ $dir1 = $carpeta1."/";
								$handle1 = opendir($dir1);
					while ($file1 = readdir($handle1))
							{if (is_file($dir1.$file1))
									{unlink($dir1.$file1);}
									}
							//rmdir ($carpeta1);
								} else {}
											
	$carpeta2 = "Gcb.Img.User";
	if(file_exists($carpeta2)){ $dir2 = $carpeta2."/";
								$handle2 = opendir($dir2);
					while ($file2 = readdir($handle2))
							{if (is_file($dir2.$file2))
									{unlink($dir2.$file2);}
									}
							//rmdir ($carpeta2);
								} else {}


} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function deltables(){

	require 'Gcb.Connet/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

	/*************	BORRAMOS TODAS LAS TABLAS DE ARTICULOS 	***************/

	/* Se busca las tablas en la base de datos */
	/* REFERENCIA DEL USUARIO O $_SESSION['iniref'] = $_POST['ref'] */
	/* $nom PARA LA CLAVE USUARIO ACOMPAÑANDA DE _ O NO */
	global $nom;
	$nom = "gcb_%"; // SOLO COINCIDEN AL PRINCIPIO
	$nom = "LIKE '$nom'";
	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME $nom ";
	$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME $nom ";
	$respuesta = mysqli_query($db, $consulta);
	//$count = mysqli_num_rows($respuesta);
	//print("* NUMERO TABLAS: ".$count."<br>");
	//print("* CLAVE TABLA USUARIO: ".$nom."<br>");

	//global $fila;
	//$fila = mysqli_fetch_row($respuesta);

if(!$respuesta){
print("<font color='#FF0000'>L.246 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else { 
		while ($fila = mysqli_fetch_row($respuesta)) {
			if($fila[0]){
		/* PROCEDEMOS A BORRAR LAS TABLAS DEL USUARIO */
			global $sqlt;
			$sqlt = "DROP TABLE `$db_name`.`$fila[0]` ";
			if(mysqli_query($db, $sqlt)){
				} else {
					//print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
							} 
		/* HASTA AQUI BORRA TABLAS Y PASA LOS LOG DE BBDD */
					} // FIN IF $FILA[0]
				} // FIN WHILE

		// SE GRABAN LOS DATOS EN LOG DEL ADMIN
	} // FIN ELSE !$respuesta

}

function deltablesb(){

	require 'Gcb.Connet/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

	/*************	BORRAMOS LAS TABLAS DEL SISTEMA 	***************/

	global $sqlt1;
	$sqlt1 = "DROP TABLE `$db_name`.`admin` ";
	if(mysqli_query($db, $sqlt1)){
		} else {
			print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
					}

	global $sqlt2;
	$sqlt2 = "DROP TABLE `$db_name`.`ipcontrol` ";
	if(mysqli_query($db, $sqlt2)){
		} else {
			print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
					}

	global $sqlt3;
	$sqlt3 = "DROP TABLE `$db_name`.`visitasadmin` ";
	if(mysqli_query($db, $sqlt3)){
		} else {
			print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
					}
		
}

function rewrite(){

	$bddata = '<?php
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = ""; 
	$db_user = ""; 
	$db_pass = ""; 
	$db_name = ""; 
	?>';

	$filename = "Gcb.Connet/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	global $data5;
	$data5 = PHP_EOL."\tREWRITE Gcb.Connet/conection.php";

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>NO VALIDOS</font>";
		}

	return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";

	$bddata = '<?php
				global $db_host;
				global $db_user;
				global $db_pass;
				global $db_name;
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';
	
	$filename = "Gcb.Connet/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	
	global $tablepf;
	$tablepf = "<table align='center'>
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
							\$db_host = ".$host.";
					</td>		
				</tr>								

				<tr>
					<td>
							VARIABLE USER NAME
					</td>
					<td>
							\$db_user = ".$user.";
					</td>		
				</tr>	
												
				<tr>
					<td>
							VARIABLE PASSWORD
					</td>
					<td>
							\$db_pass = ".$pass.";
					</td>		
				</tr>	
												
				<tr>
					<td>
							VARIABLE BBDD NAME
					</td>
					<td>
							\$db_name = ".$name.";
					</td>		
				</tr>
				<tr>
		   			<td colspan=2 align='center'>
						<a href='Gcb.Config/config2.php'>
		   					CREE EL USUARIO ADMINISTRADOR
						</a>
					</td>
				</tr>
		</table>";
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function crear_tablas(){
	
	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/

	$admin = "CREATE TABLE IF NOT EXISTS `$db_name`.`admin` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
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
					$table1 = "\t* OK TABLA ADMIN.".PHP_EOL;
				} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}

	/************** CREAMOS LA TABLA ARTICULOS ***************/

	$articulos = "gcb_".date('Y')."_articulos";
	$articulos = "`".$articulos."`";
	
	$tg = "CREATE TABLE IF NOT EXISTS `$db_name`.$articulos (
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
	
	$tg2 = "CREATE TABLE IF NOT EXISTS `$db_name`.$articulos2 (
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
					
	/************* CREAMOS LA TABLA IP CONTROL****************/

	$ipcontrol = "CREATE TABLE IF NOT EXISTS `$db_name`.`ipcontrol` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `ipn` varchar(22) collate utf8_spanish2_ci NOT NULL default 'lost',
  `error`varchar(4) collate utf8_spanish2_ci NOT NULL default '1',
  `acceso` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  `date` varchar(12) collate utf8_spanish2_ci NOT NULL default '0000/00/00',
  `time` varchar(10) collate utf8_spanish2_ci NOT NULL default '00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $ipcontrol)){
					global $table2;
					$table2 = "\t* OK TABLA IP CONTROL. \n";
				} else {
					global $table2;
					$table2 = "\t* NO OK TABLA IP CONTROL. ".mysqli_error($db)." \n";
					}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	$visitas = "CREATE TABLE IF NOT EXISTS `$db_name`.`visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
		global $link;
		print ("<table align='center'>
							".$link."
				</table>");		

		global $table3;
		$table3 = "\t* OK TABLA VISITAS ADMIN.".PHP_EOL;

	$vd = "INSERT INTO `$db_name`.`visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
	(69, 0, 0, 0, 0)";
		if(mysqli_query($db, $vd)){
						global $table4;
						$table4 = "\t* OK INIT VALUES EN VISITAS ADMIN.".PHP_EOL;
		} else { global $table4;
				 $table4 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table3;
			$table3 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			global $table4;
			$table4 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		global $data0;
		global $cfone;
		$datein = date('Y-m-d/H:i:s');

		$logdate = date('Y_m_d');
		$logtext = $cfone.PHP_EOL;
		$logtext = $logtext.PHP_EOL."- CONFIG INIT ".$datein;
		$logtext = $logtext.PHP_EOL." * ".$db_name;
		$logtext = $logtext.PHP_EOL." * ".$db_host;
		$logtext = $logtext.PHP_EOL." * ".$db_user;
		$logtext = $logtext.PHP_EOL." * ".$db_pass;
		$logtext = $logtext.PHP_EOL.$dbconecterror;
		$logtext = $logtext.PHP_EOL.$data0.$table1.$table2.$table3.$table4.PHP_EOL;

		$filename = "Gcb.Config/logs/".$logdate."_CONFIG_INIT.log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "Gcb.Config/ayear.php";
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

	$filename = "Gcb.Config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear(){
	$filename = "Gcb.Config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 	modif();
									modif2();
		}

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if(isset($_POST['config'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '');
								   }
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
					}
					
	global $link;
	if($_SESSION['inst'] == "inst"){ print ("<table align='center'>
														".$link."
											</table>");		
	}else{
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
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=25 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=25 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=25 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=25 value='".$defaults['name']."' />
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
		} // FIN PRINT TABLE
	
	} // FIN FUNCTION SHOW_FOMR	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Gcb.Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>