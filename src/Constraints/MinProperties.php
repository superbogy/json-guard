<?php

namespace League\JsonGuard\Constraints;

use League\JsonGuard\Assert;
use League\JsonGuard\ValidationError;
use League\JsonGuard\Validator;

class MinProperties implements Constraint
{
    const KEYWORD = 'minProperties';

    /**
     * {@inheritdoc}
     */
    public function validate($value, $parameter, Validator $validator)
    {
        Assert::type($parameter, 'integer', self::KEYWORD, $validator->getPointer());
        Assert::nonNegative($parameter, self::KEYWORD, $validator->getPointer());

        if (!is_object($value) || count(get_object_vars($value)) >= $parameter) {
            return null;
        }

        return new ValidationError(
            'Object does not contain at least {min_properties} properties',
            self::KEYWORD,
            $value,
            $validator->getPointer(),
            ['min_properties' => $parameter]
        );
    }
}
