<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class ThreeKind implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $groupValues = array_count_values($dice->toArray());
        /** @var int[] $threeOrMore */
        $threeOrMore = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 3
        ));

        return $threeOrMore === [] ? 0 : max($threeOrMore) * 3;
    }
}
