<?php
require 'misdatos.php';
?>

<!DOCTYPE html>
	
<head>
	
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="content-type" content="text/html" charset="<?php print($meta_type_charset);?>" />
<meta http-equiv="Content-Language" content="<?php print($meta_lang_cotent2);?>">
<meta name="Language" content="<?php print($meta_lang_cotent);?>">
<meta name="description" content="<?php print($meta_desc_cotent);?>" />
<meta name="keywords" content="<?php print($meta_key_cotent);?>" />
<meta name="robots" content="<?php print($meta_robots_cotent);?>" />
<meta name="audience" content="<?php print($meta_audience_cotent);?>" />
<title><?php print($meta_titulo);?></title>
	
<link href="../Gcb.Css/conta.css" rel="stylesheet" type="text/css" />
<link href="../Gcb.Css/menu.css" rel="stylesheet" type="text/css" />
<link href="../Gcb.Css/menuico.css" rel="stylesheet" type="text/css" />

<link href="../Gcb.Img.Sys/favicon.png" type='image/ico' rel='shortcut icon' />

<script type="text/javascript">

 function hora(){
 var fecha = new Date()
 
 var diames = fecha.getDate()

 var daytext = fecha.getDay()
 if (daytext == 0)
 daytext = "Domingo"
 else if (daytext == 1)
 daytext = "Lunes"
 else if (daytext == 2)
 daytext = "Martes"
 else if (daytext == 3)
 daytext = "Miercoles"
 else if (daytext == 4)
 daytext = "Jueves"
 else if (daytext == 5)
 daytext = "Viernes"
 else if (daytext == 6)
 daytext = "Sabado"
 
 var mes = fecha.getMonth() + 1
 
 var ano = fecha.getYear()
 
 if (fecha.getYear() < 2000) 
 ano = 1900 + fecha.getYear()
 else 
 ano = fecha.getYear()
 
 var hora = fecha.getHours()
 var minuto = fecha.getMinutes()
 var segundo = fecha.getSeconds()
 
 if(hora>=12 && hora<=23)
 m="P.M"
 else
 m="A.M"
 
 if (hora < 10) {hora = "0" + hora}
 if (minuto < 10) {minuto = "0" + minuto}
 if (segundo < 10) {segundo = "0" + segundo}
 
 var nowhora = daytext + " " + diames + " / " + mes + " / " + ano + " - " + hora + ":" + minuto + ":" + segundo
 document.getElementById('hora').firstChild.nodeValue = nowhora
 tiempo = setTimeout('hora()',1000)
 }
 </script>
	
</head>
	
<body topmargin="0" onload="hora()">

	
	<div id="Conte">
  <div id="head"> 
  			<span style="font-size:18px">
  							<?php print(strtoupper($head_titulo));?>
            </span>
  	</br>
  			<span style="font-size:12px">
  							<?php print(strtoupper($head_titulo2));?>
            </span>
   </div>

  <div style="clear:both"></div>
   
   <div style="margin-top:2px; text-align:center" id="TitTut">
   
		<font color="#59746A">

					<span id="hora">000000</span>

		</font>
    
	</div>
			  <div style="clear:both"></div>

  

  <div id="Caja2Admin">



