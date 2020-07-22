<?php

	require '../Gcb.Inclu/mydni.php';
	require '../Gcb.Inclu/error_hidden.php';

	global $db_name;

	if ($_SESSION['Nivel'] == 'admin') {	
		
			if ($_SESSION['dni'] == $_SESSION['mydni']) { global $niv;
														  $niv = 'Web Master';
												}else{	global $niv;
														$niv = 'Administrador';
														}
	require '../Gcb.Inclu/Master_Index_Header.php';

print("
<nav class='sidebar-nav'>

<ul>
");
if ($_SESSION['dni'] == $_SESSION['mydni']) {
	
		print("
		
	<li>
		<a href='#'><i class='ic ico22'></i> <span>WEB MASTER</span></a>
			<ul class='nav-flyout'>
		<li><a href='export_bbdd_backups.php'><i class='ic ico22'></i>BACKUP bbdd</a></li>
		<li><a href='#' style='background-color: #343434;padding-bottom: 167px;'></a></li>
				
			</ul>
	</li>
				");
					}else{
	
		print("
		
	<li>
		<a href='#'>	
		<i class='ic ico22'></i>
		</a>
	</li>
				");
	
					} // Fin condicional web master
		print("
	
	<li>
		<a href='#'><i class='ic ico13'></i> <span>USUARIOS</span></a>
			<ul class='nav-flyout'>
				<li><a href='#' style='background-color: #343434;'></a></li>
				<li>
					<a href='../Gcb.Docs/Admin_Ver.php'><i class='ic ico15b'></i>CONSULTAR</a>
				</li>
				<li>
					<a href='../Gcb.Docs/Admin_Crear.php'><i class='ic ico14b'></i>CREAR</a>
				</li>
				<li>
					<a href='../Gcb.Docs/Admin_Modificar_01.php'><i class='ic ico02b'></i>MODIFICAR</a>
				</li>
				<li>
					<a href='../Gcb.Docs/Admin_Borrar_01.php'><i class='ic ico19b'></i>BORRAR</a>
				</li>
				<li><a href='#' style='background-color: #343434;padding-bottom: 56px;'></a></li>
			</ul>
	</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>ARTICULOS</span></a>
			<ul class='nav-flyout'>
				<li><a href='#' style='background-color: #343434;padding-bottom: 31px;'></a></li>
				<li>
					<a href='../Gcb.Artic/Articulo_Ver.php'><i class='ic ico15b'></i>CONSULTAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Crear.php'><i class='ic ico14b'></i>CREAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Modificar_01.php'><i class='ic ico02b'></i>MODIFICAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Borrar_01.php'><i class='ic ico19b'></i>BORRAR</a>
				</li>
				<li><a href='#' style='background-color: #343434;padding-bottom: 56px;'></a></li>
			</ul>
	</li>

	<li>
		<a href='#'><i class='ic ico03'></i> <span>RESPALDO DATOS</span></a>
			<ul class='nav-flyout'>
				<li><a href='#' style='background-color: #343434;padding-bottom: 59px;'></a></li>
				<li>
					<a href='bbdd.php'><i class='ic ico02b'></i>TABLAS bbdd</a>
				</li>
				<li>
					<a href='export_log.php'><i class='ic ico02b'></i>SYSTEM .log</a>
				</li>
				<li><a href='#' style='background-color: #343434;padding-bottom: 52px;'></a></li>
			</ul>
	</li>
	
	<li>
		<a href='../Gcb.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gcb.Docs/mcgexit.php' method='post'>
		<i class='ic ico01'></i>
					<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
					<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL ADMIN
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	} elseif ($_SESSION['Nivel'] == 'plus') {
						
	global $niv;
	$niv = 'Usuario Plus';
		
		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header>
 ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."</br>
 Level: ".$niv.".</br>
 <a href='#'><i class='ic icoh'></i>
		<span style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
	</header>
	
<nav class='sidebar-nav'>

<ul>
	
			<li>
				<a href='../Gcb.Docs/Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>ARTICULOS/span></a>
			<ul class='nav-flyout'>
				<li><a href='#' style='background-color: #343434;'></a></li>
				<li>
					<a href='../Gcb.Artic/Articulo_Ver.php'><i class='ic ico15b'></i>CONSULTAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Crear.php'><i class='ic ico14b'></i>CREAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Modificar_01.php'><i class='ic ico02b'></i>MODIFICAR</a>
				</li>
				<li><a href='#' style='background-color: #343434;padding-bottom: 56px;'></a></li>
			</ul>
	</li>
	
	<li>
		<a href='../Gcb.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gcb.Docs/mcgexit.php' method='post'>
		<i class='ic ico01'></i>
				<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
				<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

	}elseif ($_SESSION['Nivel'] == 'user') {
						
	global $niv;
	$niv = 'Usuario';

		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header>
 ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."</br>
 Level: ".$niv.".</br>
 <a href='#'><i class='ic icoh'></i>
		<span style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
	</header>
	
<nav class='sidebar-nav'>

<ul>
	
			<li>
				<a href='../Gcb.Docs/Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>ARTICULOS/span></a>
			<ul class='nav-flyout'>
				<li><a href='#' style='background-color: #343434;'></a></li>
				<li>
					<a href='../Gcb.Artic/Articulo_Ver.php'><i class='ic ico15b'></i>CONSULTAR</a>
				</li>
				<li>
					<a href='../Gcb.Artic/Articulo_Crear.php'><i class='ic ico14b'></i>CREAR</a>
				</li>
				<li><a href='#' style='background-color: #343434;padding-bottom: 56px;'></a></li>
			</ul>
	</li>

	<li>
		<a href='../Gcb.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gcb.Docs/mcgexit.php' method='post'>
		<i class='ic ico01'></i>
				<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
				<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	}
	
/* Creado por Juan Barros Pazos 2020*/
?>