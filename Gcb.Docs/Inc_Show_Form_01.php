<?php

if(isset($_POST['oculto'])){
    $defaults = $_POST;
    }
    elseif(isset($_POST['todo'])){
        $defaults = $_POST;
        } else {
                $defaults = array (	'Nombre' => '',
                                    'Apellidos' => '',
                                    'Orden' => isset($ordenar));
                                                        }

if ($errors){
    print("	<table align='center'>
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
    
$ordenar = array (	'`id` ASC' => 'ID Ascendente',
                    '`id` DESC' => 'ID Descendente',
                    '`Nombre` ASC' => 'Nombre Ascendente',
                    '`Nombre` DESC' => 'Nombre Descendente',
                    '`Apellidos` ASC' => 'Apellidos Ascenedente',
                    '`Apellidos` DESC' => 'Apellidos Descendente',
                    '`Email` ASC' => 'Dirección de Email Ascendente',
                    '`Email` DESC' => 'Dirección de Email Descendente',
                    '`Tlf1` ASC' => 'Teléfono 1 Ascendente',
                    '`Tlf1` DESC' => 'Teléfono 1 Descendente',
                    '`Tlf2` ASC' => 'Teléfono 2 Ascendente',
                    '`Tlf2` DESC' => 'Teléfono 2 Descendente',
                                                            );

if (($_SESSION['Nivel'] == 'admin')){ 

print(" <table align='center' style=\"border:0px;margin-top:4px\">
            <tr>
                <th colspan=3 width=100%>
                        ".$titulo."
                </th>
            </tr>
            
    <form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
                    
            <tr>
                <td align='right'>
                    <input type='submit' value='USER CONSULTA' />
                    <input type='hidden' name='oculto' value=1 />
                </td>
                <td>	
                    Nombre:
                </td>
                <td>
        <input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."' />
                </td>
            </tr>

            <tr>
                <td>
                </td>
                <td>	
                    Apellido:
                </td>
                <td>
<input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."' />
                </td>
            </tr>
    </form>	
            
    <form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
            <tr>
                <td align='right'>
                    <input type='submit' value='USER TODOS' />
                    <input type='hidden' name='todo' value=1 />
                </td>
                <td>	
                    Ordenar Por:
                </td>
                <td>
                    <select name='Orden'>");
                    
            foreach($ordenar as $option => $label){
                
                print ("<option value='".$option."' ");
                
                if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
                                                print ("> $label </option>");
                                            }	
        print ("	</select>
                        </td>
                    </tr>
            </form>														
        </table>");
                }	// CONDICIONAL NIVEL ADMIN

?>