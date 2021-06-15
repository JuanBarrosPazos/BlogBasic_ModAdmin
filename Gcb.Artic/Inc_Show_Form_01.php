<?php

	if(isset($_POST['oculto'])){ $defaults = $_POST; }
        
	elseif(isset($_POST['todo'])){
				$defaults = array ('titulo' => isset($_POST['titulo']),
								   'autor' => isset($_POST['autor']),
								   'Orden' => $_POST['Orden'],
								   'dy' => $_POST['dy'],
								   'dm' => $_POST['dm'],
                                   'dd' => $_POST['dd'],
                                );
		} else {
				$defaults = array ('titulo' => '',
								   'autor' => '',
								   'Orden' => '',
								   'dy' => '',
								   'dm' => '',
                                   'dd' => '',
                                );
					}
	
	if ($errors){
        print("<table align='center'>
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
		
		$carpeta = "../Gcb.Config/ayear.php";
		require "../Gcb.Config/ayear.php";
			
		$dm = array (	'' => 'MES TODOS',
						'01' => 'ENERO',
						'02' => 'FEBRERO',
						'03' => 'MARZO',
						'04' => 'ABRIL',
						'05' => 'MAYO',
						'06' => 'JUNIO',
						'07' => 'JULIO',
						'08' => 'AGOSTO',
						'09' => 'SEPTIEMBRE',
						'10' => 'OCTUBRE',
						'11' => 'NOVIEMBRE',
						'12' => 'DICIEMBRE',
										);
		
		$dd = array (	'' => 'DÍA TODOS',
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
										);
											
		$ordenar = array (	'`id` ASC' => 'ID Ascendente',
							'`id` DESC' => 'ID Descendente',
							'`Nombre` ASC' => 'Nombre Ascendente',
							'`Nombre` DESC' => 'Nombre Descendente',
																);

	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th colspan=2 width=100% class='BorderInf BorderSup'>
						".$titulo."
					</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right'>
						<input type='submit' value='FILTRO ARTICULOS' />
						<input type='hidden' name='oculto' value=1 />
					</td>
					<td>
					<div style='float:left'>
					ORDEN&nbsp;
			<select name='Orden'>");
					
		foreach($ordenar as $option => $label){
				print ("<option value='".$option."' ");
				if($option == @$defaults['Orden']){
									print ("selected = 'selected'");}
									print ("> $label </option>");
							}	
	print ("</select>
				</div>
					<div style='float:left'>
					<select name='dy'>");
							
		foreach($dy as $optiondy => $labeldy){
				print ("<option value='".$optiondy."' ");
				if($optiondy == @$defaults['dy']){
                                    print ("selected = 'selected'");}
									print ("> $labeldy </option>");
							}	
																	
	print ("</select>
				</div>
					<div style='float:left'>
					<select name='dm'>");
		
		foreach($dm as $optiondm => $labeldm){
				print ("<option value='".$optiondm."' ");
				if($optiondm == @$defaults['dm']){
									print ("selected = 'selected'");}
									print ("> $labeldm </option>");
							}	
																
	print ("</select>
				</div>
					</td>
    			</tr>

                <tr>
                    <td class='BorderInf'>
                    </td>
                    <td class='BorderInf'>
                        <div style='float:left'>	
                        &nbsp;TITULO&nbsp;
	<input type='text' name='titulo' size=20 maxlenth=10 value='".$defaults['titulo']."' />
                         &nbsp;AUTOR&nbsp;
						</div>
                        <div style='float:left;'>

            <select name='autor'>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gcb_admin` ORDER BY `Apellidos` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
		print ("<option value='".$rows['ref']."' ");
					
		if($rows['ref'] == $defaults['autor']){
									print ("selected = 'selected'");}
									print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
				                }
		            }  

	print ("</select>
				</div>
				    </td>
			    </tr>
		</form>	

        <form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
			<tr>
				<td align='center' class='BorderInf'>
					<input type='submit' value='ARTICULOS TODOS' />
					<input type='hidden' name='todo' value=1 />
				</td>
				<td class='BorderInf'>

			<div style='float:left'>
		<select name='Orden'>");
			foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == @$defaults['Orden']){
									print ("selected = 'selected'");}
									print ("> $label </option>");
								}	
						
	print ("</select>
				</div>
				<div style='float:left'>
		<select name='dy'>");
				
		foreach($dy as $optiondy => $labeldy){
			print ("<option value='".$optiondy."' ");
			if($optiondy == @$defaults['dy']){
                                    print ("selected = 'selected'");}
									print ("> $labeldy </option>");
								}	
														
    print ("</select>
			    </div>
    			<div style='float:left'>
			<select name='dm'>");

		foreach($dm as $optiondm => $labeldm){
			print ("<option value='".$optiondm."' ");
			if($optiondm == @$defaults['dm']){
									print ("selected = 'selected'");}
									print ("> $labeldm </option>");
								}	
														
    print ("</select>
			    </div>
    			<div style='float:left'>
			<select name='dd'>");

		foreach($dd as $optiondd => $labeldd){
			print ("<option value='".$optiondd."' ");
			if($optiondd == @$defaults['dd']){
									print ("selected = 'selected'");}
									print ("> $labeldd </option>");
								}	
														
    print ("</select>
			    </div>
					</td>
				</tr>
			</form>														
		</table>");

		/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>