<?php
// Os pedidos GET/POST dever茫o ser feitos para esse arquivo
// que s贸 dara um echo bem formatado em JSON de volta.

require 'config.php';
require 'functions.php';
$API = new DustyAPI;
header('Content-Type: application/json');
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip = $_SERVER['REMOTE_ADDR'];
}else{
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

if($API->checarIP($ip){
// Se o IP do cara conferir, continuar

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

if(isset($_GET['type']) && $_GET['type'] == "addcompra"){
  echo $API->addCompra($_GET['action'], $_GET['json'], $_GET['id']);
}





}else{
  echo json_encode(array("status"=>"IP nao autorizado"));
}
?>
