<?php
require("../../vendor/autoload.php");
ini_set("display_errors",1);

use Source\Models\PlantaoModel;

##########################################################
####                                                  ####
##########################################################

$objUsuMod = new PLantaoModel();

var_dump($objUsuMod->relatorio());

echo $objUsuMod->getMessage();
echo $objUsuMod->getFail();

