<?php

namespace League\JsonGuard\Constraints;

use League\JsonGuard;
use League\JsonGuard\Assert;
use League\JsonGuard\ValidationError;
use League\JsonGuard\Validator;

class MinLength implements Constraint
{
    const KEYWORD = 'minLength';

    /**
     * {@inheritdoc}
     */
    public function validate($value, $parameter, Validator $validator)
    {
        Assert::type($parameter, 'number', self::KEYWORD, $validator->getPointer());
        Assert::nonNegative($parameter, self::KEYWORD, $validator->getPointer());

        if (!is_string($value) || JsonGuard\strlen($value) >= $parameter) {
            return null;
        }

        return new ValidationError(
            'String is not at least {min_length} characters long',
            self::KEYWORD,
            $value,
            $validator->getPointer(),
            ['min_length' => $parameter]
        );
    }
}
