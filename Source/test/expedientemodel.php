<?php
require("../../vendor/autoload.php");
//ini_set("display_errors",1);
use Source\Models\ExpedienteModel;


##########################################################
####                                                  ####
##########################################################

$objUsuMod = new ExpedienteModel();

$objUsuMod->idExpediente = "1";
$objUsuMod->idEscala = "1";
$objUsuMod->idDepartamento = "1";
$objUsuMod->idUnidade = "1";
$objUsuMod->idFuncionario = "1";
$objUsuMod->idPlantao = "1";

var_dump($objUsuMod->save());
echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();
//$teste=$objUsuMod->findByIdScale("3");
//var_dump($teste);
