<?php
// Os pedidos GET/POST deverão ser feitos para esse arquivo
// que só dara um echo bem formatado em JSON de volta.


require 'functions.php';
$API = new DustyAPI;
header('Content-Type: application/json');

if($API->checarIP($_SERVER['REMOTE_ADDR'])){
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


}else{
  echo json_encode(array("status"=>"IP não autorizado"));
}
?>
