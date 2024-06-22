<?php
require("../../vendor/autoload.php");

use Source\Models\FuncionarioModel;

##########################################################
####                                                  ####
##########################################################

$objUsuMod = new FuncionarioModel();
$objUsuMod->idFuncionario = '8';
$objUsuMod->nome          = 'Ryan';
$objUsuMod->especialidade = 'Médico Prescritor';
$objUsuMod->matricula     = '554454541';

// o primeiro 0 do cpf não está sendo inserido
// cpf já corrigido 
$objUsuMod->cpf           = '111.111.111-12';
$objUsuMod->cargaHoraria  = '12';

$objUsuMod->save();

//var_dump($objUsuMod->VerifyByCpf($objUsuMod->data->cpf,$objUsuMod->data->idFuncionario));
//$funcionario = $objUsuMod->findById(3);

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();
//var_dump($objUsuMod);
//var_dump($objUsuMod);
//var_dump($objUsuMod->validateCPF("01010101010"));
##########################################################
####                                                  ####
##########################################################