<?php

namespace App\Tests\Core;

use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;
use App\Core\Card;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32Test extends TestCase
{


    public function testGetCard(){
        //$cards = new CardGame32 ([new Card('As', 'trèfle'), new Card('roi', 'trèfle')]);
        $cards=CardGame32::factoryCardGame32();
        $card=new Card('roi', 'trèfle');
        
        $this->assertEquals($card , $cards->getCard(1));
    }

    public function testToString2cards()
    {
        $cards=new CardGame32([new Card('As', 'trèfle'), new Card('As', 'pique')]);
        $this->assertEquals("CardGame32 : 2 carte(s)",$cards->__toString());
    }

    public function testToString32cards()
    {
        $cards=CardGame32::factoryCardGame32();
        $this->assertEquals("CardGame32 : 32 carte(s)",$cards->__toString());
    }

    public function testShuffle()
    {
        $cards=CardGame32::factoryCardGame32();
        $cards->shuffle();
        $card=CardGame32::factoryCardGame32();
        $this->assertNotEquals($card,$cards);
    }




}

