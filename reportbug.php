<?php
date_default_timezone_set('America/Sao_Paulo');
require 'Client.php';
require 'Embed.php';


use \DiscordWebhooks\Client;
use \DiscordWebhooks\Embed;

if(isset($_GET['bug'])){
  $webhook = new Client('https://discordapp.com/api/webhooks/398993487296462848/45vJtAa_oDvMM_SNiEzXtbwOga2Itv8sB7lR9cuCxmidpHTqa94PMWA00iN70zjKuAGQ');
  $embed = new Embed();

  $embed->author('Novo Bug');
  $embed->color('2865152');
  $embed->footer("Data: " . date('d/m/Y H:i:s'), "https://i.imgur.com/5pw8GG0.png");

  $embed->description('
  **Descrição**: ```' . $_GET['bug'] . ' ```
  ');


  $webhook->embed($embed)->send();
}




?>
