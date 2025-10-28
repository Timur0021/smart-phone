<?php

namespace Modules\Blocks\GraphQL\Scalars;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\ScalarType;

class BooleanOrString extends ScalarType
{
    public string $name = 'BooleanOrString';

    public function serialize($value): bool|string|int|float|null
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            if (strtolower($value) === 'true') {
                return true;
            }
            if (strtolower($value) === 'false') {
                return false;
            }
        }

        return $value;
    }

    public function parseValue($value): bool|string
    {
        if (is_bool($value) || is_string($value)) {
            return $value;
        }

        throw new Error("Value must be boolean or string");
    }

    public function parseLiteral($valueNode, array $variables = null): bool|string
    {
        switch ($valueNode->kind) {
            case 'BooleanValue':
                return $valueNode->value;
            case 'StringValue':
                $val = strtolower($valueNode->value);
                if ($val === 'true') {
                    return true;
                }
                if ($val === 'false') {
                    return false;
                }
                return $valueNode->value;
            default:
                throw new Error("Value must be boolean or string");
        }
    }
}
