<?php

namespace PicturePark\API\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use PicturePark\API\Runtime\Normalizer\CheckArray;
use PicturePark\API\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class ActivityNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \PicturePark\API\Model\Activity::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \PicturePark\API\Model\Activity::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \PicturePark\API\Model\Activity();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('creationDate', $data) && $data['creationDate'] !== null) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['creationDate']);
            if (false === $date) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['creationDate'], 'Y-m-d\TH:i:sP'));
            }
            $object->setCreationDate($date);
        }
        elseif (\array_key_exists('creationDate', $data) && $data['creationDate'] === null) {
            $object->setCreationDate(null);
        }
        if (\array_key_exists('modificationDate', $data) && $data['modificationDate'] !== null) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['modificationDate']);
            if (false === $date_1) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['modificationDate'], 'Y-m-d\TH:i:sP'));
            }
            $object->setModificationDate($date_1);
        }
        elseif (\array_key_exists('modificationDate', $data) && $data['modificationDate'] === null) {
            $object->setModificationDate(null);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('creationDate')) {
            $dataArray['creationDate'] = $data->getCreationDate()?->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('modificationDate')) {
            $dataArray['modificationDate'] = $data->getModificationDate()?->format('Y-m-d\TH:i:sP');
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\PicturePark\API\Model\Activity::class => false];
    }
}