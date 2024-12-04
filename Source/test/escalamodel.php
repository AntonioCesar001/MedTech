<?php
require("../../vendor/autoload.php");

use Source\Models\EscalaModel;

##########################################################
####                                                  ####
##########################################################


$objUsuMod = new EscalaModel();
//$objUsuMod->idEscala = '4';
$objUsuMod->idDepartamento = '2';
$objUsuMod->idUnidade = '1';
$objUsuMod->turno      = 'teste';

//Erro na inserção da data , ela ta achando que é inteiro e ta gerando erro
$objUsuMod->data_escala  = '2022-01-01';


$objUsuMod->save();

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();


//var_dump($objUsuMod);
##########################################################
####                                                  ####
##########################################################