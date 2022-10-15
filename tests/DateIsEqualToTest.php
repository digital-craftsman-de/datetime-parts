<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts;

use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \DigitalCraftsman\DateTimeParts\Date */
final class DateIsEqualToTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @covers ::isEqualTo
     */
    public function is_equal_to_works(
        bool $expectedResult,
        Date $date,
        Date $comparator,
    ): void {
        // -- Act & Assert
        self::assertSame($expectedResult, $date->isEqualTo($comparator));
    }

    /**
     * @return array<string, array{
     *   0: boolean,
     *   1: Date,
     *   2: Date,
     * }>
     */
    public function dataProvider(): array
    {
        return [
            'previous year' => [
                false,
                Date::fromString('2023-10-08'),
                Date::fromString('2022-10-08'),
            ],
            'same date' => [
                true,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-08'),
            ],
            'next year' => [
                false,
                Date::fromString('2022-10-08'),
                Date::fromString('2023-10-08'),
            ],
            'next month' => [
                false,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-11-08'),
            ],
            'next day' => [
                false,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-09'),
            ],
        ];
    }
}
