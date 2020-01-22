<?php
 require_once('../../../nusoap/lib/nusoap.php');
 require('utiles.php');
    foreach ( $_POST as $d => $h ) {
        $$d = $h;
        //echo "_POST : " . $d . "---" . $h . "<br>";
    }
    /* if (!$_POST['tipo_ingreso'])
    {
        $rut = "Lorem ipsum dolor sit.10000606"; 
        $dv = "5"; 
        $raz_soc = "SOCIEDAD PEREZ Y ACUNA LIMITADA"; 
        $ape_pat = ""; 
        $ape_mat = ""; 
        $dir_cli = "BALMACEDA"; 
        $rut_con = ""; 
        $dv_con = ""; 
        $nom_con = ""; 
        $ape_pat_con = ""; 
        $ape_mat_con = ""; 
        $reg_con = ""; 
        $id_comuna = "080712"; 
        $e_mail = "finanzasgymbody@gmail.com"; 
        $web = ""; 
        $tip_cli = "2"; 
        $id_industria = "0"; 
        $act_desa = "1"; 
        $n_empleados = "20"; 
        $his_emp = "La empresa se formo en el año 2011 conformado por don Eduardo Perez perez, don Luis Acuña y Pedro Calderón en primera instancia se creo el gimnasio en la ciudad de laja con un fin social y apoyo a la comunidad, el cual con el paso del tiempo fue (...)"; 
        $aud_emp = ""; 
        $fue_fin = ""; 
        $id_riesgo = "0"; 
        $fec_riesgo = "2019-02-05"; 
        $cod_eje = "0"; 
        $cod_suc = ""; 
        $flg_del = "0"; 
        $lgi_usu_ins = "portiz"; 
        $lgi_usu_upd = ""; 
        $lgi_usu_del = ""; 
        $lgi_fec_ins = "2019-02-05 09:35:05-03"; 
        $lgi_fec_upd = ""; 
        $lgi_fec_del = ""; 
        $rie_ope = ""; 
        $rut_rep_leg = ""; 
        $dv_rep_leg = ""; 
        $nom_rep_leg = ""; 
        $ape_pat_rep = ""; 
        $ape_mat_rep = ""; 
        $sexo = "1"; 
        $flg_his = "0"; 
        $indice = "308049"; 
        $for_ope = "Cliente posee gimnasios en los Ángeles, Nacimiento, Laja y Tome, los cuales poseen su administración acá en Los Ángeles, ellos funcionan con planes mensuales, trimestrales y anuales, dependiendo de la solicitud, las maquinarias que ellos poseen son tra (...)"; 
        $inf_mer = "El mercado del cliente, es toda persona que necesita de sus servicios, ademas de empresas que requieran realizar convenios."; 
        $inst_emp = "Instalaciones oficinas arrendadas"; 
        $cli_est_cli = "1"; 
        $cli_est_ope = ""; 
        $nro_dir = "374"; 
        $nro_ofi = ""; 
        $villa_dir = "LAJA"; 
        $cod_pos = ""; 
        $otr_obs = ""; 
        $rie_com = "0"; 
        $flg_dicom = "0"; 
        $cli_pat_dic = "files/Dicom_76157683_perez y acuña 19-02-19.pdf"; 
        $score_act_datos = ""; 
        $score_min_datos = ""; 
        $dic_pro = "0"; 
        $fec_dic = ""; 
        $cli_asp_pat = ""; 
        $cli_asp_fin = ""; 
        $cli_asp_eco = ""; 
        $cli_asp_com = ""; 
        $cli_otr_asp = ""; 
        $cli_con_clu = ""; 
        $cli_prime = "0"; 
        $cod_forma_contac = "6"; 
        $desc_otros = "CLIENTE CONOCIDO POR EJECUTIVA "; 
        $flg_acc_web = "1"; 
        $cod_eje = "999999";
        $cod_usu = "rlorca_2";
        $mat_eje = "600";
        $nom_eje = "rlorca_3";
        $array_mat_eje = "0,32,140,27,1019,30,129";
        $pro_usu_ins  = "rlorca_6";
        $pro_tip        = "999"; // cambiar
        $pro_eje      = "9999";// cambiar
        //$array_mat_eje = array ( "0", "32", "140","27","1019","30","129");
        $tipo_ingreso = 1; //cambiar por lo que llegue desde get
    } */
    //$tipo_ingreso = 1; cambiar por lo que llegue desde get

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
                        'tipo_formulario' => $tipo_ingreso, 
                        'tbl' => "cli_ant_cli", 
                        'validador' => "rut"
                    );
        break;
        case 2: //usuarios
            $personas = array (
                                'cod_usu' => array($cod_usu, "str"),
                                'pass_usu' => array($pass_usu, "str"),
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
                                'vig_pass' => array($vig_pass, "int"),
                                'array_mat_eje' => $array_mat_eje, // array o separado por comas

                                'tipo_formulario' => $tipo_ingreso, 
                                'tbl' => "cli_tab_usu", 
                                'validador' => "cod_usu"
                                );
            break;
        case 3: //ejecutivos
            $personas = array (
                                'cod_eje' => array($cod_eje, "str"),
                                'nom_eje' => array($nom_eje, "str"),
                                'ema_eje' => array($ema_eje, "str"),
                                'cen_cos' => array($cen_cos, "int"),
                                'cod_reg' => array($cod_reg, "int"),
                                'jef_gru' => array($jef_gru, "str"),
                                'cod_zon' => array($cod_zon, "int"),
                                'tipo_formulario' => $tipo_ingreso, 
                                'tbl' => "cli_eje", 
                                'validador' => "cod_eje"
                                );
            break;
        default:
        # code...
        break;
    }




    $cliente = new nusoap_client('http://192.168.0.92/intraincofin/ws/ws2.php?wsdl');
    
    echo "<pre>";
    // print_r($personas);
    // echo "</pre>";
     
    $ingreso_operacion = array( "ingreso_operacion" => $personas);

    $resultado = $cliente->call('operacion_bd',$ingreso_operacion);
      
    print_r($resultado);
     
?>