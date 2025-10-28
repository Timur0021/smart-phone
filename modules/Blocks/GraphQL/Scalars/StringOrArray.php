<?php

namespace Modules\Blocks\GraphQL\Scalars;

use GraphQL\Type\Definition\ScalarType;

class StringOrArray extends ScalarType
{
    public string $name = 'StringOrArray';
    public ?string $description = 'Custom scalar that allows either a string or an array of strings.';

    public function serialize($value)
    {
        if (is_array($value)) {
            $result = [];
            foreach ($value as $v) {
                if (is_array($v) && isset($v['image'])) {
                    $result[] = asset('storage/' . $v['image']);
                } else {
                    $result[] = (string)$v;
                }
            }
            return $result;
        }

        return (string) $value;
    }

    public function parseValue($value)
    {
        if (is_array($value)) {
            return array_map(fn($v) => is_array($v) && isset($v['image']) ? $v['image'] : (string)$v, $value);
        }

        return (string) $value;
    }

    public function parseLiteral($ast, array $variables = null)
    {
        switch (true) {
            case $ast instanceof \GraphQL\Language\AST\StringValueNode:
                return $ast->value;
            case $ast instanceof \GraphQL\Language\AST\ListValueNode:
                $result = [];
                foreach ($ast->values as $node) {
                    if ($node instanceof \GraphQL\Language\AST\StringValueNode) {
                        $result[] = $node->value;
                    }
                }
                return $result;
            default:
                return null;
        }
    }
}
