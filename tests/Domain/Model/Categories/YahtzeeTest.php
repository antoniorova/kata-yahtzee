<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\Full;
use Yahtzee\Domain\Model\Categories\LargeStraight;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\Categories\Yahtzee;
use Yahtzee\Domain\Model\DiceCollection;

class YahtzeeTest extends TestCase
{
    public function testYahtzeeCorrectScoreWithDiceProvided(): void
    {
        $yahtzee = new Yahtzee();
        $this->assertEquals(50, $yahtzee->score(DiceCollection::fromArray([3,3,3,3,3,3])));
    }

    public function testYahtzeeGiveZero(): void
    {
        $yahtzee = new Yahtzee();
        $this->assertEquals(0, $yahtzee->score(DiceCollection::fromArray([1,3,3,4,5,6])));
    }
}
