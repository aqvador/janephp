<?php

namespace Github\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Github\Runtime\Normalizer\CheckArray;
use Github\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class ScimUserMetaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Github\Model\ScimUserMeta::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Github\Model\ScimUserMeta::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Github\Model\ScimUserMeta();
        if (!($context['skip_validation'] ?? false)) {
            $this->validate($data, new \Github\Validator\ScimUserMetaConstraint());
        }
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('resourceType', $data)) {
            $object->setResourceType($data['resourceType']);
            unset($data['resourceType']);
        }
        if (\array_key_exists('created', $data)) {
            $date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created']);
            if (false === $date) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['created'], 'Y-m-d\TH:i:sP'));
            }
            $object->setCreated($date);
            unset($data['created']);
        }
        if (\array_key_exists('lastModified', $data)) {
            $date_1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['lastModified']);
            if (false === $date_1) {
                throw new \InvalidArgumentException(sprintf('Invalid datetime value "%s", expected format "%s".', $data['lastModified'], 'Y-m-d\TH:i:sP'));
            }
            $object->setLastModified($date_1);
            unset($data['lastModified']);
        }
        if (\array_key_exists('location', $data)) {
            $object->setLocation($data['location']);
            unset($data['location']);
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
        if ($data->isInitialized('resourceType') && null !== $data->getResourceType()) {
            $dataArray['resourceType'] = $data->getResourceType();
        }
        if ($data->isInitialized('created') && null !== $data->getCreated()) {
            $dataArray['created'] = $data->getCreated()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('lastModified') && null !== $data->getLastModified()) {
            $dataArray['lastModified'] = $data->getLastModified()->format('Y-m-d\TH:i:sP');
        }
        if ($data->isInitialized('location') && null !== $data->getLocation()) {
            $dataArray['location'] = $data->getLocation();
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }
        if (!($context['skip_validation'] ?? false)) {
            $this->validate($dataArray, new \Github\Validator\ScimUserMetaConstraint());
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Github\Model\ScimUserMeta::class => false];
    }
}