<?php
require("../../vendor/autoload.php");

use Source\Models\UnidadeModel;

##########################################################
####                                                  ####
##########################################################

$objUsuMod = new UnidadeModel();
//$objUsuMod->idUnidade = '2';
$objUsuMod->nome      = 'Maternidade Regional de Camaçari';
$objUsuMod->endereco  = 'R. Principal - Jardim Limoeiro, Camaçari - BA, 42801-170';
$objUsuMod->cnes      = '3021512';
$objUsuMod->telefone  = '';

//$objUsuMod->save();

//var_dump($objUsuMod->findById('2'));

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();

//var_dump($objUsuMod);
##########################################################
####                                                  ####
##########################################################