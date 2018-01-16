<?php
require '../config.php';
require 'functions.php';
$API = new DustyAPI;
header('Content-Type: application/json');
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if($API->checarIP($ip)){
// Se o IP do cara conferir, continuar


if(isset($_GET['type']) && $_GET['type'] == "perfil"){
  echo $API->perfilPlayer($_GET['uuidusty']);
}

if(isset($_GET['type']) && $_GET['type'] == "getplayerwarp"){
  echo $API->getPlayerWarp($_GET['uuidusty']);
}

if(isset($_GET['type']) && $_GET['type'] == "getteamwarp"){
  echo $API->getTeamWarp($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "salvarperfil"){
  echo $API->salvarPerfil($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "arvore"){
  echo $API->getArvore($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "arvores"){
  echo $API->getArvores();
}

if(isset($_GET['type']) && $_GET['type'] == "salvararvore"){
  echo $API->salvarArvore($_GET['data']);
}






}else{
  echo json_encode(array("status"=>"IP nao autorizado"));
}

 ?>
