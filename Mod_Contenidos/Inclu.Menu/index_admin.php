<?php


	print("<li>
				<a href='".$rutaadmin."../../Mod_Admin/Admin/Admin_Ver.php''>
					<i class='ic ico13'></i><span>GESTION ADMIN</span>
				</a>
			</li>");

	if ($_SESSION['Nivel'] == 'admin') {
	print("
		<li>
			<a href='#'>
			<i class='ic ico12'></i><span>ARTICULOS</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutaartic."Articulo_Gestionar.php' ".$topcat1.">
						<i class='ic ico20b'></i>GESTIONAR
					</a>
				</li>
				<li>
					<a href='".$rutaartic."Articulo_Crear.php'>
						<i class='ic ico20b'></i>CREAR
					</a>
				</li>
			</ul>
				</li>
				<li>
			<a href='#'>
				<i class='ic ico19'></i><span>BACKUPS</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutabbdd."bbdd.php' ".$topcat2.">
						<i class='ic ico20b'></i>TABLAS bbdd
					</a>
				</li>
				<li>
					<a href='".$rutabbdd."export_log.php'>
						<i class='ic ico02b'></i>USERS .LOG
					</a>
				</li>
				<li>
					<a href='".$rutabbdd."export_log_bajas.php'>
						<i class='ic ico02b'></i>BAJAS .LOG
					</a>
				</li>
			</ul>
		</li>
		");

	}else{	print(" "); }

	print("
		<li>
			<a href='#' target='_blank'>
				<i class='ic ico16'></i>####
			</a>
		</li>
	
	<li style='text-align:center;'>
		<a href='#'>
			<form name='cerrar' action='".$rutaadmin."../../Mod_Admin/Admin/mcgexit.php' method='post'>
		<input type='submit' value='CLOSE SESSION' style='margin-top:-2px; margin-left:6px;' class='botonverde'/>
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

?>