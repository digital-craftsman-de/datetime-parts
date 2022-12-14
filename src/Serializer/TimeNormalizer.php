<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimeParts\Serializer;

use DigitalCraftsman\DateTimeParts\Time;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class TimeNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof Time;
    }

    /** @param class-string $type */
    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === Time::class;
    }

    /** @param Time|null $object */
    public function normalize($object, $format = null, array $context = []): ?string
    {
        return $object === null
            ? null
            : (string) $object;
    }

    /** @param ?string $data */
    public function denormalize($data, $type, $format = null, array $context = []): ?Time
    {
        return $data === null
            ? null
            : Time::fromString($data);
    }

    /** @codeCoverageIgnore */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
