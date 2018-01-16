<?php

/*
$json = json_decode('

{"uuiDusty":"blablabla","warps":[{"name":"Casinha","x":200,"y":64,"z":500},{"name":"Baús","x":8000,"y":120, "z":15000}]}

', true);

foreach($json['warps'] as $entrada){
  echo $entrada['name'];
}
*/

require 'functions.php';

$API = new DustyAPI;
echo $API->getPlayerWarp("teste");

?>
