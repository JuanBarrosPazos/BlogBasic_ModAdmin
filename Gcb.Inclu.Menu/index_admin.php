<?php


	print("<li>
				<a href='#'>
					<i class='ic ico13'></i><span>EMPLEADOS</span>
				</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutaadmin."Admin_Ver.php' ".$topcat0.">
						<i class='ic ico15b'></i>GESTION ADMIN
					</a>
				</li>
				");


	if ($_SESSION['Nivel'] == 'admin') {
	print("		<li>
					<a href='".$rutaadmin."Admin_Crear.php'>
						<i class='ic ico14b'></i>CREAR ADMIN
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Ver.php'>
						<i class='ic ico19b'></i>GESTION BAJAS
					</a>
				</li>
				<li>
					<a href='".$rutabbdd."export_log.php'>
						<i class='ic ico02b'></i>USERS.LOG
					</a>
				</li>
			</ul>
		</li>
			");
	}else{print("</ul></li>");}

	if ($_SESSION['Nivel'] == 'admin') {
	print("
		<li>
			<a href='#'>
			<i class='ic ico12'></i><span>ARTICULOS</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutaartic."Articulo_Ver.php' ".$topcat1.">
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
				<i class='ic ico19'></i><span>RESPALDO DATOS</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutabbdd."bbdd.php' ".$topcat2.">
						<i class='ic ico20b'></i>TABLAS bbdd
					</a>
				</li>
				<li>
					<a href='".$rutabbdd."export_log.php'>
						<i class='ic ico20b'></i>SYSTEM .log
					</a>
				</li>
			</ul>
		</li>
		");

	}else{	print(" "); }

	print("
		<li>
			<a href='".$rutaindex."Mail_Php/index.php' target='_blank'>
				<i class='ic ico16'></i>NOTIFICACIONES
			</a>
		</li>
	
	<li style='text-align:center;'>
		<a href='#'>
			<form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
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