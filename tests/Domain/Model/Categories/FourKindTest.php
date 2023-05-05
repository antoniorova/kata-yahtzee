<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class FourKindTest extends TestCase
{
    public function testFourKindCorrectScoreWithDiceProvided(): void
    {
        $fourKind = new FourKind();
        $this->assertEquals(20, $fourKind->score(DiceCollection::fromArray([3,5,5,5,5,6])));
    }

    public function testFourKindCorrectScoreWithMoreThanPairValuesDiceProvided(): void
    {
        $fourKind = new FourKind();
        $this->assertEquals(4, $fourKind->score(DiceCollection::fromArray([1,1,1,1,1,5])));
    }

    public function testFourKindGiveZero(): void
    {
        $fourKind = new FourKind();
        $this->assertEquals(0, $fourKind->score(DiceCollection::fromArray([1,2,3,4,5,6])));
    }
}
