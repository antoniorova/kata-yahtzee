<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Pair;
use Yahtzee\Domain\Model\DiceCollection;

class PairTest extends TestCase
{
    public function testPairCorrectScoreWithDiceProvided(): void
    {
        $pair = new Pair();
        $this->assertEquals(10, $pair->score(DiceCollection::fromArray([3,5,6,5,3,4])));
    }

    public function testPairCorrectScoreWithMoreThanPairValuesDiceProvided(): void
    {
        $pair = new Pair();
        $this->assertEquals(2, $pair->score(DiceCollection::fromArray([1,1,1,4,5,6])));
    }

    public function testPairGiveZero(): void
    {
        $pair = new Pair();
        $this->assertEquals(0, $pair->score(DiceCollection::fromArray([1,2,3,4,5,6])));
    }
}
