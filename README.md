# Guess What

Prise en main de la POO avec PHP

Niveau : Deuxième année de BTS SIO SLAM

## But du jeu

Le jeu se lance dans une console ave le fichier play-console.php . Lorsqu'on execute le fichier, le joueur propose une la position de la carte choisit par le programme aléatoirement jusqu'a que le joueur choisissent la bonne carte.(J'ai commencé plus tard à cause du manque de matériel je n'ai pas pu approfondir le projet). 



## Challenge 1 de prise en main (4h à 8h)

### Les prérequis
J'ai du installer composer dans le fichier initial du projet, puis phpunit. Phpunit permet de faire des test unitaires, on peut donc tester chaque fonction et vérifier si les résultats des fonctions correspondent à nos attentes. On peut aussi tester les fonctions un par un avec le paramètre '--filter', ce qui est très utile pour le débogage.


### Tester le bon fonctionnement de ce petit existant

#### Lancement des tests unitaires
  

Lorsqu'on lancait la commande '.\bin\phpunit' , 8 test unitaires etaient éxécutés dont 4 en échec.

```

There were 4 failures:

1) App\Tests\Core\CardTest::testCompareSameNameNoSameColor
not implemented !

guesswhat/tests/Core/CardTest.php:65
...


```
Mon premier objectif sera de résoudre ces 4 échecs .

## Challenge 2 implémentation des TODOs de `CardTest` 

Ces 4 échecs viennent des fonctions qui se situent la `CardTest`.
J'ai d'abord du modifier la fonction `compare` qui est utilisé pour les tests unitaires. La fonction vérifiait seulement si 2 cartes sont identiques . Je l'ai modifier pour que la fonction compare la couleur et les noms des cartes. Pour cela j'ai d'abord crée 2 tableaux qui indique la position des couleurs et des noms des cartes:

```php
const ORDER_COLOR=['trèfle'=>4,'coeur'=>3,'pique'=>2,'carreau'=>1];
const ORDER_NAME=['as'=>8, 'roi'=>7, 'dame'=>6, 'valet'=>5,'10'=>4, '9'=>3, '8'=>2, '7'=>1];

```
Puis la fonction compare les 2 cartes en fonctions de ces 2 tableaux:

```php
    if ($c1Color===$c2Color){
      if ($c1Name === $c2Name) {
          return 0;
      }
      return (self::ORDER_NAME[$c1Name] > self::ORDER_NAME[$c2Name]) ? +1 : -1;
    }
    else{
      return (self::ORDER_COLOR[$c1Color]>self::ORDER_COLOR[$c2Color])? +1 : -1;
    }
```
Et la fonction renvoie 0, +1 ou -1 en fonctions des résultats.  
Dans la classe `CardTest`, j'ai modifier les différents fonction pour faire des test unitaires qui renvoient une réussite. Voici un exemple:

```php
  public function testCompareSameNameNoSameColor()
  {
    $card1 = new Card('As', 'Trèfle');
    $card2 = new Card('As', 'Pique');
    $this->assertEquals(+1, CardGame32::compare($card1,$card2));

  }
```
J'ai crée 2 cartes avec le même nom mais pas la même couleur comme le nom de la fonction l'indique et le programme lance le test unitaire. J'ai lancé la commande `.\bin\phpunit --filter testCompareSameNameNoSameColor` pour tester seulement cette fonction, le résultat attendu de la fonction `compare` est +1 ici.

La fonction `__toString()` renvoie le nom et la couleur de la carte en String:
```php
    $retour = $this->name . ", " . $this->color;
```



## Challenge 3 conception de tests unitaires pour `CardGame32`
La classe `CardGame32` représente un jeu de 32 cartes.
Pour créer les 32 cartes, j'ai écris les 32 cartes dans une variable de la classe `CardGame32`:

```php
$cardGame = new CardGame32([
      new Card('As', 'trèfle'), new Card('roi', 'trèfle'),new Card('dame', 'trèfle'),new Card('valet', 'trèfle'),new Card('10', 'trèfle'),new Card('9', 'trèfle'),new Card('8', 'trèfle'),new Card('7', 'trèfle'),
      new Card('As', 'coeur'),new Card('roi', 'coeur'),new Card('dame', 'coeur'),new Card('valet', 'coeur'),new Card('10', 'coeur'),new Card('9', 'coeur'),new Card('8', 'coeur'),new Card('7', 'coeur'),
      new Card('As', 'pique'),new Card('roi', 'pique'),new Card('dame', 'pique'),new Card('valet', 'pique'),new Card('10', 'pique'),new Card('9', 'pique'),new Card('8', 'pique'),new Card('7', 'pique'),
      new Card('As', 'carreau'),new Card('roi', 'carreau'),new Card('dame', 'carreau'),new Card('valet', 'carreau'),new Card('10', 'carreau'),new Card('9', 'carreau'),new Card('8', 'carreau'),new Card('7', 'carreau')
    ]);  
```

Puis pour tester, j'ai utiliser la fonction `__toString` qui renvoie le nombre de carte que contient une variable de la classe `CardGame32`. J'ai testé cette fonction dans la classe `CardGame32Test` avec phpunit comme tout les autres fonction test
```php
  public function __toString()
  {
    return "CardGame32 : ". count($this->cards) . " carte(s)";
  }
```

Ensuite j'ai modifié la  fonction `getCards`, elle permet de selectionner la carte la position voulue dans la pile.

## Challenge 4 
Pour la dernière partie du projet, je devais modifier la classe guess et jouer avec le programme en executant `play-console.php`
