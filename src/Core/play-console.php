<?php

require '..\..\vendor\autoload.php';

echo "*** Création d'un jeu de 32 cartes.***\n";
$cardGame = App\Core\CardGame32::factoryCardGame32();

echo " ==== Instanciation du jeu, début de la partie. ==== \n";
$game =  new App\Core\Guess($cardGame, null, false);

$userCardIndex = readline("Entrez une position de carte dans le jeu : ");
if ($userCardIndex<0 || $userCardIndex>36){
  $userCardIndex=0;
}

$userCard = $cardGame->getCard($userCardIndex);

while(!$game->isMatch($userCard)){
  $userCardIndex = readline("Entrez une position de carte dans le jeu : ");
  if ($userCardIndex<0 || $userCardIndex>36){
    $userCardIndex=0;
  }
  $userCard = $cardGame->getCard($userCardIndex);
  echo "Loupé !\n";
}
  echo "Bravo ! \n";


echo " ==== Fin prématurée de la partie ====\n";
echo "*** Terminé ***\n";