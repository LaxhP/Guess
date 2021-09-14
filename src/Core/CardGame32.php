<?php

namespace App\Core;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32
{
const ORDER_COLOR=['trèfle'=>4,'coeur'=>3,'pique'=>2,'carreau'=>1];
const ORDER_NAME=['as'=>8, 'roi'=>7, 'dame'=>6, 'valet'=>5,'10'=>4, '9'=>3, '8'=>2, '7'=>1];

  /**
   * @var $cards array a array of Cards
   */
  private $cards;

  /**
   * Guess constructor.
   * @param array $cards
   */
  public function __construct(array $cards)
  {
    $this->cards = $cards;
  }



  /**
   * Brasse le jeu de cartes
   */
  public function shuffle()
  {
    return shuffle($this->cards);

  }

  /** définir une relation d'ordre entre instance de Card.
   * à valeur égale (name) c'est l'ordre de la couleur qui prime
   * coeur > carreau > pique > trèfle
   * Attention : si AS de Coeur est plus fort que AS de Trèfle,
   * 2 de Coeur sera cependant plus faible que 3 de Trèfle
   *
   *  Remarque : cette méthode n'est pas de portée d'instance (static)
   *
   * @see https://www.php.net/manual/fr/function.usort.php
   *
   * @param $c1 Card
   * @param $c2 Card
   * @return int
   * <ul>
   *  <li> zéro si $c1 et $c2 sont considérés comme égaux </li>
   *  <li> -1 si $c1 est considéré inférieur à $c2</li>
   * <li> +1 si $c1 est considéré supérieur à $c2</li>
   * </ul>
   *
   */
  public static function compare(Card $c1, Card $c2) : int
  {

    $c1Name = strtolower($c1->getName());
    $c2Name = strtolower($c2->getName());
    $c1Color = strtolower($c1->getColor());
    $c2Color = strtolower($c2->getColor());

    
    if ($c1Color===$c2Color){
      if ($c1Name === $c2Name) {
          return 0;
      }
      return (self::ORDER_NAME[$c1Name] > self::ORDER_NAME[$c2Name]) ? +1 : -1;
    }
    else{
      return (self::ORDER_COLOR[$c1Color]>self::ORDER_COLOR[$c2Color])? +1 : -1;
    }

  
  }





  /** retourne une variable avec 32 cartes trié dans l'ordre d'un jeu de carte de base 
   *
   * @return CardGame32
   * 
   *
   */
  public static function factoryCardGame32() : CardGame32 {
     // TODO création d'un jeu de 32 cartes
    $cardGame = new CardGame32([
      new Card('As', 'trèfle'), new Card('roi', 'trèfle'),new Card('dame', 'trèfle'),new Card('valet', 'trèfle'),new Card('10', 'trèfle'),new Card('9', 'trèfle'),new Card('8', 'trèfle'),new Card('7', 'trèfle'),
      new Card('As', 'coeur'),new Card('roi', 'coeur'),new Card('dame', 'coeur'),new Card('valet', 'coeur'),new Card('10', 'coeur'),new Card('9', 'coeur'),new Card('8', 'coeur'),new Card('7', 'coeur'),
      new Card('As', 'pique'),new Card('roi', 'pique'),new Card('dame', 'pique'),new Card('valet', 'pique'),new Card('10', 'pique'),new Card('9', 'pique'),new Card('8', 'pique'),new Card('7', 'pique'),
      new Card('As', 'carreau'),new Card('roi', 'carreau'),new Card('dame', 'carreau'),new Card('valet', 'carreau'),new Card('10', 'carreau'),new Card('9', 'carreau'),new Card('8', 'carreau'),new Card('7', 'carreau')
    ]);
    return $cardGame;
  }

  // TODO manque PHPDoc  
  /** Retourne la carte à la position de $index de la pile de carte
   * 
   *
   * @param  int $index
   * @return Card
   */
  public function getCard($index) : ?Card 
  {
    if($index<=32 & $index>=0){
      return $this->cards[$index];
    }
    return null;
      
  }

  public function __toString()
  {
    return "CardGame32 : ". count($this->cards) . " carte(s)";
  }

}

