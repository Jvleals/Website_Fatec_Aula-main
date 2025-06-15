<?php
$data = [
    "nome_cientifico" => "Cucurbita pepo.",
    "nome_popular" => "Aboboreira",
    "espaco_arvore" => "",
    "classificacao" => "Medicinal/Tóxica",
    "numero_individuos" => "?",
    "estado_fitossanitario" => "",
    "estado_tronco" => "",
    "estado_raizes" => ""
];

header('Content-Type: application/json');
echo json_encode($data);
