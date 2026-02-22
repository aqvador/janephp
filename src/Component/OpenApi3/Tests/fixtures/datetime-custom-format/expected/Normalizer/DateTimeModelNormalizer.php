<?php

namespace Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Runtime\Normalizer\CheckArray;
use Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class DateTimeModelNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel();
        if (!($context['skip_validation'] ?? false)) {
            $this->validate($data, new \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Validator\DateTimeModelConstraint());
        }
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('defaultDateTime', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['defaultDateTime']);
            if (false === $date) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['defaultDateTime'], 'Y-m-d\TH:i:sP'));
            }
            $object->setDefaultDateTime($date);
            unset($data['defaultDateTime']);
        }
        if (\array_key_exists('customDateTime', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d H:i:s', $data['customDateTime']);
            if (false === $date_1) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['customDateTime'], 'Y-m-d H:i:s'));
            }
            $object->setCustomDateTime($date_1);
            unset($data['customDateTime']);
        }
        if (\array_key_exists('customDate', $data)) {
            $date_2 = \DateTime::createFromFormat('d/m/Y', $data['customDate']);
            if (false === $date_2) {
                throw new \InvalidArgumentException(sprintf('Invalid date value "%s", expected format "%s".', $data['customDate'], 'd/m/Y'));
            }
            $object->setCustomDate($date_2->setTime(0, 0, 0));
            unset($data['customDate']);
        }
        if (\array_key_exists('nullableCustomDateTime', $data) && $data['nullableCustomDateTime'] !== null) {
            $date_3 = \DateTime::createFromFormat('Y-m-d H:i:s', $data['nullableCustomDateTime']);
            if (false === $date_3) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['nullableCustomDateTime'], 'Y-m-d H:i:s'));
            }
            $object->setNullableCustomDateTime($date_3);
            unset($data['nullableCustomDateTime']);
        }
        elseif (\array_key_exists('nullableCustomDateTime', $data) && $data['nullableCustomDateTime'] === null) {
            $object->setNullableCustomDateTime(null);
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['defaultDateTime'] = $data->getDefaultDateTime()->format('Y-m-d\TH:i:sP');
        if ($data->isInitialized('customDateTime') && null !== $data->getCustomDateTime()) {
            $dataArray['customDateTime'] = $data->getCustomDateTime()->format('Y-m-d H:i:s');
        }
        if ($data->isInitialized('customDate') && null !== $data->getCustomDate()) {
            $dataArray['customDate'] = $data->getCustomDate()->format('d/m/Y');
        }
        if ($data->isInitialized('nullableCustomDateTime')) {
            $dataArray['nullableCustomDateTime'] = $data->getNullableCustomDateTime()?->format('Y-m-d H:i:s');
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }
        if (!($context['skip_validation'] ?? false)) {
            $this->validate($dataArray, new \Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Validator\DateTimeModelConstraint());
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model\DateTimeModel::class => false];
    }
}