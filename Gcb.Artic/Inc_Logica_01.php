<?php

    if(isset($_POST['todo'])){ show_form();							
                               ver_todo();
                               //info();
                            }

    elseif(isset($_POST['oculto'])){

        if($form_errors = validate_form()){
            show_form($form_errors);
                } else { process_form();
                         //info();
                            }
                            
    } else { show_form(); }

    /* Creado por Juan Manuel Barros Pazos 2020/21 */

?>