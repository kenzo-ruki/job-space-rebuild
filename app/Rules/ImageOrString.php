<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ImageOrString implements Rule
{
    public function passes($attribute, $value)
    {
        // If the value is an instance of UploadedFile, validate it as an image
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $validator = Validator::make([$attribute => $value], [
                $attribute => 'image|max:51200',
            ]);

            return !$validator->fails();
        }

        // If the value is a string, validate it as a URL
        if (is_string($value)) {
            $validator = Validator::make([$attribute => $value], [
                $attribute => 'string',
            ]);

            return !$validator->fails();
        }

        // If the value is null, it's valid
        return $value === null;
    }

    public function message()
    {
        return 'The :attribute must be an image or a string.';
    }
}