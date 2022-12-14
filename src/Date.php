<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts;

/** @psalm-immutable */
final class Date implements \Stringable
{
    private const DATE_FORMAT = 'Y-m-d';

    // -- Construction

    public function __construct(
        public readonly Month $month,
        public readonly int $day,
    ) {
    }

    public static function fromDateTime(\DateTimeImmutable $dateTime): self
    {
        /** @psalm-suppress PossiblyNullArrayAccess */
        [$year, $month, $day] = sscanf(
            $dateTime->format(self::DATE_FORMAT),
            '%d-%d-%d',
        );

        /**
         * @psalm-suppress PossiblyNullArgument
         * @psalm-suppress PossiblyInvalidArgument
         */
        return new self(
            new Month(
                new Year($year),
                $month,
            ),
            $day,
        );
    }

    public static function fromString(string $date): self
    {
        try {
            return self::fromDateTime(new \DateTimeImmutable($date));
        } catch (\Exception) {
            throw new \InvalidArgumentException(sprintf('Value "%s" is not valid date format.', $date));
        }
    }

    // Stringable

    public function __toString(): string
    {
        return $this->format(self::DATE_FORMAT);
    }

    // Accessors

    public function isEqualTo(self $day): bool
    {
        return $this->day === $day->day
            && $this->month->isEqualTo($day->month);
    }

    public function isNotEqualTo(self $day): bool
    {
        return !$this->isEqualTo($day);
    }

    public function isBefore(self $day): bool
    {
        if ($this->month->isBefore($day->month)) {
            return true;
        }

        if ($this->month->isAfter($day->month)) {
            return false;
        }

        return $this->day < $day->day;
    }

    public function isBeforeOrEqualTo(self $day): bool
    {
        if ($this->month->isBefore($day->month)) {
            return true;
        }

        if ($this->month->isAfter($day->month)) {
            return false;
        }

        return $this->day <= $day->day;
    }

    public function isAfter(self $day): bool
    {
        if ($this->month->isAfter($day->month)) {
            return true;
        }

        if ($this->month->isBefore($day->month)) {
            return false;
        }

        return $this->day > $day->day;
    }

    public function isAfterOrEqualTo(self $day): bool
    {
        if ($this->month->isAfter($day->month)) {
            return true;
        }

        if ($this->month->isBefore($day->month)) {
            return false;
        }

        return $this->day >= $day->day;
    }

    // Mutations

    public function format(string $format): string
    {
        return $this
            ->toDateTimeImmutable()
            ->format($format);
    }

    public function modify(string $modifier): self
    {
        $modifiedDateTime = $this->toDateTimeImmutable()
            ->modify($modifier);

        /** @psalm-suppress PossiblyFalseArgument */
        return self::fromDateTime($modifiedDateTime);
    }

    private function toDateTimeImmutable(): \DateTimeImmutable
    {
        return new \DateTimeImmutable(
            sprintf(
                '%d-%d-%d 00:00:00',
                $this->month->year->year,
                $this->month->month,
                $this->day,
            ),
        );
    }
}
