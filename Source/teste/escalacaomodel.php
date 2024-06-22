<?php
require("../../vendor/autoload.php");
//ini_set("display_errors",1);
use Source\Models\EscalacaoModel;


##########################################################
####                                                  ####
##########################################################

$objUsuMod = new EscalacaoModel();
$teste=$objUsuMod->findByIdScale("2");
var_dump($teste);
