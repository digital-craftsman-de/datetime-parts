<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeUtils\Doctrine;

use DigitalCraftsman\DateTimeUtils\ValueObject\DateTime;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use PHPUnit\Framework\TestCase;

final class DateTimeTypeTest extends TestCase
{
    /** @test */
    public function convert_from_and_to_date_time_php_value_works(): void
    {
        // -- Arrange
        $dateTime = DateTime::fromString('2022-10-03 15:34:34');
        $dateTimeType = new DateTimeType();
        $platform = new PostgreSQLPlatform();

        // -- Act
        $databaseValue = $dateTimeType->convertToDatabaseValue($dateTime, $platform);
        $phpValue = $dateTimeType->convertToPHPValue($databaseValue, $platform);

        // -- Assert
        self::assertEquals($dateTime, $phpValue);
    }

    /** @test */
    public function convert_from_and_to_null_value_works(): void
    {
        // -- Arrange
        $dateTimeType = new DateTimeType();
        $platform = new PostgreSQLPlatform();

        // -- Act
        $databaseValue = $dateTimeType->convertToDatabaseValue(null, $platform);
        $phpValue = $dateTimeType->convertToPHPValue($databaseValue, $platform);

        // -- Assert
        self::assertNull($phpValue);
    }
}