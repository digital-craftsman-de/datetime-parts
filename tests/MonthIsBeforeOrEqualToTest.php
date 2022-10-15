<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts;

use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \DigitalCraftsman\DateTimeParts\Month */
final class MonthIsBeforeOrEqualToTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @covers ::isBeforeOrEqualTo
     */
    public function is_before_or_equal_to_works(
        bool $expectedResult,
        Month $month,
        Month $comparator,
    ): void {
        // -- Act & Assert
        self::assertSame($expectedResult, $month->isBeforeOrEqualTo($comparator));
    }

    /**
     * @return array<string, array{
     *   0: boolean,
     *   1: Month,
     *   2: Month,
     * }>
     */
    public function dataProvider(): array
    {
        return [
            'previous year' => [
                false,
                Month::fromString('2022-10'),
                Month::fromString('2021-10'),
            ],
            'same date' => [
                true,
                Month::fromString('2022-10'),
                Month::fromString('2022-10'),
            ],
            'next year' => [
                true,
                Month::fromString('2022-10'),
                Month::fromString('2023-10'),
            ],
            'next month' => [
                true,
                Month::fromString('2022-10'),
                Month::fromString('2022-11'),
            ],
        ];
    }
}
