<?php
date_default_timezone_set('America/Sao_Paulo');
require 'Client.php';
require 'Embed.php';


use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

if(isset($_GET['player']) && isset($_GET['reason']) && isset($_GET['reportby'])){
  $webhook = new Client('https://discordapp.com/api/webhooks/398992903998799872/MCCk5ykudNlrmoyVppalJyWinRnadCHrikU8vq1PLljs58NwiMfO3Rub_DsUJQIhE5qM');
  $embed = new Embed();

  $embed->author('Novo Report');
  $embed->color('2865152');
  $embed->thumbnail("http://cravatar.eu/helmavatar/" . $_GET['player'] . "/32.png");
  $embed->footer("Data: " . date('d/m/Y H:i:s'), "https://i.imgur.com/5pw8GG0.png");

  $embed->description('
  **Nome**: ' . $_GET['player'] . '
  **Motivo**: ' . $_GET['reason'] . '
  **Reportado por**: ' . $_GET['reportby'] . '
  ');


  $webhook->embed($embed)->send();
}




?>
