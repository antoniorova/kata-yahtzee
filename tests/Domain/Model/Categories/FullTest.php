<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\Full;
use Yahtzee\Domain\Model\Categories\LargeStraight;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class FullTest extends TestCase
{
    public function testFullCorrectScoreWithDiceProvided(): void
    {
        $full = new Full();
        $this->assertEquals(21, $full->score(DiceCollection::fromArray([3,3,3,6,6,5])));
        $this->assertEquals(24, $full->score(DiceCollection::fromArray([6,6,6,3,3,3])));
    }

    public function testFullGiveZero(): void
    {
        $full = new Full();
        $this->assertEquals(0, $full->score(DiceCollection::fromArray([1,3,3,4,5,6])));
    }
}
