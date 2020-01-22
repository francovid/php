<?
function print_p($valor)
{
    $devuelve = "";
    $devuelve .= "<pre>";
    $devuelve .= '<p style="border-image: initial; border: 1px solid red;">';
    $devuelve .= print_r($valor, TRUE) ;
    $devuelve .= '</p>';
    $devuelve .= "</pre>";
    echo $devuelve;
}


function a_array($valor)
{

    if(!is_array( $valor[0])) //si no es array lo convierto, para efectos solo se va a enviar uno.
    {
        $arr1[0] = $valor;
        $datos = $arr1;
    }
    else{
        $datos = $valor;
    }
    return $datos;
}

?>