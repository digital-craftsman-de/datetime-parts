<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts;

use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \DigitalCraftsman\DateTimeParts\DateTime */
final class DateTimeIsAfterTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dataProvider
     *
     * @covers ::isAfter
     */
    public function is_after_works(
        bool $expectedResult,
        DateTime $dateTime,
        DateTime $comparator,
    ): void {
        // -- Act & Assert
        self::assertSame($expectedResult, $dateTime->isAfter($comparator));
    }

    /**
     * @return array<string, array{
     *   0: boolean,
     *   1: DateTime,
     *   2: DateTime,
     * }>
     */
    public function dataProvider(): array
    {
        return [
            'previous year' => [
                false,
                DateTime::fromString('2021-10-08 15:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'is equal' => [
                false,
                DateTime::fromString('2022-10-08 15:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next year' => [
                true,
                DateTime::fromString('2023-10-08 15:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next month' => [
                true,
                DateTime::fromString('2022-11-08 15:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next day' => [
                true,
                DateTime::fromString('2022-10-09 15:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next hour' => [
                true,
                DateTime::fromString('2022-10-08 16:00:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next minute' => [
                true,
                DateTime::fromString('2022-10-08 15:01:00'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next second' => [
                true,
                DateTime::fromString('2022-10-08 15:00:01'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
            'next millisecond' => [
                true,
                DateTime::fromString('2022-10-08 15:00:00.000001'),
                DateTime::fromString('2022-10-08 15:00:00'),
            ],
        ];
    }
}
