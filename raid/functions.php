<?php
require '../config.php';

class nameUtils {


}

class DustyAPI extends nameUtils {

  // função pra checar IP
  public function checarIP($IP){
    global $config;
    if (in_array($IP, $config["allowedIP"])) {
        return true;
    }
  }

  // função para retornar o perfil do jogador da uuidusty
  public function perfilPlayer($uuid){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_perfil` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
      return 2;
    }else{

      return json_encode($result->fetch_assoc());
    }
    $stmt->close();

  }

  // função para salvar o perfil do jogador
  public function salvarPerfil($data){
    // $data é uma array json com uuid do jogador e kills, deaths e etc.
    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    foreach ($data as $player) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_perfil` WHERE `uuid` = ?");
      $stmt->bind_param("s", $player['uuid']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_perfil` (uuid, kills, deaths, killstreak, maxKillStreak, money, clan, x, y, z) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiidsddd", $player['uuid'], $player['kills'], $player['deaths'], $player['killstreak'], $player['maxKillStreak'], $player['money'], $player['clan'], $player['x'], $player['y'], $player['z']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `perfil` SET kills=?, deaths=?, killstreak=?, maxKillStreak=?, money=?, clan=?, x=?, y=?, z=? WHERE `uuid` = ?");
        $stmt->bind_param("iiiidsddds", $player['kills'], $player['deaths'], $player['killStreak'], $player['maxKillStreak'], $player['money'],  $player['clan'], $player['x'], $player['y'], $player['z'], $player['uuid']);
        $stmt->execute();
      }

    }

    if($stmt->affected_rows == 0){
      return 3;
    }else{
      return 1;
    }


  }

  // função para salvar/atualizar árvore
  public function salvarArvore($data){
    // $data é uma array json com as informações da árvore.
    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    foreach ($data as $arvore) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_arvore` WHERE `uuid` = ?");
      $stmt->bind_param("s", $arvore['uuid']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_arvore` (uuid, x, y, z, date) VALUE (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiii", $arvore['uuid'], $arvore['x'], $arvore['y'], $arvore['z'], $arvore['date']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `raid_arvore` SET x=?, y=?, z=?, date=? WHERE `uuid` = ?");
        $stmt->bind_param("iiiis", $arvore['x'], $arvore['y'], $arvore['z'], $arvore['date'], $arvore['uuid']);
        $stmt->execute();
      }

    }

    if($stmt->affected_rows == 0){
      return 3;
    }else{
      return 1;
    }


  }

  // função para criar clans
  public function salvarClan($data){
    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    foreach ($data as $clan) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_teams` WHERE `uuid` = ?");
      $stmt->bind_param("s", $clan['uuid']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_teams` (uuid, nome, tag, membros, leader) VALUE (?, ?, ?, ?, ?)");
        $clan_members = implode(",", $clan['membros']);


        $stmt->bind_param("sssss", $clan['uuid'], $clan['nome'], $clan['tag'], $clan_members, $clan['leader']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `raid_teams` SET nome=?, tag=?, membros=?, leader=? WHERE `uuid` = ?");
        $clan_members = implode(",", $clan['membros']);


        $stmt->bind_param("sssss", $clan['nome'], $clan['tag'], $clan_members, $clan['leader'], $clan['uuid']);
        $stmt->execute();
      }

    }

    if($stmt->affected_rows == 0){
      return 3;
    }else{
      return 1;
    }


  }

  // função para deletar clans
  public function delClan($data){

  }

  // função para pegar as warps de players
  public function getPlayerWarp($uuid){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_players_warps` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    $warps = array();
    while($dados = $result->fetch_assoc()){
      $warps[] = $dados;
    }

    return json_encode($warps);

  }

  // função para pegar as warps de clans
  public function getTeamWarp($uuid){

    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_teams_warps` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    $warps = array();
    while($dados = $result->fetch_assoc()){
      $warps[] = $dados;
    }

    return json_encode($warps);

  }

  // função que retorna informações da árvore especifica
  public function getArvore($uuid){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_arvore` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    $arvore = array();
    while($dados = $result->fetch_assoc()){
      $arvore[] = $dados;
    }

    return json_encode($arvore);

  }

  // função que retorna todas as árvores
  public function getArvores(){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_arvore`");
    $stmt->execute();
    $result = $stmt->get_result();

    $arvore = array();
    while($dados = $result->fetch_assoc()){
      $arvore[] = $dados;
    }

    return json_encode($arvore);

  }

  // função que retorna informações de um clan
  public function getClan($uuid){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_teams` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
      return 2;
    }else{
      $claninfo = $result->fetch_assoc();
      $clanmembers = explode(",", $claninfo['membros']);
      $array = array("uuid" => $claninfo['uuid'],
                      "name" => $claninfo['nome'],
                      "tag" => $claninfo['tag'],
                      "leader" => $claninfo['leader'],
                      "members" => $clanmembers
                    );



      return json_encode($array);
    }

  }


  // função para criar/atualizar warp de players
  public function addWarpPlayer($data){
    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    foreach ($data as $warp) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_players_warps` WHERE `uuid` = ? AND `name` = ?");
      $stmt->bind_param("ss", $warp['uuidusty'], $warp['name']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_players_warps` (uuid, x, y, z, name) VALUE (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $warp['uuid'], $warp['x'], $warp['y'], $warp['z'], $warp['name']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `raid_players_warps` SET x=?, y=?, z=?, name=? WHERE `uuid` = ? AND `name` = ?");
        $stmt->bind_param("iiisss", $warp['x'], $warp['y'], $warp['z'], $warp['name'], $warp['uuid'], $warp['name']);
        $stmt->execute();
      }

    }

    if($stmt->affected_rows == 0){
      return 3;
    }else{
      return 1;
    }


  }

  // função para deletar warps de player
  public function delWarpPlayer($data){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("DELETE FROM `raid_players_warps` WHERE `uuid` = ? AND `name` = ?");
    foreach($data as $warp){
      $stmt->bind_param("ss", $warp['uuid'], $warp['name']);
      $stmt->execute();
    }


  }

  // função para criar/atualizar warp de times
  public function addWarpTeam($data){
    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    foreach ($data as $warp) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_teams_warps` WHERE `uuid` = ? AND `name` = ?");
      $stmt->bind_param("ss", $warp['uuid'], $warp['name']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_teams_warps` (uuid, x, y, z, name) VALUE (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $warp['uuid'], $warp['x'], $warp['y'], $warp['z'], $warp['name']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `raid_teams_warps` SET x=?, y=?, z=?, name=? WHERE `uuid` = ? AND `name` = ?");
        $stmt->bind_param("iiisss", $warp['x'], $warp['y'], $warp['z'], $warp['name'], $warp['uuid'], $warp['name']);
        $stmt->execute();
      }

    }

    if($stmt->affected_rows == 0){
      return 3;
    }else{
      return 1;
    }


  }

  // função pra deletar warp de times
  public function delWarpTeam($data){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("DELETE FROM `raid_teams_warps` WHERE `uuid` = ? AND `name` = ?");
    foreach($data as $warp){
      $stmt->bind_param("ss", $warp['uuid'], $warp['name']);
      $stmt->execute();
    }


  }

  // função pra adicionar um kit
  public function addKit($data){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $json = json_decode($data, true);

    foreach ($json['kits'] as $kit) {
      $stmt = $mysqli->prepare("SELECT * FROM `raid_kits` WHERE `uuid` = ? AND name = ?");
      $stmt->bind_param("ss", $json['uuid'], $kit['name']);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $stmt = $mysqli->prepare("INSERT INTO `raid_kits` (uuid, name, date) VALUE (?, ?, ?)");
        $stmt->bind_param("ssi", $json['uuid'], $kit['name'], $kit['date']);
        $stmt->execute();

      }else{
        $stmt = $mysqli->prepare("UPDATE `raid_kits` SET name=?, date=? WHERE `uuid` = ? AND `name` = ?");
        $stmt->bind_param("siss", $kit['name'], $kit['date'], $json['uuid'], $kit['name']);
        $stmt->execute();

      }

    }

  }

  // função que retorna os kits de um players
  public function getKits($uuid){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT name, date FROM `raid_kits` WHERE `uuid` = ?");
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    $array['uuid'] = $uuid;
    while($kits = $result->fetch_assoc() ){
      $array['kits'][] = $kits;

    }

    return json_encode($array);


  }

  ////// REGISTRO ////////

  // função para criar/atualizar uma conta no server
  public function createAcc($data){

    global $config;
    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);


      foreach ($data as $player) {


          $stmt = $mysqli->prepare("SELECT * FROM `raid_accounts` WHERE `email` = ?");
          $stmt->bind_param("s", $player['email']);
          $stmt->execute();
          $result = $stmt->get_result();
          $unix = time() * 1000;

          if($result->num_rows == 0){
            $stmt = $mysqli->prepare("INSERT INTO `raid_accounts` (uuid, username, email, password, last_update) VALUE (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $player['uuid'], $player['username'], $player['email'], $player['password'], $unix);
            $stmt->execute();

            return '{"status":1}';

          }

      }

      if($stmt->affected_rows == 0){
        return '{"status":0}';
      }


  }

  // função para verificar login
  public function verifyLogin($data){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $data = json_decode($data, true);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_accounts` WHERE `email` = ?");
    $stmt->bind_param("s", $data['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
      $array = array("status" => 0, "uuid" => "123", "password" => "123");
      while($login = $result->fetch_assoc() ){
        $array['password'] = $login['password'];
        $array['uuid'] = $login['uuid'];
        $array['status'] = 1;

        return json_encode($array);
      }
    }else{
      $array['uuid'] = $login['uuid'];
      $array['status'] = 2;

      return json_encode($array);
    }


  }

  // função para verificar se o email já está cadastrado
  public function verifyEmail($email){
    global $config;
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("SELECT * FROM `raid_accounts` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
      return '{"status": false}';
    }else{
      return '{"status": true}';
    }

  }


  public function updateUser($data){
    global $config;
    $unix = time() * 1000;

    $data = json_decode($data, true);
    $mysqli = new mysqli($config['database']['ip'], $config['database']['user'], $config['database']['password'], $config['database']['dbname']);
    $stmt = $mysqli->prepare("UPDATE `raid_accounts` SET uuid=?, username=?, last_update=? WHERE `uuid` = ?");
    $stmt->bind_param("ssis", $data['uuid'], $data['username'], $unix, $data['uuid']);
    $stmt->execute();

    return '{"status": 4}';


  }




}

?>
