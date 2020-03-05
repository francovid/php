<?php
 
// incluimos la libreria ó toolkit nusoap que descargamos previamente
require_once('../../../nusoap/lib/nusoap.php');
require('utiles.php');
$server = new nusoap_server();



$server->configureWSDL('Incofin', 'urn:mi_ws1');

$tipo_ingreso = 1; //cambiar por lo que llegue desde get
// Parametros de entrada
switch ($tipo_ingreso) {
    case 1: //clientes
        $array_entrada = array(
            'rut' => array('name' => 'rut','type' => 'xsd:string'),
            );
        break;
    case 22: //usuarios
        $array_entrada = array ('flg_acc_web' => array('name' => 'flg_acc_web','type' => 'xsd:string'),);
        break;
    case 33: //ejecutivos
        $array_entrada = array ();
        break;
    
    default:
        # code...
        break;
}


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
                                'estado'   => array('name' => 'estado','type' => 'xsd:string')
                                )
);
 
 //print_p($server);exit;

$server->register(   'operacion_bd', // ope_rut_cli del metodo o funcion
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
//     $pre = print_r($datos, true);
//     return array('mensaje' => $pre, 'query' => $query);
// exit;
    require_once('../conexion/conexion.php');
    $solounavez = 0;
    // Recorro el arreglo de datos enviados
    /*if(!is_array( $datos[0])) //si no es array lo convierto, para efectos solo se va a enviar uno.
    {
        $arr1[0] = $datos;
        $datos = $arr1;
    }*/
    $datos = a_array($datos);
    $cueris = 0;
    $exitos = 0;
    $muestra = "";
    $parentesis = array("(", ")", '"', "'", " ");
    foreach ($datos as $key => $value){  
        if ($value['tbl']) 
        {
            $tbl = $value['tbl'];
            $validador = $value['validador'];
            unset($value['tbl']);
            unset($value['validador']);  
        }

        if($value['tipo_formulario'])
        {
            $ar = array();
            $arr = array();
            $codigo_usuario = $value['usuario'];
            unset($value['usuario']);
            $tipo_form = $value['tipo_formulario'];
            unset($value['tipo_formulario']);
            if($value['array_cli_mat_pro'])
            {
                //$acmp = unserialize($value['array_cli_mat_pro']);
                $acmp = explode("),(", $value['array_cli_mat_pro']);

                foreach($acmp as $q => $b)
                {
                    $b = str_replace($parentesis, "", $b);
                    $ar[] = explode(",", $b);
                    

                }
                $acmp = $ar;
                foreach( $acmp as $q => $b)
                {
                    #foreach ($b as $k => $v)
                    #{
                        $arr[$b[0]] = $b[1];
                    #}                    
                }
                ksort($ar);
                
                unset($value['array_cli_mat_pro']);
            }

            $dato_validador = $value[$validador][0];
        $array_cli_mat_pro = $arr;
        }

        if ($tipo_form == 2 && $solounavez == 0)
        {
                    $array_mat_eje = $value['array_mat_eje'];
                    if(!is_array($array_mat_eje))
                    {
                        $arr_1 = explode(",",$array_mat_eje);
                        $array_mat_eje = $arr_1;
                    }
                    unset($value['array_mat_eje']);
                    $solounavez = 1;
        }

        
        // validamos que venga tipo de formulario y que el id venga 
        if($tipo_form > 0 && is_numeric($tipo_form) && $value[$validador][0] > -1) 
        {
            if(!$conn)
            {
                $msg = "error en la conexion";
                $estado = 0;
            }else
            {
                
                $sql_res=pg_query("BEGIN");

                $select = "SELECT *
                FROM $tbl
                WHERE $validador = '".$value[$validador][0]."'";

                $valida_campos = campos_x_tabla($tbl, $conn);

                if($tipo_form == 2){ $mat_ide = $value['mat_eje'][0];} // almacenamos ide para eliminacion
                if($tipo_form == 1){
                    $pro_usu_ins_o = $value['pro_usu_ins'][0];
                    $pro_eje_o = $value['pro_eje'][0];
                    $pro_tip = $value['pro_tip'][0];
                    unset($value['pro_usu_ins']);
                    unset($value['pro_eje']);
                    unset($value['pro_tip']);
                }

                $rs_select = pg_query($select);
                if ($row_sql = pg_fetch_assoc($rs_select))
                {
                    
                    $msg .= " Update. ";
                    
                    $campo = "";
                    $valor = "";
                    $inserta = "UPDATE $tbl SET ";

                    foreach($value as $k => $v)
                    {

                        if($k == "mat_eje")
                        {
                            $v[0] = $row_sql['mat_eje'];
                            $max_ide = $row_sql['mat_eje'];
                        }
                        if($k == "car_usu")
                        {
                            $cargo = strtoupper(trim($v[0]));
                            $select2 = "SELECT cli_cod_par FROM cli_tab_par WHERE cli_cod_tab = 43 AND upper(cli_glo_par) = '$cargo';";
                            $msg .= $select2;
                            $rs_select2 = pg_query($select2);
                            if ($row_sql2 = pg_fetch_assoc($rs_select2)){
                                $cli_cod_par = $row_sql2['cli_cod_par'];
                                
                            }
                            $v[0] = $cli_cod_par;

                        }
                        if(!empty($v[0]) || $v[0] > -1)
                        {
                            if ($k == $validador)
                            {
                                $condicion = $k." = '".$v[0];
                            }
                            if (in_array($k, $valida_campos))
                            {
                                $inserta .= ($v[1] == "int" || $v[0] == "NOW()") ? $k." = ".$v[0]. ", " : $k." = '".$v[0]. "', ";
                            }
                            

                            //$inserta .= $k." = '".$v. "', ";
                        }
                    }
                    $inserta = trim($inserta, ", ");

                    $inserta .= " WHERE ".$condicion."';";

                    $query .= $inserta;
                    $msg .= "<br>".$query;
                }
                else
                {
                    if ($tipo_form == 2)
                    {
                        $select2 = "SELECT MAX(mat_ide) FROM cli_mat_eje; ";
                        //$msg .= $select2;
                        $rs_select2 = pg_query($select2);
                        if ($row_sql2 = pg_fetch_assoc($rs_select2)){
                            $max_ide = $row_sql2['max'];
                           
                        }
                        $max_ide++;
                    }

                    $msg .= " Insert. ";
                    //$msg .= print_r($value, true);
                    $campo = "";
                    $valor = "";
                    //$muestra = print_r($value, true);
                    foreach($value as $k => $v)
                    {
                        if($k == "mat_eje")
                        {
                            $v[0] = $max_ide;
                        }
                        
                        if($k == "car_usu")
                        {
                            $cargo = strtoupper(trim($v[0]));
                            $select2 = "SELECT cli_cod_par FROM cli_tab_par WHERE cli_cod_tab = 43 AND upper(cli_glo_par) = '$cargo';";
                            //$msg .= $select2;
                            $rs_select2 = pg_query($select2);
                            if ($row_sql2 = pg_fetch_assoc($rs_select2)){
                                $cli_cod_par = $row_sql2['cli_cod_par'];
                                
                            }
                            $v[0] = $cli_cod_par;

                        }
                        if(!empty($v[0]) || $v[0] > -1)
                        {
                            if (in_array($k, $valida_campos))
                            {
                                $campo .= $k. ",";
                                // validamos si es integer, caso contrario le ponemos comillas
                                
                                $valor .= ($v[1] == "int" || $v[0] == "NOW()") ? " ".$v[0].", ":"'".$v[0]."', ";
                            }
                        }


                    }
                    $campo = trim($campo, ",");
                    $valor = trim($valor, ", ");

                    $inserta = "INSERT INTO $tbl(
                        ".$campo."
                        ) VALUES (".$valor.");";

                    $query .= $inserta;
                    //$msg .= "<br>".$query;

                    if ($tipo_form == 2 && $inserta)
                    {
                        //AQUI 
                        $querypermisos = "INSERT INTO cli_per_usu
                        SELECT TRIM('".$value['cod_usu'][0]."') as usu_cli, cli_per_pla.basi, finan, legal, manusu, mandefla, manplani, adm_es_apo, 
                            adm_es_apos, adm_ex_info, adm_ed_apo, priesgo, 0 as mod_fec_visit, 
                            0 as solic_prorr, null as mod_doc_oper, null as pcontratos 
                        FROM cli_tab_usu
                        INNER JOIN cli_per_pla
                        ON (".$cli_cod_par." = cli_per_pla.perfil)
                        WHERE cli_tab_usu.cod_usu = '".$value['cod_usu'][0]."';";
                        $kueri = $querypermisos;
                        
                        
                    }
                    
                } //else $row_sql = pg_fetch_assoc($rs_select)
                /********  particular para sistema incofin ********/
                if($tipo_form == 1) // verificar si siempre se actualiza.
                {
                    
                    // actualizar con ultimo campo tabla cli_mat_pro 
                    //insertar nuevo
                    $select2 = "SELECT *
                    FROM cli_mat_pro
                    WHERE pro_rut = '".$value[$validador][0]."' AND flg_del = 0 AND flg_his = 0";
                    
                    $fecha = date("Y-m-d H:i:s");
                    $rs_select2 = pg_query($select2);
                    $filas = pg_numrows($rs_select2); // entrega la catidad de registros de la query
                    //$muestra .= print_r($array_cli_mat_pro, true);
                    if (empty($array_cli_mat_pro)) {$cueris++; $muestra .= "no es array";}

                    //$muestra .= print_r($array_cli_mat_pro, true);
                    if ($filas == 0)
                    {
                        $uno = 0;
                        foreach($array_cli_mat_pro as $k => $v)
                        {
                            $uno++;
                            $query2 = "INSERT INTO cli_mat_pro(pro_rut, pro_tip, item, pro_eje, flg_his, pro_usu_ins, pro_fec_ins, flg_del)
                                    VALUES (".$value[$validador][0].", ".$k.", $uno, '".$v."', 0, '$pro_usu_ins_o', '$fecha', 0);";
                                    $muestra .= $query2;
                            $result = pg_query($query2);
                            $cueris++;
                            if ($result){ $exitos++;}

                        }
                        
                    }
                    else{
                        
                        $selectb = "SELECT MAX(item) FROM cli_mat_pro WHERE pro_rut = $dato_validador ";
                        //$muestra .= $selectb;
                        $rs_selectb = pg_query($selectb);
                        if ($row_sqlb = pg_fetch_assoc($rs_selectb)){
                            $maximo = $row_sqlb['max'];
                        }

                        while ($row = pg_fetch_assoc($rs_select2)) {
                            $original[$row['pro_tip']] = array(  'item'=>$row['item'], 'pro_eje'=>$row['pro_eje'], 'pro_fec_ins'=>$row['pro_fec_ins']);
                          }
                          //$msg .= print_r($array_cli_mat_pro, true);
                          for ($i=1; $i < 5; $i++) { 
                              // hacer comparacion si existe update 
                            //   $msg .= "<br>--";
                              
                            //   $msg .= $array_cli_mat_pro[$i];
                            //   $msg .= "--<br>";
                                if ($original[$i])
                                {
                                    $item = $original[$i]['item'];
                                    $query2 = "UPDATE cli_mat_pro SET usu_act='$codigo_usuario', flg_del=1, pro_fec_del='$fecha' WHERE pro_rut = $dato_validador AND item = $item;";
                                    // $msg .= "<br>padate  ".$query2;
                                    // $msg .= "<br>";
                                    $result = pg_query($query2); 
                                    $cueris++;
                                    if ($result){ $exitos++;}
                                }
                                if ($array_cli_mat_pro[$i] > -1)
                                {
                                    $maximo++;
                                    $query2 = "INSERT INTO cli_mat_pro(pro_rut, pro_tip, item, pro_eje, flg_his, pro_usu_ins, pro_fec_ins, flg_del)
                                    VALUES (".$value[$validador][0].", ".$i.", $maximo, '".$array_cli_mat_pro[$i]."', 0, '$codigo_usuario', '$fecha', 0);";
                                    $result = pg_query($query2);
                                    $cueris++;
                                    if ($result){ $exitos++;}
                                   // $msg .= "<br>no existe:".$i;
                                   // $msg .= "<br>original ".print_r($original, true);
                                    //$msg .= "<br>agregar  ".$query2;
                                }

                          }
                    }


                }elseif ($tipo_form == 2) {
                    // actualizar tabla cli_mat_eje 
                    // sacar el ultimo id para indrementar
                    $select2 = "SELECT MAX(mat_cor) FROM cli_mat_eje; ";
                    //$msg .= $select2;
                    $rs_select2 = pg_query($select2);
                    if ($row_sql2 = pg_fetch_assoc($rs_select2)){
                        $maximo = $row_sql2['max'];
                    }

                    //$msg .= "<br>maximo: ".$maximo."<br>"; 
                    //borrar todos los datos de la tablar con el ide que corresponde
                    $select2 = "DELETE FROM cli_mat_eje
                    WHERE mat_ide = $max_ide;";
                    $query2 = $select2;
                    //$msg .= $select2;
                    //pg_query($select2);
                    $result = pg_query($select2);
                    
                    if ($result){ $cueris++; $exitos++;}
                    //$msg .= "<br>"; 
                    /*$msg .= print_r($array_mat_eje, true);
                    $msg .= "<br>"; */
                    foreach($array_mat_eje as $k1 => $v1)
                    {
                        $maximo++;
                        $query3 = "INSERT INTO cli_mat_eje( mat_cor, mat_ide, mat_eje)
                                    VALUES ($maximo, $max_ide, $v1);";
                        
                        // $msg .= "<br>"; 
                        // $msg .= $query3;     
                        $result = pg_query($query3);
                        $cueris++;
                        if ($result){ $exitos++;}
                        
                    }
                        //$msg .= $query2;



                }
                /********  fin particular para sistema incofin ********/

                    
                    $result = pg_query($query);
                    //$status = pg_result_status($result);
                    //$muestra = $exitos." - ".$cueris;
                    if($result && ($exitos == $cueris))
                    {
                        if ($querypermisos)
                        {
                            $result = pg_query($querypermisos);
                        }
                        $sql_res=pg_query("COMMIT");
                        $msg .= "Ingreso exitoso";
                        $estado = 1;
                        //return true;	
                    }else{
                        $sql_res=pg_query("ROLLBACK");
                        $estado = 0;
                        $msg .= "Error en transacción";

                    }




            //$msg .= "<br>";
            } // else !$conn

        }//$tipo_form > 0 && is_numeric($tipo_form) && $value[$validador][0] > -1
        else
        {
            $msg = "no se puede validar tipo ".$value[$validador][0];
            $estado = 0;
        }

    } 
        
        
//$estado = $_SERVER['HTTPS'];

     return array('mensaje' => $msg, 'estado' => $estado);
    
}
 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>