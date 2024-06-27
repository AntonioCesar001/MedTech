<?php
require("../../vendor/autoload.php");
//ini_set("display_errors",1);

use Source\Models\UsuarioModel;



$objUsuMod = new UsuarioModel();

$objUsuMod->findByEmail("abaa@gmail.com");
var_dump($objUsuMod->findByEmail("abaa@gmail.com"));
echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();


//$teste=$objUsuMod->findByEmail("aa@gmail.com");
//var_dump($teste);abaa@gmail.com

