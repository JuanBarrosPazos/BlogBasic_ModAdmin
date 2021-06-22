<?php

	global $refart;
	
	print ("
	<li class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' src='".$rut."Gcb.Img.Art/".$rowb['myimg']."' alt=''>
			</div>
			<div class='timeline-panel'>
				<div class='timeline-heading'>
					<h6>".$rowb['datein']."</h6>
					<h5>".$rowb['tit']."</h5>
				</div>
				<div class='timeline-body'>
					<p class='text-muted'>".$conte."</p>
				</div>
		<div id=\"".$refart."\"></div>
			</div>
		</li> <!-- Final Li contenedor -->
		");
		$estiloin = 1 - $estiloin;	

?>