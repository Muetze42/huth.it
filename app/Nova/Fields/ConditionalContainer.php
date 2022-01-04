<?php

namespace App\Nova\Fields;

use DigitalCreative\ConditionalContainer\ConditionalContainer as Field;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConditionalContainer extends Field
{
    private function executeCondition($attributeValue, string $operator, $conditionValue): bool
    {

        $conditionValue = trim($conditionValue, '"\'');

        if (in_array($operator, ['<', '>', '<=', '>=']) && $conditionValue ||
            (is_numeric($attributeValue) && is_numeric($conditionValue))) {

            $conditionValue = (int)$conditionValue;
            $attributeValue = (int)$attributeValue;

        }

        if (in_array($conditionValue, ['true', 'false'])) {

            $conditionValue = $conditionValue === 'true';

        }

        switch ($operator) {

            case '=':
            case '==':
                return $attributeValue == $conditionValue;
            case '===':
                return $attributeValue === $conditionValue;
            case '!=':
                return $attributeValue != $conditionValue;
            case '!==':
                return $attributeValue !== $conditionValue;
            case '>':
                return $attributeValue > $conditionValue;
            case '<':
                return $attributeValue < $conditionValue;
            case '>=':
                return $attributeValue >= $conditionValue;
            case '<=':
                return $attributeValue <= $conditionValue;
            case 'boolean':
            case 'truthy':
                return $conditionValue ? !!$attributeValue : !$attributeValue;
            case 'includes':
            case 'contains':

                /**
                 * On the javascript side it uses ('' || []).includes() which works with array and string
                 */
                if ($attributeValue instanceof Collection) {

                    return $attributeValue->contains($conditionValue);

                }

                return Str::contains(json_encode($attributeValue), $conditionValue);

            case 'starts with':
            case 'startsWith':
                return Str::startsWith($attributeValue, $conditionValue);
            case 'endsWith':
            case 'ends with':
                return Str::endsWith($attributeValue, $conditionValue);
            default :
                return false;

        }

    }
}
