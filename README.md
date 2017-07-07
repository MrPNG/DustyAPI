# DustyPvP API
----
API para consultas do servidor sobre e para players.


#### Os arquivos:

  - config.php: arquivo para configurar database e IPs que podem ter acesso a API
  - functions.php: arquivo onde tem todas as funções que irão ser executadas
  - handler.php: arquivo no qual todos os requests devem ser feito, no request deve conter todos os parâmetros necessários

#### Parâmetros principais
Parâmetros devem ser mandados junto com o request. Parâmetros ``type`` são **necessários** para o request

| Tipo | Parâmetros ``type`` | Descrição                                                        |
|------|---------------------|------------------------------------------------------------------|
| POST | banir               | Bane uma pessoa                                                  |
| POST | desbanir            | Desbane uma pessoa do servidor                                   |
| POST | mutar               | Muta uma pessoa do servidor                                      |
| POST | desmutar            | Desmuta uma pessoa do servidor                                   |
| GET  | status              | Retorna o status de um jogador, se ele está banido, mutado, etc. |
| GET  | perfil              | Retorna o perfil do jogador. Kills, deaths, money, etc           |
| POST | salvarperfil        | Salva o perfil de um ou vários jogadores                         |

#### Parâmetros complementares
Esses parâmetros devem ser usados somente se o ``type`` requerer eles

| `` type``    | Parâmetros gerais | Descrição                                                 |
|--------------|-------------------|-----------------------------------------------------------|
| Todos        | uuid              | UUID do jogador que é realizado o pedido.                 |
| mutar, banir | punidor           | Quem está punindo a pessoa                                |
| mutar, banir | motivo            | Motivo do mute/ban                                        |
| mutar, banir | tempo             | Tempo do mute/ban                                         |
| salvarperfil | dataperfil        | O perfil do jogador em uma array JSON, pode mandar vários |

#### Lista de Status
Para facilitar a vida, foi criado mensagens de status que serão retornadas ao fazer um request, assim ficará mais fácil no plugin confirmar que a ação foi realizada ou não.
O status retornará em um simples JSON:

`` 
{status: "Sucesso"}
``

| ID | Descrição              |
|----|------------------------|
| 1  | Sucesso                |
| 2  | Jogador não encontrado |

Conforme for necessário, mais códigos de status irão ser criados

-----

Mais em breve
