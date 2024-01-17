<?php
include '../Model/EstimationModel.php';
include '../Model/ParcoursModel.php';
include '../View/index.php';

$data = selectParticularParcours("parcoursTest");

function dataTransfert($data)
{
    echo("<p id='data' style='display: none'>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p>");
}

dataTransfert($data);



include '../View/EstimationView.html';