<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Twos implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $partialDice = $dice->filterBy(2);

        return $partialDice->sum();
    }
}
