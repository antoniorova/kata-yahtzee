<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Fours;
use Yahtzee\Domain\Model\DiceCollection;

class FoursTest extends TestCase
{
    public function testFoursCorrectScoreWithDiceProvided(): void
    {
        $fours = new Fours();
        $this->assertEquals(12, $fours->score(DiceCollection::fromArray([3,4,6,4,3,4])));
    }
}
