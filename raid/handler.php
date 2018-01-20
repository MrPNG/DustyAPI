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
  echo $API->perfilPlayer($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "getplayerwarp"){
  echo $API->getPlayerWarp($_GET['uuid']);
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

if(isset($_GET['type']) && $_GET['type'] == "salvartime"){
  echo $API->salvarClan($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "team"){
  echo $API->getClan($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "addplayerwarp"){
  echo $API->addWarpPlayer($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "addteamwarp"){
  echo $API->addWarpTeam($_GET['data']);
}


if(isset($_GET['type']) && $_GET['type'] == "delwarpplayer"){
  echo $API->delWarpPlayer($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "delwarpteam"){
  echo $API->delWarpTeam($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "addkit"){
  echo $API->addKit($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "getkit"){
  echo $API->getKits($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "createaccount"){
  echo $API->createAcc($_GET['data']);
}

if(isset($_GET['type']) && $_GET['type'] == "login"){
  echo $API->verifyLogin($_GET['data']);
}







}else{
  echo json_encode(array("status"=>"IP nao autorizado"));
}

 ?>
