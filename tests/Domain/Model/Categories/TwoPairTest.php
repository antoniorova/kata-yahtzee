<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\TwoPair;
use Yahtzee\Domain\Model\DiceCollection;

class TwoPairTest extends TestCase
{
    public function testTwoPairCorrectScoreWithDiceProvided(): void
    {
        $twoPair = new TwoPair();
        $this->assertEquals(22, $twoPair->score(DiceCollection::fromArray([3,5,6,5,3,6])));
    }

    public function testTwoPairCorrectScoreWithMoreThanPairValuesDiceProvided(): void
    {
        $twoPair = new TwoPair();
        $this->assertEquals(12, $twoPair->score(DiceCollection::fromArray([1,1,1,4,5,5])));
    }

    public function testTwoPairGiveZero(): void
    {
        $twoPair = new TwoPair();
        $this->assertEquals(0, $twoPair->score(DiceCollection::fromArray([1,2,3,4,5,6])));
    }
}
