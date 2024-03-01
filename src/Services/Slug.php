<?php

namespace LaravelPulse\Sluggish\Services;

use Illuminate\Support\Str;
use LaravelPulse\Sluggish\Interfaces\SluggishInterface;
use LaravelPulse\Sluggish\Traits\CheckParameterValidation;
use LaravelPulse\Sluggish\Traits\GetUniqueValue;

class Slug implements SluggishInterface
{
    use CheckParameterValidation, GetUniqueValue;
    /**
     * Generate a unique slug for a given input parameter and ID.
     *
     * @param string $parameter
     * @param mixed $model
     * @param string $modelField
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function generate($parameter, $model, $modelField, $id): string
    {
        $errors = $this->validationErrors($parameter, $model, $modelField);
        if (!empty($errors)) {
            return $errors;
        }

        return $this->setUniqueSlug($parameter, $model, $modelField, $id);
    }

    public function setUniqueSlug($parameter, $model, $modelField, $id = null): string
    {
        $slug = $this->generateSlug($parameter);

        return $id > 0 ? $this->getUniqueSlug($slug, $model, $modelField, $id) :
            $this->getUniqueSlug($slug, $model, $modelField);
    }

    protected function generateSlug($parameter): string
    {
        return (mb_check_encoding($parameter, 'UTF-8') === false)
            ? preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u", "-", $parameter)
            : Str::slug($parameter);
    }

    /**
     * Get a unique slug, appending a number if necessary.
     *
     * @param string $slug
     * @param mixed $model
     * @param string $modelField
     * @param int $id
     * @return string
     */
    protected function getUniqueSlug($slug, $model, $modelField, $id = null): string
    {
        return $this->getUniqueValue($slug, $model, $modelField, $id);
    }
}
