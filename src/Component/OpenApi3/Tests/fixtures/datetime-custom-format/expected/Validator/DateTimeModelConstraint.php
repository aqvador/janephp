<?php

namespace Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Validator;

class DateTimeModelConstraint extends \Symfony\Component\Validator\Constraints\Compound
{
    protected function getConstraints($options): array
    {
        return [
            new \Symfony\Component\Validator\Constraints\Count(
                min: 0,
                minMessage: 'This array has not enough properties. It should have {{ limit }} properties or more.'
            ),
            new \Symfony\Component\Validator\Constraints\NotNull(message: 'This value should not be null.'),
            new \Symfony\Component\Validator\Constraints\Collection(fields: [
                'defaultDateTime' => new \Symfony\Component\Validator\Constraints\Required(
                    [
                        new \Symfony\Component\Validator\Constraints\DateTime(format: 'Y-m-d\TH:i:sP'),
                        new \Symfony\Component\Validator\Constraints\Type(type: ['string']),
                        new \Symfony\Component\Validator\Constraints\NotNull(message: 'This value should not be null.')
                    ]
                ),
                'customDateTime' => new \Symfony\Component\Validator\Constraints\Optional(
                    [
                        new \Symfony\Component\Validator\Constraints\DateTime(format: 'Y-m-d H:i:s'),
                        new \Symfony\Component\Validator\Constraints\Type(type: ['string']),
                        new \Symfony\Component\Validator\Constraints\NotNull(message: 'This value should not be null.')
                    ]
                ),
                'customDate' => new \Symfony\Component\Validator\Constraints\Optional(
                    [
                        new \Symfony\Component\Validator\Constraints\DateTime(format: 'd/m/Y'),
                        new \Symfony\Component\Validator\Constraints\Type(type: ['string']),
                        new \Symfony\Component\Validator\Constraints\NotNull(message: 'This value should not be null.')
                    ]
                ),
                'nullableCustomDateTime' => new \Symfony\Component\Validator\Constraints\Optional(
                    [
                        new \Symfony\Component\Validator\Constraints\DateTime(format: 'Y-m-d H:i:s'),
                        new \Symfony\Component\Validator\Constraints\Type(type: ['string'])
                    ]
                )
            ], allowExtraFields: true)
        ];
    }
}
