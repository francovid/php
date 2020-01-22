<?php
// incluimos la libreria ó toolkit nusoap que descargamos previamente
require_once('../../../nusoap/lib/nusoap.php');
require('utiles.php');
$server = new nusoap_server();
$server->configureWSDL('Incofin', 'urn:mi_ws1');

$array_entrada = array( 'rut' => array('name' => 'rut','type' => 'xsd:string'), );

$server->wsdl->addComplexType(  'ingreso_operacion', 
                                'complexType', 
                                'struct', 
                                'all', 
                                '',
                                $array_entrada
);
// Parametros de Salida
$server->wsdl->addComplexType(  'resultado_operacion', 
                                'complexType', 
                                'struct', 
                                'all', 
                                '',
                                array('mensaje'   => array('name' => 'mensaje','type' => 'xsd:string'),
                                'query'   => array('name' => 'query','type' => 'xsd:string')
                                )
);

$server->register(   'operacion_bd', // metodo o funcion
                    array('ingreso_operacion' => 'tns:ingreso_operacion'), // parametros de entrada
                    array('return' => 'tns:resultado_operacion'), // parametros de salida
                    'urn:mi_ws1', // namespace
                    'urn:hellowsdl2#operacion_bd', // soapaction debe ir asociado al nombre del metodo
                    'rpc', // style
                    'encoded', // use
                    'La siguiente funcion recibe un arreglo, verifica datos recibidos y ejecuta la insercion, eliminacion o modificacion de los datos' // documentation,
                     //$encodingStyle
);

function operacion_bd($datos) {
    require_once('../conexion/conexion.php');
    $solounavez = 0;

    $datos = a_array($datos); // esto lo convierte en array en caso de que no lo sea
    
    foreach ($datos as $key => $value){  
        if ($value['tbl']) 
        {
            $tbl = $value['tbl'];
            $validador = $value['validador'];
            unset($value['tbl']);
            unset($value['validador']);  
        }

        if ($value['tipo_formulario'] == 2 && $solounavez == 0) // **solo para incofin**
        {
                    $array_mat_eje = $value['array_mat_eje'];
                    if(!is_array($array_mat_eje))
                    {
                        $arr_1 = explode(",",$array_mat_eje);
                        $array_mat_eje = $arr_1;
                    }
                    unset($value['array_mat_eje']);
                    $solounavez = 1;
        } // **solo para incofin**
        
        // validamos que venga tipo de formulario y que el id venga 
        if($value['tipo_formulario'] > 0 && is_numeric($value['tipo_formulario']) && $value[$validador][0] > -1) 
        {
            if(!$conn)
            {
                $msg = "error en la conexion";
            }else
            {
                $sql_res=pg_query("BEGIN");

                $select = "SELECT *
                FROM $tbl
                WHERE $validador = '".$value[$validador][0]."'";
                if($value['tipo_formulario'] == 2){ $mat_ide = $value['mat_eje'][0];} // almacenamos ide para eliminacion **solo para incofin**
                if($value['tipo_formulario'] == 1){ // **solo para incofin**
                    $pro_usu_ins_o = $value['pro_usu_ins'][0];
                    $pro_eje_o = $value['pro_eje'][0];
                    $pro_tip = $value['pro_tip'][0];
                    unset($value['pro_usu_ins']);
                    unset($value['pro_eje']);
                    unset($value['pro_tip']);
                } // **solo para incofin**

                $rs_select = pg_query($select);
                if ($row_sql = pg_fetch_assoc($rs_select))
                {
                    $msg .= " Update. ";
                    
                    $campo = "";
                    $valor = "";
                    $inserta = "UPDATE $tbl SET ";

                    foreach($value as $k => $v)
                    {
                        if($k != "tipo_formulario" && $v[0] != "")
                        {
                            if ($k == $validador)
                            {
                                $condicion = $k." = '".$v[0];
                            }
                            $inserta .= ($v[1] == "int" || $v[0] == "NOW()") ? $k." = ".$v[0]. ", " : $k." = '".$v[0]. "', ";
                        }
                    }
                    $inserta = trim($inserta, ", ");
                    $inserta .= " WHERE ".$condicion."';";
                    $query .= $inserta;

                }
                else
                {
                    $msg .= " Insert. ";
                    $campo = "";
                    $valor = "";
                    foreach($value as $k => $v)
                    {
                        if(($k != "tipo_formulario" || $k != "") && $v[0] != "")
                        {
                            $campo .= $k. ",";
                            // validamos si es integer, caso contrario le ponemos comillas
                            $valor .= ($v[1] == "int" || $v[0] == "NOW()") ? " ".$v[0].", ":"'".$v[0]."', ";
                        }
                    }
                    $campo = trim($campo, ",");
                    $valor = trim($valor, ", ");

                    $inserta = "INSERT INTO $tbl(
                        ".$campo."
                        ) VALUES (".$valor.");";

                    $query .= $inserta;

                } //else $row_sql = pg_fetch_assoc($rs_select)
                
                    $result = pg_query($query);
                    //$status = pg_result_status($result);

                    if($result)
                    {
                        $sql_res=pg_query("COMMIT");
                        $msg .= "Ingreso exitoso";
                        //return true;	
                    }else{
                        $sql_res=pg_query("ROLLBACK");

                        $msg .= "Error en transacción";
                    }

            $msg .= "<br>";
            } // else !$conn

        }//$value['tipo_formulario'] > 0 && is_numeric($value['tipo_formulario']) && $value[$validador][0] > -1
        else
        {
            $msg = "no se puede validar tipo ".$value[$validador][0];
        }
    } 
     return array('mensaje' => $msg, 'query' => $query);
}
 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>