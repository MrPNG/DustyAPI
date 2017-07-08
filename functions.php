<?php
// funções para a API
require 'config.php';

class nameUtils {

  // Função que checa se a UUID inserida é mais velha que 3 minutos
  public function ageCheck($uuid){
    

  }

  // Função que converte nomes para uuids
  public function name2uuid($name){

    return $uuid
  }

  // Função que converte uuids para nomes
  public function uuid2name($uuid){

    return $name;
  }

}


class DustyAPI {

  // Função simples para retornar mensagens de retorno ao receber um request
  public function StatusRetorno($id){
      switch ($id) {
        case 1:
          $status = json_encode(array("status"=>1));
          break;
        case 2:
          $status = json_encode(array("status"=>2));
          break;
        default:
          $status = json_encode(array("status"=>0));
      }

      return $status;
  }


  // Função para checar se o IP da pessoa fazendo o request está na lista de IPs permitidos
  public function checarIP($IP){
    global $config;
    if (in_array($IP, $config["allowedIP"])) {
        return true;
    }
  }

  // Função para banir players. Favor usar -1 para bans permanentes.
  // Não esquecer da data do ban.
  public function banirPlayer($uuid, $punidor, $motivo, $tempo){
    // conexão com MySQL e etc. em prepared statement

    // Retorna "1" em um json para confirmar o ban.
    return $this->StatusRetorno(1);
  }



  // Função para desbanir players
  // Não esquecer da data
  public function desbanirPlayer($uuid){


    return $this->StatusRetorno(1);
  }



  // Função para mutar players.
  public function mutarPlayer($uuid, $punidor, $motivo, $tempo){

    return $this->StatusRetorno(1);
  }



  // Função para desmutar players
  public function desmutarPlayer($uuid){

    return $this->StatusRetorno(1);
  }

  // Função que retorna informações gerais sobre o jogador (ban, mute, etc.)
  public function statusPlayer($uuid){


  }


  // Função que retorna perfil do jogador (kills, deaths, money, etc.)
  public function perfilPlayer($uuid){

  }


  // Função para salvar o perfil de jogadores.
  // Não esquecer de usar foreach, pois será recebido uma array json que pode conter mais de 1 jogadores
  public function salvarPerfil($data){
    // $data é uma array json com uuid do jogador e kills, deaths e etc.

  }


}

?>
