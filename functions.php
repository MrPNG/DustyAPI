<?php
// funções para a API
require 'config.php';

class DustyAPI {

  // Função para checar se o IP da pessoa fazendo o request está na lista de IPs permitidos
  public function checarIP($IP){
    global $config;
    if (in_array($IP, $config["allowedIP"])) {
        return true;
    }
  }



}

?>
