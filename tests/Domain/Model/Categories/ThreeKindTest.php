<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class ThreeKindTest extends TestCase
{
    public function testThreeKindCorrectScoreWithDiceProvided(): void
    {
        $threeKind = new ThreeKind();
        $this->assertEquals(15, $threeKind->score(DiceCollection::fromArray([3,5,5,5,3,6])));
    }

    public function testThreeKindCorrectScoreWithMoreThanPairValuesDiceProvided(): void
    {
        $threeKind = new ThreeKind();
        $this->assertEquals(3, $threeKind->score(DiceCollection::fromArray([1,1,1,1,5,5])));
    }

    public function testThreeKindGiveZero(): void
    {
        $threeKind = new ThreeKind();
        $this->assertEquals(0, $threeKind->score(DiceCollection::fromArray([1,2,3,4,5,6])));
    }
}
