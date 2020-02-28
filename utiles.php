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

function campos_x_tabla($tbl, $con)
{
    $retorno = array();
    $select = "SELECT DISTINCT  
                    a.attname as nombre_columna
                FROM pg_attribute a 
                JOIN pg_class pgc ON pgc.oid = a.attrelid

                WHERE a.attnum > 0 AND pgc.oid = a.attrelid
                AND pg_table_is_visible(pgc.oid)
                AND NOT a.attisdropped
                AND pgc.relname = '".$tbl."'";

    $rs_select = pg_query($select);
    while ($row = pg_fetch_assoc($rs_select)) {
        $retorno[] =  $row['nombre_columna'];
      }
    if (count($retorno) > 0)
    {
        return $retorno;
    }
    else
    {
        return false;
    }
    
}

function content_type($valor)
{
    //recibe el nombre del archivo, separa la extencion y entrega el content-type, para ser mostrado
    $separador = explode(".", $valor);
    $largo = count($separador);
    $largo--;
    $extencion = $separador[$largo];

    $array_tipos = array (
                        "doc"   => "application/msword",
                        "pdf"   => "application/pdf",
                        "jpeg"  => "image/jpeg",
                        "jpg"   => "image/jpeg",
                        "xlsx"  => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        "docx"  => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                        "xls"   => "application/vnd.ms-excel",
                        "gif"   => "image/gif"
                    );
    $retorno = "";
    
    if (array_key_exists($extencion, $array_tipos)) {
        $retorno = $array_tipos[$extencion];
    }

return $retorno;
}


?>