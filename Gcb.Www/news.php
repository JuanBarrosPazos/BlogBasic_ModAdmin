<?php
  session_start();

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////

  require_once '../Gcb.Connet/conection.php';
	require_once '../Gcb.Connet/conect.php';

      ayear();
         
      function articulos(){

      global $db;
      global $db_name;
          
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
      PRIMARY KEY  (`id`),
      UNIQUE KEY `id` (`id`),
      UNIQUE KEY `refart` (`refart`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
                
          if(mysqli_query($db, $tg)){
                  global $dat3;
                  $dat3 = "\t* OK TABLA ".$articulos."\n";
                } else {
                  print( "* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n");
                  global $dat3;
                  $dat3 = "\t* NO OK TABLA ".$articulos.". ".mysqli_error($db)."\n";
                }
          }
        
        function modif(){
                                           
          $filename = "../Gcb.Config/ayear.php";
          $fw1 = fopen($filename, 'r+');
          $contenido = fread($fw1,filesize($filename));
          fclose($fw1);
          
          $contenido = explode("\n",$contenido);
          $contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
          $contenido = implode("\n",$contenido);
          
          //fseek($fw, 37);
          $fw = fopen($filename, 'w+');
          fwrite($fw, $contenido);
          fclose($fw);
          global $dat1;
          $dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
        }
        
        function modif2(){
        
          $filename = "../Gcb.Config/year.txt";
          $fw2 = fopen($filename, 'w+');
          $date = "".date('Y')."";
          fwrite($fw2, $date);
          fclose($fw2);
          global $dat2;
          $dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
        }
        
        
      function ayear(){
          $filename = "../Gcb.Config/year.txt";
          $fw2 = fopen($filename, 'r+');
          $fget = fgets($fw2);
          fclose($fw2);
          
          if($fget == date('Y')){
            /*print(" <div style='clear:both'></div>
                <div style='width:200px'>* EL AÑO ES EL MISMO </div>".date('Y')." == ".$fget );
            */		}
          elseif($fget != date('Y')){ 
            /* 
              print(" <div style='clear:both'></div>
              <div style='width:200px'>* EL AÑO HA CAMBIADO </div>".date('Y')." != ".$fget );
            */
            modif();
            modif2();
            articulos();
            global $dat1;	global $dat2;	global $dat3;
            global $datos;
			      $datos = $dat1.$dat2.$dat3."\n";
			
		// GRABAMOS EL LOG DE CAMBIO DE TABLAS ANUALES ARTICULOS
		global $dir;
		$dir = "../Gcb.Log";
		
		global $logdocu;
		$logdocu = "AUTO_SYSTEM";
		global $logdate;
		$logdate = date('Y_m_d');
		global $logtext;
		$logtext = PHP_EOL."** MODIFICACION DE TABLAS ANUALES ARTICULOS => ".$logdate;
		$logtext = $logtext.PHP_EOL.".\t USER REF: ".$logdocu;
		$logtext = $logtext.PHP_EOL.$datos;
		
		global $filename;
		global $log;
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

            }
        } // FIN FUNCTION function ayear()

          require '../Gcb.Artic/plantilla_news.php';

  /* Creado por Juan Manuel Barros Pazos 2020/21 */

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////

?>
  
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - About</title>

  <?php require 'Inc_Header_Nav_Head.php'; 
  
  /* Creado por Juan Manuel Barros Pazos 2020/21 */

  ?>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">

      <?php
          require '../Gcb.Artic/'.$_SESSION['plantillanews'];
      ?>

  </div> <!-- Fin container -->
</section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

</body>

</html>
