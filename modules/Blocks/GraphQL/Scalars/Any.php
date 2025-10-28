<?php

namespace Modules\Blocks\GraphQL\Scalars;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Language\AST\Node;

class Any extends ScalarType
{
    public string $name = 'Any';

    private function castString(string $value): int|float|bool|string|null
    {
        $lower = strtolower($value);

        if ($lower === 'true')  return true;
        if ($lower === 'false') return false;
        if ($lower === 'null')  return null;

        return is_numeric($value)
            ? (strpos($value, '.') !== false ? (float) $value : (int) $value)
            : $value;
    }

    public function serialize(mixed $value): mixed
    {
        return is_string($value) ? $this->castString($value) : $value;
    }

    public function parseValue(mixed $value): mixed
    {
        if (is_string($value)) {
            return $this->castString($value);
        }

        if (is_int($value) || is_float($value) || is_bool($value) || $value === null) {
            return $value;
        }

        throw new Error('Value must be int, float, bool, string or null');
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null): mixed
    {
        switch ($valueNode->kind) {
            case 'IntValue':
                return (int) $valueNode->value;
            case 'FloatValue':
                return (float) $valueNode->value;
            case 'BooleanValue':
                return (bool) $valueNode->value;
            case 'StringValue':
                return $this->castString($valueNode->value);
            case 'NullValue':
                return null;
            default:
                throw new Error('Value must be int, float, bool, string or null');
        }
    }
}
