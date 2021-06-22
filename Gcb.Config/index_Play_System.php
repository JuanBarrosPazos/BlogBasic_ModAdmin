<?php
  session_start();

            require 'Gcb.Artic/plantilla.php';
            
  /* Creado por Juan Manuel Barros Pazos 2020/21 */

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
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
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
