<?php

namespace Jane\Component\JsonSchema\Guesser\JsonSchema;

use Jane\Component\JsonSchema\Guesser\Guess\DateType;
use Jane\Component\JsonSchema\Guesser\Guess\Type;
use Jane\Component\JsonSchema\Guesser\GuesserInterface;
use Jane\Component\JsonSchema\Guesser\TypeGuesserInterface;
use Jane\Component\JsonSchema\JsonSchema\Model\JsonSchema;
use Jane\Component\JsonSchema\Registry\Registry;

class DateGuesser implements GuesserInterface, TypeGuesserInterface
{
    /**
     * @param string    $dateFormat      Format of date to use
     * @param bool|null $preferInterface indicator whether to use DateTime or DateTimeInterface as type hint
     */
    public function __construct(
        private string $dateFormat = 'Y-m-d',
        private ?bool $preferInterface = null,
    ) {
    }

    public function supportObject($object): bool
    {
        $class = $this->getSchemaClass();

        return ($object instanceof $class) && 'string' === $object->getType() && 'date' === $object->getFormat();
    }

    public function guessType($object, string $name, string $reference, Registry $registry): Type
    {
        $format = $this->dateFormat;

        if ($object instanceof \ArrayObject && $object->offsetExists('x-date-format')) {
            $perPropertyFormat = $object->offsetGet('x-date-format');
            if (\is_string($perPropertyFormat) && '' !== $perPropertyFormat) {
                $format = $perPropertyFormat;
            }
        }

        return new DateType($object, $format, $this->preferInterface);
    }

    protected function getSchemaClass(): string
    {
        return JsonSchema::class;
    }
}
