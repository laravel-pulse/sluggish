<?php

namespace LaravelPulse\Sluggish\Traits;

trait CheckParameterValidation
{
    protected function validationErrors($parameter, $model, $modelField)
    {
        $errors = [];

        empty($parameter) ? $errors[] = throw new \InvalidArgumentException("Unsupported parameter: $parameter")
            : $parameter;
        empty($model)  ? $errors[] = throw new \InvalidArgumentException("Unsupported model: $model")
            : $model;
        empty($modelField) ? $errors[] = throw new \InvalidArgumentException("Unsupported type: $modelField")
            : $modelField;

        // If there are errors, return them as a string
        if (!empty($errors)) {
            return implode(', ', $errors);
        }

        return null;  // Return null if no errors
    }
}
