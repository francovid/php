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
            'rut' => array('name' => 'rut','type' => 'xsd:string'),/*
            'dv' => array('name' => 'dv','type' => 'xsd:string'),
            'raz_soc' => array('name' => 'raz_soc','type' => 'xsd:string'),
            'ape_pat' => array('name' => 'ape_pat','type' => 'xsd:string'),
            'ape_mat' => array('name' => 'ape_mat','type' => 'xsd:string'),
            'dir_cli' => array('name' => 'dir_cli','type' => 'xsd:string'),
            'rut_con' => array('name' => 'rut_con','type' => 'xsd:string'),
            'dv_con' => array('name' => 'dv_con','type' => 'xsd:string'),
            'nom_con' => array('name' => 'nom_con','type' => 'xsd:string'),
            'ape_pat_con' => array('name' => 'ape_pat_con','type' => 'xsd:string'),
            'ape_mat_con' => array('name' => 'ape_mat_con','type' => 'xsd:string'),
            'reg_con' => array('name' => 'reg_con','type' => 'xsd:string'),
            'id_comuna' => array('name' => 'id_comuna','type' => 'xsd:string'),
            'e_mail' => array('name' => 'e_mail','type' => 'xsd:string'),
            'web' => array('name' => 'web','type' => 'xsd:string'),
            'tip_cli' => array('name' => 'tip_cli','type' => 'xsd:string'),
            'id_industria' => array('name' => 'id_industria','type' => 'xsd:string'),
            'act_desa' => array('name' => 'act_desa','type' => 'xsd:string'),
            'n_empleados' => array('name' => 'n_empleados','type' => 'xsd:string'),
            'his_emp' => array('name' => 'his_emp','type' => 'xsd:string'),
            'aud_emp' => array('name' => 'aud_emp','type' => 'xsd:string'),
            'fue_fin' => array('name' => 'fue_fin','type' => 'xsd:string'),
            'id_riesgo' => array('name' => 'id_riesgo','type' => 'xsd:string'),
            'fec_riesgo' => array('name' => 'fec_riesgo','type' => 'xsd:string'),
            'cod_eje' => array('name' => 'cod_eje','type' => 'xsd:string'),
            'cod_suc' => array('name' => 'cod_suc','type' => 'xsd:string'),
            'flg_del' => array('name' => 'flg_del','type' => 'xsd:string'),
            'lgi_usu_ins' => array('name' => 'lgi_usu_ins','type' => 'xsd:string'),
            'lgi_usu_upd' => array('name' => 'lgi_usu_upd','type' => 'xsd:string'),
            'lgi_usu_del' => array('name' => 'lgi_usu_del','type' => 'xsd:string'),
            'lgi_fec_ins' => array('name' => 'lgi_fec_ins','type' => 'xsd:string'),
            'lgi_fec_upd' => array('name' => 'lgi_fec_upd','type' => 'xsd:string'),
            'lgi_fec_del' => array('name' => 'lgi_fec_del','type' => 'xsd:string'),
            'rie_ope' => array('name' => 'rie_ope','type' => 'xsd:string'),
            'rut_rep_leg' => array('name' => 'rut_rep_leg','type' => 'xsd:string'),
            'dv_rep_leg' => array('name' => 'dv_rep_leg','type' => 'xsd:string'),
            'nom_rep_leg' => array('name' => 'nom_rep_leg','type' => 'xsd:string'),
            'ape_pat_rep' => array('name' => 'ape_pat_rep','type' => 'xsd:string'),
            'ape_mat_rep' => array('name' => 'ape_mat_rep','type' => 'xsd:string'),
            'sexo' => array('name' => 'sexo','type' => 'xsd:string'),
            'flg_his' => array('name' => 'flg_his','type' => 'xsd:string'),
            'indice' => array('name' => 'indice','type' => 'xsd:string'),
            'for_ope' => array('name' => 'for_ope','type' => 'xsd:string'),
            'inf_mer' => array('name' => 'inf_mer','type' => 'xsd:string'),
            'inst_emp' => array('name' => 'inst_emp','type' => 'xsd:string'),
            'cli_est_cli' => array('name' => 'cli_est_cli','type' => 'xsd:string'),
            'cli_est_ope' => array('name' => 'cli_est_ope','type' => 'xsd:string'),
            'nro_dir' => array('name' => 'nro_dir','type' => 'xsd:string'),
            'nro_ofi' => array('name' => 'nro_ofi','type' => 'xsd:string'),
            'villa_dir' => array('name' => 'villa_dir','type' => 'xsd:string'),
            'cod_pos' => array('name' => 'cod_pos','type' => 'xsd:string'),
            'otr_obs' => array('name' => 'otr_obs','type' => 'xsd:string'),
            'rie_com' => array('name' => 'rie_com','type' => 'xsd:string'),
            'flg_dicom' => array('name' => 'flg_dicom','type' => 'xsd:string'),
            'cli_pat_dic' => array('name' => 'cli_pat_dic','type' => 'xsd:string'),
            'score_act_datos' => array('name' => 'score_act_datos','type' => 'xsd:string'),
            'score_min_datos' => array('name' => 'score_min_datos','type' => 'xsd:string'),
            'dic_pro' => array('name' => 'dic_pro','type' => 'xsd:string'),
            'fec_dic' => array('name' => 'fec_dic','type' => 'xsd:string'),
            'cli_asp_pat' => array('name' => 'cli_asp_pat','type' => 'xsd:string'),
            'cli_asp_fin' => array('name' => 'cli_asp_fin','type' => 'xsd:string'),
            'cli_asp_eco' => array('name' => 'cli_asp_eco','type' => 'xsd:string'),
            'cli_asp_com' => array('name' => 'cli_asp_com','type' => 'xsd:string'),
            'cli_otr_asp' => array('name' => 'cli_otr_asp','type' => 'xsd:string'),
            'cli_con_clu' => array('name' => 'cli_con_clu','type' => 'xsd:string'),
            'cli_prime' => array('name' => 'cli_prime','type' => 'xsd:string'),
            'cod_forma_contac' => array('name' => 'cod_forma_contac','type' => 'xsd:string'),
            'desc_otros' => array('name' => 'desc_otros','type' => 'xsd:string'),
            'flg_acc_web' => array('name' => 'flg_acc_web','type' => 'xsd:string'),*/
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
            $codigo_usuario = $value['usuario'];
            unset($value['usuario']);
            $tipo_form = $value['tipo_formulario'];
            unset($value['tipo_formulario']);
            if($value['array_cli_mat_pro'])
            {
                $acmp = unserialize($value['array_cli_mat_pro']);
                foreach( $acmp as $q => $b)
                {
                    #foreach ($b as $k => $v)
                    #{
                        $ar[$b[0]] = $b[1];
                    #}                    
                }
                ksort($ar);
                
                unset($value['array_cli_mat_pro']);
            }

            $dato_validador = $value[$validador][0];
        $array_cli_mat_pro = $ar;
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

        /*switch ($tipo_form) { // valida tipo formulario y asigna tabla y unique
            case 1:
                // $tbl = "cli_ant_cli";
                // $validador = "rut";
                break;
            case 2:
                // $tbl = "cli_tab_usu";
                // $validador = "cod_usu";
                if ($solounavez == 0)
                {

                }
                break;
            case 3:
                // $tbl = "cli_eje";
                // $validador = "cod_eje";
                break;
            
            default:
                $msg = "no se puede validar tipo ";
                break;
        } //switch ($tipo_form)*/
        
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


                        if(!empty($v[0]))
                        {
                            if ($k == $validador)
                            {
                                $condicion = $k." = '".$v[0];
                            }
                            $inserta .= ($v[1] == "int" || $v[0] == "NOW()") ? $k." = ".$v[0]. ", " : $k." = '".$v[0]. "', ";

                            //$inserta .= $k." = '".$v. "', ";
                        }
                    }
                    $inserta = trim($inserta, ", ");

                    $inserta .= " WHERE ".$condicion."';";

                    $query .= $inserta;
                    

                }
                else
                {
                    $msg .= " Insert. ";
                    //$msg .= print_r($value, true);
                    $campo = "";
                    $valor = "";
                    foreach($value as $k => $v)
                    {

                        if(!empty($v[0]))
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
                    $msg .= "<br>".$query;

                    
                } //else $row_sql = pg_fetch_assoc($rs_select)
                /********  particular para sistema incofin ********/
                if($tipo_form == 1) // verificar si siempre se actualiza.
                {
                    

                   
                    // actualizar con ultimo campo tabla cli_mat_pro 
                    //insertar nuevo
                    $select2 = "SELECT *
                    FROM cli_mat_pro
                    WHERE pro_rut = '".$value[$validador][0]."' AND flg_del = 0 AND flg_his = 0";
                    //$msg .= $select2."<br>";
                    $fecha = date("Y-m-d H:i:s");
                    $rs_select2 = pg_query($select2);
                    $filas = pg_numrows($rs_select2); // entrega la catidad de registros de la query
                    $filas = 1;
                    if ($filas == 0)
                    {
                        $uno = 0;
                        foreach($array_cli_mat_pro as $k => $v)
                        {
                            $uno++;
                            $query2 = "INSERT INTO cli_mat_pro(pro_rut, pro_tip, item, pro_eje, flg_his, pro_usu_ins, pro_fec_ins, flg_del)
                                    VALUES (".$value[$validador][0].", ".$k.", $uno, '".$v."', 0, '$pro_usu_ins_o', '$fecha', 0);";
                            pg_query($query2);
                            //$msg .= $query2."<br>";
                        }
                        
                    }
                    else{
                        
                        //$codigo_usuario = 1234;
                        $selectb = "SELECT MAX(item) FROM cli_mat_pro WHERE pro_rut = $dato_validador ";
                        //$msg .= $selectb;
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
                                    pg_query($query2);
                                }                            
                                if ($array_cli_mat_pro[$i] > -1)
                                {
                                    $maximo++;
                                    $query2 = "INSERT INTO cli_mat_pro(pro_rut, pro_tip, item, pro_eje, flg_his, pro_usu_ins, pro_fec_ins, flg_del)
                                    VALUES (".$value[$validador][0].", ".$i.", $maximo, '".$array_cli_mat_pro[$i]."', 0, '$codigo_usuario', '$fecha', 0);";
                                    pg_query($query2);
                                   // $msg .= "<br>no existe:".$i;
                                   // $msg .= "<br>original ".print_r($original, true);
                                    //$msg .= "<br>agregar  ".$query2;
                                }

                          }
                    }
                     /*
                    if ($row_sql2 = pg_fetch_assoc($rs_select2))
                    {
                        //$msg = print_r($row_sql2, true);
                        $pro_rut_o      = $row_sql2['pro_rut'];
                        $item_o         = $row_sql2['item'];
                        $usu_act         = $row_sql2['pro_usu_ins'];

                        if($usu_act != $pro_usu_ins_o)
                        {
                            $query2 = "UPDATE cli_mat_pro SET usu_act='$pro_usu_ins_o', flg_del=1, pro_fec_del='$fecha' WHERE pro_rut = $pro_rut_o AND item = $item_o;";
                            pg_query($query2);
                            //$msg .= "<br>";  
                        }
                    }
                    if(($usu_act != $pro_usu_ins_o)|| !($row_sql2 = pg_fetch_assoc($rs_select2)))
                    {
                        $item_o++;
                        $query3 = "INSERT INTO cli_mat_pro(pro_rut, pro_tip, item, pro_eje, flg_his, pro_usu_ins, pro_fec_ins, flg_del)
                                    VALUES (".$value[$validador][0].", '$pro_tip', $item_o, $pro_eje_o, 0, '$pro_usu_ins_o', '$fecha', 0);";
                        pg_query($query3);
                    }
                    $msg .= $query2;
                    $msg .= "<br>"; 
                    $msg .= $query3;*/

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
                    WHERE mat_ide = $mat_ide;";
                    $query2 = $select2;
                    //$msg .= $select2;
                    pg_query($select2);
                    $rs_select2 = pg_query($select2);
                    //$msg .= "<br>"; 
                    /*$msg .= print_r($array_mat_eje, true);
                    $msg .= "<br>"; */
                    foreach($array_mat_eje as $k1 => $v1)
                    {
                        $maximo++;
                        $query3 = "INSERT INTO cli_mat_eje( mat_cor, mat_ide, mat_eje)
                                    VALUES ($maximo, $mat_ide, $v1);";
                        
                        //$msg .= "<br>"; 
                        //$msg .= $query3;     
                        pg_query($query3);       
                        
                    }
                        //$msg .= $query2;

                }
                /********  fin particular para sistema incofin ********/

                    
                    $result = pg_query($query);
                    //$status = pg_result_status($result);

                    if($result)
                    {
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
        
        


     return array('mensaje' => $msg, 'estado' => $estado);
    
}
 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>