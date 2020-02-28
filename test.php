<?php
if($_GET['a'])
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
}
?>
