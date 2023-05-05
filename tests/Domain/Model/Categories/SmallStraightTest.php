<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class SmallStraightTest extends TestCase
{
    public function testSmallStraightCorrectScoreWithDiceProvided(): void
    {
        $smallStraight = new SmallStraight();
        $this->assertEquals(15, $smallStraight->score(DiceCollection::fromArray([2,3,1,1,4,5])));
    }

    public function testSmallStraightGiveZero(): void
    {
        $smallStraight = new SmallStraight();
        $this->assertEquals(0, $smallStraight->score(DiceCollection::fromArray([1,3,3,4,5,6])));
    }
}
