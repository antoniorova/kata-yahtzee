<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Full implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $groupValues = array_count_values($dice->toArray());
        $threeGroup = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 3
        ));
        if (count($threeGroup) === 2) {
            sort($threeGroup);
            unset($threeGroup[0]);
        }
        foreach ($threeGroup as $key) {
            unset($groupValues[$key]);
        }
        $twoGroup = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 2
        ));

        return count($threeGroup) === 0 || count($twoGroup) === 0
            ? 0
            : (end($threeGroup) * 3) + (end($twoGroup) * 2);
    }
}
