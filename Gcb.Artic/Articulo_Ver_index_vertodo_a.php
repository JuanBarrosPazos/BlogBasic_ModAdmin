<?php

	global $db;
	global $db_name;

	global $dyt1;
	$dyt1 = date('Y'); /* */
	global $fil;
	$fil = $dyt1."-%";
	//$fil = $dy1.$dm1.$dd1."%";
	global $vname;
	$vname = "gcb_".$dyt1."_articulos";
	$vname = "`".$vname."`";
	
	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);
	global $row;
	@$row = mysqli_fetch_assoc($q);
	global $num_total_rows;
	@$num_total_rows = mysqli_num_rows($q);

	if(!$q || ($num_total_rows < 1)){
		global $vname;
		$vname = "gcb_".($dyt1-1)."_articulos";
		$vname = "`".$vname."`";
		$result =  "SELECT * FROM $vname ";
		$q = mysqli_query($db, $result);
		$row = mysqli_fetch_assoc($q);
		global $num_total_rows;
		$num_total_rows = mysqli_num_rows($q);
	} else { }

	global $page;

    if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
		global $page;
        $page = $_GET["page"];
    }

    if (!$page) {
		global $page;
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* Noticias: '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname ORDER BY `id` DESC $limit";

	/*
	$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);

?>