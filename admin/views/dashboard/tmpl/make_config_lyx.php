<?php
// link de los par�metros de configuraci�n del manual que estamos documentando
$path = 'D:/www/htdocs/JPruebas/tmp/com_jtsca_j34standard/admin/help/en-GB/j3x';
require "{$path}/config_lyx.php";

header('Content-Type: text/plain'); 
$foo = new Foo; 
$config_lyx = $foo->printConfigs();
file_put_contents("{$path}/config_lyx.tex", $config_lyx);
//$config_lyx = iconv('UTF-8', 'WINDOWS-1252', $config_lyx);
echo ($config_lyx);
exit;