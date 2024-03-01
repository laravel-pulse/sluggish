<?php

namespace LaravelPulse\Sluggish\Traits;

trait CheckParameterValidation
{
    protected function validationErrors($parameter, $model, $modelField)
    {
        $errors = [];

        empty($parameter) ? $errors[] = 'Title is not specified'
            : $parameter;
        empty($model)  ? $errors[] = 'Model class is not specified'
            : $model;
        empty($modelField) ? $errors[] = 'Model field not specified'
            : $modelField;

        // If there are errors, return them as a string
        if (!empty($errors)) {
            return implode(', ', $errors);
        }

        return null;  // Return null if no errors
    }
}
