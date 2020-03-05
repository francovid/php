<?php
/*if($_GET['a'])
{
    require('utiles.php');
    $a = $_GET['a'];
    $b = base64_encode($a);
    $c = base64_encode($a.date("d"));
    print_p($a);
    print_p($b);
    print_p($c);


}else
{
    echo "ingresa a";
}*/
?>
<form action="cliente2.php" class="testing" method="post">
<input type="hidden" name="rut" value="20388273">
<input type="hidden" name="dv" value="4">
<input type="hidden" name="raz_soc" value="SOFIA">
<input type="hidden" name="ape_pat" value="FLORES">
<input type="hidden" name="ape_mat" value="PEREZ">
<input type="hidden" name="dir_cli" value="ESTO VIENE DE UN FORM WEB metodo post">
<input type="hidden" name="id_comuna" value="130384">
<input type="hidden" name="e_mail" value="CORREO@CLIENTE.CL">
<input type="hidden" name="web" value="WWW.PAGINA.CL">
<input type="hidden" name="tip_cli" value="1">
<input type="hidden" name="act_desa" value="11101">
<input type="hidden" name="n_empleados" value="60">
<input type="hidden" name="cli_mat_pro" value="(1,118),(2,118)">
<input type="hidden" name="tipo_ingreso" value="1">
    <button type="submit" >enviar</button>
</form>