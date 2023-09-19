<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class OrderItemsRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Implement your validation logic here
        // You can access $attribute (field name) and $value (field value)

        // Example validation logic:
        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $item) {
            if (!isset($item['product_name']) || !isset($item['product_price']) || !isset($item['product_quantity']) || !isset($item['product_subtotal'])) {
                return false;
            }

            if (!is_string($item['product_name']) || !is_numeric($item['product_price']) || !is_numeric($item['product_quantity']) || !is_numeric($item['product_subtotal'])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is invalid.';
    }
}
