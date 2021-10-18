<?php
  session_start();

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////

  require 'Gcb.Connet/conection.php';
	require 'Gcb.Connet/conect.php';

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
                                           
          $filename = "Gcb.Config/ayear.php";
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
        
          $filename = "Gcb.Config/year.txt";
          $fw2 = fopen($filename, 'w+');
          $date = "".date('Y')."";
          fwrite($fw2, $date);
          fclose($fw2);
          global $dat2;
          $dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
        }
        
        
      function ayear(){
          $filename = "Gcb.Config/year.txt";
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
		$dir = "Gcb.Log";
		
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

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////
            
    // SELECCION DE LA PLANTILLA EN INDEX
    require 'Gcb.Artic/plantilla.php';
    if ($_SESSION['plantilla'] == 'aleaindex'){ 
    global $ad; $ad = date('d');
    global $ad1; $ad1 = array('01','06','11','16','21','26','31');
    global $ad2; $ad2 = array('02','07','12','17','22','27');
    global $ad3; $ad3 = array('03','08','13','18','23','28');
    global $ad4; $ad4 = array('04','09','14','19','24','29');
    global $ad5; $ad5 = array('05','10','15','20','25','30');
    if (in_array($ad, $ad1)){ $_SESSION['plantilla'] = 'Articulo_Ver_index_Card_b.php'; }
    elseif (in_array($ad, $ad1)){ $_SESSION['plantilla'] = 'Articulo_Ver_index.php'; }
    elseif (in_array($ad, $ad2)){ $_SESSION['plantilla'] = 'Articulo_Ver_index_Card.php'; }
    elseif (in_array($ad, $ad3)){ $_SESSION['plantilla'] = 'Articulo_Ver_index_Card_c.php'; }
    elseif (in_array($ad, $ad4)){ $_SESSION['plantilla'] = 'Articulo_Ver_index_Popup.php'; }
    else { $_SESSION['plantilla'] = 'Articulo_Ver_index.php'; }      
  } 
  elseif (!isset($_SESSION['plantilla'])) { $_SESSION['plantilla'] = 'Articulo_Ver_index.php'; }

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////

          
  /* Creado por Juan Manuel Barros Pazos 2020/21 */

                ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
              ////////////////////				  ///////////////////

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Juan Barros Pazos</title>

  <link href="Gcb.Img.Sys/favicon.png" type='image/ico' rel='shortcut icon' />
  
  <link href="Gcb.Css/html.css" rel="stylesheet" type="text/css" />
  <link href="Gcb.Css/conta.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core CSS -->
  <link href="Gcb.Css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="Gcb.Css/agency.min.css" rel="stylesheet">

  <link href="Gcb.Css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
  <div class="container imglogo">
      <a class="navbar-brand js-scroll-trigger" href="index.php">
        <!-- Juan Barros Pazos -->
        <img style='height: 3.2em !important; width: auto;' src="Gcb.Img.Sys/logowm.png" />
      </a>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <!--
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php">Inico</a>
          </li>
        -->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/services.php">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/news.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/contact.php">Contact</a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/portfolio.php">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/team.php">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gcb.Www/clients.php">Clients</a>
          </li>
          -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <!--
        <div class="intro-lead-in">Welcome To Juan Barros Pazos</div>
        -->
        <div class="intro-heading text-uppercase">Web Monkey</div>
      </div>
    </div>
  </header>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">

      <?php
          // DEFINO LA PLANTILLA QUE SE UTILIZA EN LA WEB
            //require 'Gcb.Artic/Articulo_Ver_index.php';
            //require 'Gcb.Artic/Articulo_Ver_index_Popup.php'; 
            require 'Gcb.Artic/'.$_SESSION['plantilla'];
       ?>

    </div> <!-- Fin container -->
  </section>

<!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Juan Barros Pazos 2021</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
          <li class="list-inline-item">
            <a href="http://twitter.com/JuanBarrosPazos" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
            <a href="https://www.facebook.com/juan.barrospazos" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
                <a href="https://github.com/JuanBarrosPazos" target="_blank">
                  <i class="fab fa-github"></i>
                </a>
              </li>
            <li class="list-inline-item">
              <a href="https://www.facebook.com/juan.barrospazos" target="_blank">
                  <i class="fab fa-linkedin-in"></i>
                </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
          <!--
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          -->
            <li class="list-inline-item">
              <a href="Gcb.Docs/access.php" target="_blank">Admin Access</a>
            </li>
         </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="Gcb.Js/jquery.min.js"></script>
  <script src="Gcb.Js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="Gcb.Js/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="Gcb.Js/jqBootstrapValidation.js"></script>
  <script src="Gcb.Js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="Gcb.Js/agency.min.js"></script>

</body>

</html>
