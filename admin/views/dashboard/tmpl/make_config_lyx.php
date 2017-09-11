<?php
// link de los parámetros de configuración del manual que estamos documentando
$path = 'D:/www/htdocs/JPruebas/tmp/com_jtsca_j34standard/admin/help/en-GB/j3x';
require "{$path}/config_lyx.php";

header('Content-Type: text/plain'); 
$foo = new Foo; 
$config_lyx = $foo->printConfigs();
file_put_contents("{$path}/config_lyx.tex", $config_lyx);
echo ($config_lyx);
exit;