<?php

/*
$json = json_decode('

{"uuiDusty":"blablabla","kits":[{"name":"pvp","date":1515803586534},{"name":"starter","date":1515803125534}]}


', true);


foreach($json['kits'] as $entrada){
  echo $entrada['name'];
  echo $json['uuiDusty'];
}
*/

require 'functions.php';

$API = new DustyAPI;
if($API->verifyEmail("ianszot@outlook.coma") == true){
  echo "a";
}



?>
