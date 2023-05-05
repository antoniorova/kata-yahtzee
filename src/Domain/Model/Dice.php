<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model;

use Webmozart\Assert\Assert;

class Dice
{
    private const MIN = 1;
    private const MAX = 6;

    private function __construct(
        public readonly int $value
    ) {
    }

    public static function random(): self
    {
        return new self(
            random_int(self::MIN, self::MAX)
        );
    }

    public static function fromInt(int $value): self
    {
        Assert::range($value, self::MIN, self::MAX);

        return new self($value);
    }
}
