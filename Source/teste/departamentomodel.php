<?php
require("../../vendor/autoload.php");

use Source\Models\DepartamentoModel;

##########################################################
####                                                  ####
##########################################################

$objUsuMod = new DepartamentoModel();


$objUsuMod->idDepartamento = '5';
$objUsuMod->idUnidade = '3';
$objUsuMod->nome      = 'teste1';

$objUsuMod->numero_leito  = '';
$objUsuMod->alta_prevista = '';
$objUsuMod->leito_ocupado = '';
$objUsuMod->numero_obito  = '';


$objUsuMod->save();

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();

//var_dump($objUsuMod);
##########################################################
####                                                  ####
##########################################################