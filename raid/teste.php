<?php


$json = json_decode('

[{"uuid":"blablabla","name":"hq","x":500,"y":64,"z":1000}]


', true);


foreach($json as $entrada){
  echo $entrada['x'];
}


require 'functions.php';

$API = new DustyAPI;

?>
