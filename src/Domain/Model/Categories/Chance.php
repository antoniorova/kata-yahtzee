<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Chance implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        return $dice->sum();
    }
}
