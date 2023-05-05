<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Fives;
use Yahtzee\Domain\Model\DiceCollection;

class FivesTest extends TestCase
{
    public function testFoursCorrectScoreWithDiceProvided(): void
    {
        $fives = new Fives();
        $this->assertEquals(10, $fives->score(DiceCollection::fromArray([3,5,6,5,3,4])));
    }
}
