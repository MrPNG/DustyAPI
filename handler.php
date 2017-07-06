<?php
// Os pedidos GET/POST deverão ser feitos para esse arquivo
// que só dara um echo bem formatado em JSON de volta.


require 'functions.php';
$API = new DustyAPI;
header('Content-Type: application/json');

if($API->checarIP($_SERVER['REMOTE_ADDR'])){
// Se o IP do cara conferir, continuar

/*
Exemplo

if(isset($_POST['type']) && $_POST['type'] == "banir"){
  $API->banir($_POST['banido'], $_POST['duracao'], $_POST['banidor']);
  echo json_encode(array("status"=>"Sucesso"));
}

if(isset($_POST['type']) && $_POST['type'] == "status"){
 echo $API->status($_POST['uuid']);
}

*/

}else{
  echo json_encode(array("status"=>"IP não autorizado"));
}
?>
