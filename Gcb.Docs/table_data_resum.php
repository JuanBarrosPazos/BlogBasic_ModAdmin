<?php
        global $rf;
		if ($rf == ''){$rf = $_POST['ref'];}
		elseif (isset($_SESSION['refcl'])){$rf = $_SESSION['refcl'];}
        else { }
		global $pass;
        if ($_POST['Pass'] == ''){ $pass = $_POST['Password'];}
        else { $pass = $_POST['Pass'];}

        print(" <tr>
					<td style='text-align:right !important; width:120px;' >NOMBRE </td>
					<td style='text-align:left !important; width:110px;' >".$_POST['Nombre']."</td>
					<td rowspan='5' style='text-align:center !important;'>
						<img style='height:120px; width:90px;' ".$rutaimg."  />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>APELLIDOS</td>
					<td style='text-align:left !important;'>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>TIPOR DOC </td>
					<td style='text-align:left !important;'>".$_POST['doc']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>REF DOC </td>
					<td style='text-align:left !important;'>".$_POST['dni']."-".$_POST['ldni']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>MAIL </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>NIVEL </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Nivel']."</td>
				</tr>");

		if (isset($vertabla)){ }
		elseif (!isset($vertabla)){		
		print("	<tr>
					<td style='text-align:right !important;'>REF USER </td>
					<td style='text-align:left !important;' colspan='2'>".$rf."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>USUARIO </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>PASSWORD </td>
					<td style='text-align:left !important;' colspan='2'>".$pass."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>LOCALIDAD </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>TLF 1 </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>TLF 2 </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Tlf2']."</td>
				</tr>
				");

		if(isset($_POST['lastin'])){
			print("<tr>
						<td style='text-align:right !important;'>LAST IN </td>
						<td style='text-align:left !important;' colspan='2'>".$_POST['lastin']."</td>
					</tr>");
				} else { }
		if(isset($_POST['lastout'])){
			print("<tr>
						<td style='text-align:right !important;'>LAST OUT </td>
						<td style='text-align:left !important;' colspan='2'>".$_POST['lastout']."</td>
					</tr>");
				} else { }
			}
?>