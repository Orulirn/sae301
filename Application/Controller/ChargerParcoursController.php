<?php
header('Content-Type: text/html; charset=utf-8');

include "../Model/ChargerParcoursModel.php";
include "../View/index.php";

//$data = selectParticularParcours("parcoursTest");
$data = selectParticularParcours("GoMacDo");
function dataTransfert($data)
{
    echo ("<p id='data' visibility='hidden' style= 'display :none;'>".json_encode($data, JSON_UNESCAPED_UNICODE)."</p>");
}

dataTransfert($data);
include "../View/ChargerParcours.html";
