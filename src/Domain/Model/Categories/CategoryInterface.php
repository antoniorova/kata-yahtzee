<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

interface CategoryInterface
{
    public function score(DiceCollection $dice): int;
}
