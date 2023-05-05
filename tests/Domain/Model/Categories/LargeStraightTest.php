<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\LargeStraight;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class LargeStraightTest extends TestCase
{
    public function testLargeStraightCorrectScoreWithDiceProvided(): void
    {
        $largeStraight = new LargeStraight();
        $this->assertEquals(20, $largeStraight->score(DiceCollection::fromArray([2,3,3,6,4,5])));
    }

    public function testLargeStraightGiveZero(): void
    {
        $largeStraight = new LargeStraight();
        $this->assertEquals(0, $largeStraight->score(DiceCollection::fromArray([1,3,3,4,5,6])));
    }
}
