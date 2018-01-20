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

$json = '{"email":"ianszot@outlook.com", "password":123, "uuidusty":123}';

$API = new DustyAPI;
echo $API->verifyLogin($json);



?>
