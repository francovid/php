<?php
    require('utiles.php');
    $tipo_header = "";
    if($_GET['archivo']){
        $archivo = base64_decode($_GET['archivo']);
        //$archivo2 = $_GET['archivo'].date("d");
        $a0 = substr($archivo, -2);
        $hoy = date("d");
        if($a0 == $hoy)
        {
            $a1 = substr($archivo, 0, -2);
            $archivo = $a1;
            $tipo_header = content_type($archivo);
        }
    }
    if ($tipo_header != "")
    {
        header('Content-type: '.$tipo_header);
        header('Content-Disposition: inline; filename="'.$archivo.'"');
        readfile($archivo);        
    }
    else
    {
        echo "no se puede visualizar el archivo";
    }
?>