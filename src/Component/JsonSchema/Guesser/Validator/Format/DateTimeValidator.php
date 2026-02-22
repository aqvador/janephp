<?php

namespace Jane\Component\JsonSchema\Guesser\Validator\Format;

use Jane\Component\JsonSchema\Guesser\Guess\ClassGuess;
use Jane\Component\JsonSchema\Guesser\Guess\Property;
use Jane\Component\JsonSchema\Guesser\Validator\ObjectCheckTrait;
use Jane\Component\JsonSchema\Guesser\Validator\ValidatorGuess;
use Jane\Component\JsonSchema\Guesser\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class DateTimeValidator implements ValidatorInterface
{
    use ObjectCheckTrait;

    private const DEFAULT_FORMAT = 'Y-m-d\TH:i:sP';

    public function supports($object): bool
    {
        if (!$this->checkObject($object)) {
            return false;
        }

        $type = $object->getType();
        $isString = \is_array($type) ? \in_array('string', $type) : 'string' === $type;

        return $isString && \in_array($object->getFormat(), ['date-time', 'date'], true);
    }

    /**
     * @param ClassGuess|Property $guess
     */
    public function guess($object, string $name, $guess): void
    {
        $format = 'date' === $object->getFormat() ? 'Y-m-d' : self::DEFAULT_FORMAT;

        if ($object instanceof \ArrayObject && $object->offsetExists('x-date-format')) {
            $perPropertyFormat = $object->offsetGet('x-date-format');
            if (\is_string($perPropertyFormat) && '' !== $perPropertyFormat) {
                $format = $perPropertyFormat;
            }
        }

        $guess->addValidatorGuess(new ValidatorGuess(DateTime::class, [
            'format' => $format,
        ]));
    }
}
