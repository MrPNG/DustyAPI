<?php
// Os pedidos GET/POST dever茫o ser feitos para esse arquivo
// que s贸 dara um echo bem formatado em JSON de volta.

require 'config.php';
require 'functions.php';
$API = new DustyAPI;
$Utils = new nameUtils;
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

if(isset($_GET['type']) && $_GET['type'] == "name2uuid"){
  echo $Utils->name2uuid($_GET['name']);
}

if(isset($_GET['type']) && $_GET['type'] == "uuid2name"){
  echo $Utils->uuid2name($_GET['uuid']);
}

if(isset($_POST['type']) && $_POST['type'] == "banir"){
  echo $API->banirPlayer($_POST['uuid'], $_POST['motivo'], $_POST['punidor'], $_POST['tempo']);
}

if(isset($_POST['type']) && $_POST['type'] == "desbanir"){
  echo $API->desbanirPlayer($_POST['uuid']);
}

if(isset($_POST['type']) && $_POST['type'] == "mutar"){
  echo $API->mutarPlayer($_POST['uuid'], $_POST['motivo'], $_POST['punidor'], $_POST['tempo']);
}

if(isset($_POST['type']) && $_POST['type'] == "desmutar"){
  echo $API->desmutarPlayer($_POST['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "status"){
  echo $API->statusPlayer($_GET['uuid']);
}

if(isset($_GET['type']) && $_GET['type'] == "perfil"){
  echo $API->perfilPlayer($_GET['uuid']);
}

if(isset($_POST['type']) && $_POST['type'] == "salvarperfil"){
  echo $API->salvarPerfil($_POST['dataperfil']);
}

if(isset($_GET['type']) && $_GET['type'] == "getcompras"){
  echo $API->getCompras($_GET['uuid']);
}

if(isset($_POST['type']) && $_POST['type'] == "salvarclan"){
  echo $API->salvarClan($_POST['dataclan']);
}

if(isset($_GET['type']) && $_GET['type'] == "perfilclan"){
  echo $API->perfilClan($_GET['uuid']);
}

if(isset($_POST['type']) && $_POST['type'] == "addcompra"){
  echo $API->addCompra($_POST['action'], $_POST['json'], $_POST['id']);
}

if(isset($_GET['type']) && $_GET['type'] == "getLeaderboard"){
  echo $API->getLeaderboard($_GET['tipo'], $_GET['max'], $_GET['ordem']);
}





}else{
  echo json_encode(array("status"=>"IP nao autorizado"));
}
?>
