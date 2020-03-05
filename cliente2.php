<?php
Header('Content-type: text/xml;  charset=utf-8'); 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('../../../nusoap/lib/nusoap.php'); //qa
//require_once('../../nusoap/lib/nusoap.php'); //prod
require('utiles.php');

$rut = NULL;$dv = NULL;$raz_soc = NULL;$ape_pat = NULL;$ape_mat = NULL;$dir_cli = NULL;$rut_con = NULL;$dv_con = NULL;$nom_con = NULL;$ape_pat_con = NULL;$ape_mat_con = NULL;
$reg_con = NULL;$id_comuna = NULL;$e_mail = NULL;$web = NULL;$tip_cli = NULL;$id_industria = NULL;$act_desa = NULL;$n_empleados = NULL;$his_emp = NULL;$aud_emp = NULL;$fue_fin = NULL;
$id_riesgo = NULL;$fec_riesgo = NULL;$cod_eje = NULL;$cod_suc = NULL;$flg_del = NULL;$lgi_usu_ins = NULL; $lgi_usu_upd = NULL;$lgi_usu_del = NULL;$lgi_fec_ins = NULL;$lgi_fec_upd = NULL;
$lgi_fec_del = NULL;$rie_ope = NULL;$rut_rep_leg = NULL;$dv_rep_leg = NULL;$nom_rep_leg = NULL;$ape_pat_rep = NULL;$ape_mat_rep = NULL;$sexo = NULL;$flg_his = NULL;$indice = NULL;$for_ope = NULL;
$inf_mer = NULL;$inst_emp = NULL;$cli_est_cli = NULL;$cli_est_ope = NULL;$nro_dir = NULL;$nro_ofi = NULL;$villa_dir = NULL;$cod_pos = NULL;$otr_obs = NULL;$rie_com = NULL;$flg_dicom = NULL;
$cli_pat_dic = NULL;$score_act_datos = NULL;$score_min_datos = NULL;$dic_pro = NULL;$fec_dic = NULL;$cli_asp_pat = NULL;$cli_asp_fin = NULL;$cli_asp_eco = NULL;$cli_asp_com = NULL;
$cli_otr_asp = NULL;$cli_con_clu = NULL;$cli_prime = NULL;$cod_forma_contac = NULL;$desc_otros = NULL;$flg_acc_web = NULL;$pro_usu_ins = NULL;$pro_tip = NULL;$pro_eje = NULL;$array_mat_pro = NULL;
$tipo_ingreso = NULL;$lgi_usu_ins = NULL;
 if($_POST){
    foreach ( $_POST as $d => $h ) {
        $$d = trim($h);
        //echo "_POST : " . $d . "---" . $h . "<br>";
    }
     /*if (!$_POST['tipo_ingreso'])
    {
        $rut = 20388273; $dv = "4"; $raz_soc = "cliente"; $ape_pat = "de"; $ape_mat = "PRUEBA";
        $dir_cli = "PASAJE 123"; $id_comuna = "130384"; $e_mail = 'CLIENTE@PRUEBA.CL'; $web = 'WWW.CLIENTEPRUEBA.CL';
        $tip_cli=1; $act_desa=11101; $n_empleados=60; $his_emp="SIN HISTORIAL"; $cod_eje=118;
        $lgi_usu_ins="PSEGURA"; $inst_emp="PROPIA"; $cli_est_cli=1; $otr_obs="OK"; $cod_forma_contac=1;
        $flg_acc_web=0;
        //$array_mat_pro = 'a:4:{i:0;a:2:{i:0;s:1:"4";i:1;s:1:"0";}i:1;a:2:{i:0;s:1:"3";i:1;s:4:"1011";}i:2;a:2:{i:0;s:1:"2";i:1;s:4:"1002";}i:3;a:2:{i:0;s:1:"1";i:1;s:4:"1011";}}';
        $array_mat_pro = 'a:2:{i:0;a:2:{i:0;s:1:"4";i:1;s:1:"0";}i:1;a:2:{i:0;s:1:"1";i:1;s:4:"1011";}}';

        //$array_mat_eje = array ( "0", "32", "140","27","1019","30","129");

        //
        $tipo_ingreso = 1; //cambiar por lo que llegue desde get
    } */

    //$no_serial = array (array("4", "0") , array("1", "1011"));

    //print_p($no_serial);

    if($tipo_ingreso == 2 && $array_mat_eje <= -1)
    {
        $array_mat_eje = $mat_eje;
    }
    if($tipo_ingreso == 1 && $array_mat_pro <= -1)
    {
        $array_mat_pro = $cli_mat_pro;
    }
    //print_p(serialize($no_serial));exit;

}
else{ $tipo_ingreso = 1;}
    switch ($tipo_ingreso) {
        case 1: //clientes
            $personas =  array('rut' => array($rut, "int"), // replica en cli_mat_pro pro_rut
                        'dv' => array($dv, "str"),
                        'raz_soc' => array($raz_soc, "str"),
                        'ape_pat' => array($ape_pat, "str"),
                        'ape_mat' => array($ape_mat, "str"),
                        'dir_cli' => array($dir_cli, "str"),
                        'rut_con' => array($rut_con, "int"),
                        'dv_con' => array($dv_con, "str"),
                        'nom_con' => array($nom_con, "str"),
                        'ape_pat_con' => array($ape_pat_con, "str"),
                        'ape_mat_con' => array($ape_mat_con, "str"),
                        'reg_con' => array($reg_con, "str"),
                        'id_comuna' => array($id_comuna, "str"),
                        'e_mail' => array($e_mail, "str"),
                        'web' => array($web, "str"),
                        'tip_cli' => array($tip_cli, "str"),
                        'id_industria' => array($id_industria, "int"),
                        'act_desa' => array($act_desa, "int"),
                        'n_empleados' => array($n_empleados, "int"),
                        'his_emp' => array($his_emp, "str"),
                        'aud_emp' => array($aud_emp, "str"),
                        'fue_fin' => array($fue_fin, "str"),
                        'id_riesgo' => array($id_riesgo, "int"),
                        'fec_riesgo' => array($fec_riesgo, "date"),
                        'cod_eje' => array($cod_eje, "int"),
                        'cod_suc' => array($cod_suc, "int"),
                        'flg_del' => array($flg_del, "int"),
                        'lgi_usu_ins' => array($lgi_usu_ins, "str"), // replica en cli_mat_pro pro_usu_ins
                        'lgi_usu_upd' => array($lgi_usu_upd, "str"),
                        'lgi_usu_del' => array($lgi_usu_del, "str"),
                        'lgi_fec_ins' => array($lgi_fec_ins, "date"),
                        'lgi_fec_upd' => array($lgi_fec_upd, "date"),
                        'lgi_fec_del' => array($lgi_fec_del, "date"),
                        'rie_ope' => array($rie_ope, "str"),
                        'rut_rep_leg' => array($rut_rep_leg, "int"),
                        'dv_rep_leg' => array($dv_rep_leg, "str"),
                        'nom_rep_leg' => array($nom_rep_leg, "str"),
                        'ape_pat_rep' => array($ape_pat_rep, "str"),
                        'ape_mat_rep' => array($ape_mat_rep, "str"),
                        'sexo' => array($sexo, "int"),
                        'flg_his' => array($flg_his, "int"),
                        'indice' => array($indice, "int"),
                        'for_ope' => array($for_ope, "str"),
                        'inf_mer' => array($inf_mer, "str"),
                        'inst_emp' => array($inst_emp, "str"),
                        'cli_est_cli' => array($cli_est_cli, "int"),
                        'cli_est_ope' => array($cli_est_ope, "int"),
                        'nro_dir' => array($nro_dir, "str"),
                        'nro_ofi' => array($nro_ofi, "str"),
                        'villa_dir' => array($villa_dir, "str"),
                        'cod_pos' => array($cod_pos, "str"),
                        'otr_obs' => array($otr_obs, "str"),
                        'rie_com' => array($rie_com, "int"),
                        'flg_dicom' => array($flg_dicom, "int"),
                        'cli_pat_dic' => array($cli_pat_dic, "str"),
                        'score_act_datos' => array($score_act_datos, "int"),
                        'score_min_datos' => array($score_min_datos, "int"),
                        'dic_pro' => array($dic_pro, "int"),
                        'fec_dic' => array($fec_dic, "date"),
                        'cli_asp_pat' => array($cli_asp_pat, "str"),
                        'cli_asp_fin' => array($cli_asp_fin, "str"),
                        'cli_asp_eco' => array($cli_asp_eco, "str"),
                        'cli_asp_com' => array($cli_asp_com, "str"),
                        'cli_otr_asp' => array($cli_otr_asp, "str"),
                        'cli_con_clu' => array($cli_con_clu, "str"),
                        'cli_prime' => array($cli_prime, "int"),
                        'cod_forma_contac' => array($cod_forma_contac, "int"),
                        'desc_otros' => array($desc_otros, "str"),
                        'flg_acc_web' => array($flg_acc_web, "int"),
                        'pro_usu_ins' => array($pro_usu_ins, "str"),
                        'pro_tip' => array($pro_tip, "str"),
                        'pro_eje' => array($pro_eje, "str"),
                        'array_cli_mat_pro' => $array_mat_pro, // $array_mat_pro = array (0 => array("tipo", "ejecutivo"))
                        'tipo_formulario' => $tipo_ingreso, 
                        'tbl' => "cli_ant_cli", 
                        'validador' => "rut",
                        'usuario' => $lgi_usu_ins
                    );
        break;
        case 2: //usuarios
            $cod_eje = 0;
            if ($cod_suc < 0){ $cod_suc = 1;}
            
            $personas = array (
                                'cod_usu' => array(strtolower($cod_usu), "str"),
                                'pass_usu' => array(strtolower($pass_usu), "str"),
                                'nom_usu' => array($nom_usu, "str"),
                                'ult_lgi' => array($ult_lgi, "date"),
                                'ip_lgi' => array($ip_lgi, "str"),
                                'can_lgi' => array($can_lgi, "int"),
                                'flg_not' => array($flg_not, "int"),
                                'mat_eje' => array($mat_eje, "int"),
                                'pass_exp' => array($pass_exp, "int"),
                                'flg_mat' => array($flg_mat, "int"),
                                'cod_suc' => array($cod_suc, "int"),
                                'flg_acc' => array($flg_acc, "int"),
                                'mat_acc' => array($mat_acc, "int"),
                                'flg_rie' => array($flg_rie, "int"),
                                'flg_contr' => array($flg_contr, "int"),
                                'car_usu' => array($car_usu, "int"),
                                'can_lgi_err' => array($can_lgi_err, "int"),
                                'fec_mod_eje' => array($fec_mod_eje, "date"),
                                'usu_mod_eje' => array($usu_mod_eje, "str"),
                                'firma' => array($firma, "str"),
                                'correo' => array($correo, "str"),
                                'cod_eje' => array($cod_eje, "int"),
                                'vig_pass' => array(10000, "int"),
                                'array_mat_eje' => $array_mat_eje, // array o separado por comas
                                'tipo_formulario' => $tipo_ingreso, 
                                'tbl' => "cli_tab_usu", 
                                'validador' => "cod_usu",
                                'usuario' => $usuario
                                );
            break;
        case 3: //ejecutivos
            $personas = array (
                                'cod_eje' => array($cod_eje, "str"),
                                'nom_eje' => array($nom_eje, "str"),
                                'ema_eje' => array($ema_eje, "str"),
                                'cen_cos' => array($cen_cos, "int"),
                                //'cod_reg' => array($cod_reg, "int"),
                                'jef_gru' => array($jef_gru, "str"),
                                'cod_zon' => array($cod_zon, "int"),
                                'tipo_formulario' => $tipo_ingreso, 
                                'tbl' => "cli_eje", 
                                'validador' => "cod_eje",
                                'usuario' => $usuario
                                );
            break;
        default:
        $personas = array (
                            'tipo_formulario' => $tipo_ingreso
                            );
        break;
    }



    $servidorWeb = $_SERVER['SERVER_NAME'];
    $cliente = new nusoap_client('http://'.$servidorWeb.'/intraincofin_qa/ws/ws2.php?wsdl');//quitar _qa para otros server
    
    //echo "<pre>";
    // print_r($personas);
    // echo "</pre>";
     
    $ingreso_operacion = array( "ingreso_operacion" => $personas);

    $resultado = $cliente->call('operacion_bd',$ingreso_operacion);
    //$cliente->debug();
    //echo '<pre>' . htmlspecialchars($cliente->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2>';
//$cliente->response;


    //print_r($resultado);exit;

    function array_to_xml( $data, &$xml_data ) {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key; //dealing with <0/>..<n/> issues
                }
                $subnode = $xml_data->addChild($key);
                array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
         }
    }
    
    // initializing or creating array
    $data = array('total_stud' => 500);
    
    // creating object of SimpleXMLElement
    /*$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');*/
    $xml_data = new SimpleXMLElement('text.xml', 0, true);
    
    // function call to convert array to xml
    if(!is_array($resultado)){
        $varible = $tipo_ingreso;
        $resultado = array('mensaje' =>'nada para mostrar'.$varible);
    }
    array_to_xml($resultado,$xml_data);
    echo $xml_data->asXML();

?>