<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Fours implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $partialDice = $dice->filterBy(4);

        return $partialDice->sum();
    }
}
