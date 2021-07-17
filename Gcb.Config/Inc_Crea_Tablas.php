<?php

	/************** CREAMOS LA TABLA ADMIN ***************/

	$admin = "CREATE TABLE IF NOT EXISTS `$db_name`.`gcb_admin` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
  `Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` varchar(9) NOT NULL default '0',
  `Tlf2` varchar(9) NOT NULL default '0',
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
	
	$ad = "INSERT INTO `$db_name`.`gcb_admin` (`id`,`ref`,`Nivel`,`Nombre`,`Apellidos`,`myimg`,`doc`,`dni`,`ldni`,`Email`,`Usuario`,`Password`,`Pass`,`Direccion`,`Tlf1`,`Tlf2`,`lastin`,`lastout`,`visitadmin`) VALUES
	(1, 'anonimo', 'close', 'Anonimo', 'Autor', 'untitled.png', 'anonimo', 'anonimo', 'a', 'anonimo', 'anonimo', 'anonimo', 'anonimo', 'anonimo', '0', '0', '0', '0', '0')";
		if(mysqli_query($db, $ad)){
						$table1 = $table1."\t* OK INIT VALUES EN VISITAS ADMIN.".PHP_EOL;
		} else { $table1 = $table1."\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
						}

			} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}

	/************* CREAMOS LA TABLA FEEDBACK ****************/

	$feedback = "CREATE TABLE IF NOT EXISTS `$db_name`.`gcb_feedback` (
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
		`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
		`Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
		`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
		`Tlf1`varchar(9) NOT NULL default '0',
		`Tlf2`varchar(9) NOT NULL default '0',
		`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
		`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
		`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
		`borrado` varchar(22) collate utf8_spanish2_ci NOT NULL default '0',

		UNIQUE KEY `id` (`id`),
		UNIQUE KEY `ref` (`ref`),
		UNIQUE KEY `dni` (`dni`),
		UNIQUE KEY `Email` (`Email`),
		UNIQUE KEY `Usuario` (`Usuario`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db, $feedback)){
											  
						  global $table1b;
						  $table1b = "\t* OK TABLA FEEDBACK.".PHP_EOL;
						  
					  } else {
						  
						  global $table1b;
						  $table1b = "\t* NO OK TABLA FEEDBACK. ".mysqli_error($db).PHP_EOL;
	  
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
  `myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
  `myurl` varchar(50) collate utf8_spanish2_ci DEFAULT NULL,
  `visible` varchar(1) collate utf8_spanish2_ci NOT NULL default 'n',
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

	/************** CREAMOS LA TABLA ARTICULOS AÑO PASADO **************
	
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
  `myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
  `myurl` varchar(50) collate utf8_spanish2_ci DEFAULT NULL,
  `visible` varchar(1) collate utf8_spanish2_ci NOT NULL default 'n',
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
*/
					
	/************* CREAMOS LA TABLA IP CONTROL****************/

	$ipcontrol = "CREATE TABLE IF NOT EXISTS `$db_name`.`gcb_ipcontrol` (
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

	$visitas = "CREATE TABLE IF NOT EXISTS `$db_name`.`gcb_visitasadmin` (
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

	$vd = "INSERT INTO `$db_name`.`gcb_visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
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

    /* Creado por Juan Manuel Barros Pazos 2020/21 */

?>