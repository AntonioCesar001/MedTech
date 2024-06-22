<?php
require("../../vendor/autoload.php");
ini_set("display_errors",1);

use Source\Models\PlantaoModel;

##########################################################
####                                                  ####
##########################################################

$objUsuMod = new PLantaoModel();

$objUsuMod->idEscala = "1";
$objUsuMod->idDepartamento = "1";
$objUsuMod->idUnidade = "1";
$objUsuMod->falta = "1";
$objUsuMod->func_remanejado = "1";
$objUsuMod->dobra = "1";
$objUsuMod->prescritor = "aaaaa";
$objUsuMod->idPlantao = "1";

var_dump($objUsuMod->save());

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();
$teste=$objUsuMod->findByIdScale("1");
var_dump($teste);
