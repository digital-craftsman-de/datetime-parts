<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts;

use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \DigitalCraftsman\DateTimeParts\Year */
final class YearIsEqualToTest extends TestCase
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
        Year $year,
        Year $comparator,
    ): void {
        // -- Act & Assert
        self::assertSame($expectedResult, $year->isEqualTo($comparator));
    }

    /**
     * @return array<string, array{
     *   0: boolean,
     *   1: Year,
     *   2: Year,
     * }>
     */
    public function dataProvider(): array
    {
        return [
            'previous year' => [
                false,
                Year::fromString('2023'),
                Year::fromString('2022'),
            ],
            'same date' => [
                true,
                Year::fromString('2022'),
                Year::fromString('2022'),
            ],
            'next year' => [
                false,
                Year::fromString('2022'),
                Year::fromString('2023'),
            ],
        ];
    }
}
