<?php

namespace LaravelPulse\Sluggish\Traits;

use LaravelPulse\Sluggish\Traits\InteractDatabase;

trait GetUniqueValue
{
    use InteractDatabase;
    /**
     * Get a unique value for a given value.
     *
     * @param  string  $value
     * @param  string  $model
     * @param array $options
     * @return mixed
     */
    protected function getUniqueValue($value, $model, $modelField, $id = null): string
    {
        $existingValues = $this->getModelValue($value, $model, $modelField, $id);

        if (!$existingValues->contains($value)) {
            return $value;
        }

        $maxAttempts = config('sluggish.max-attempts');

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $newValue = $value . config('sluggish.separator') . $attempt; // You can modify this based on your requirements (seperated by _, -)
            if (!$existingValues->contains($newValue)) {
                return $newValue;
            }
        }

        // Fallback if no unique value is found after maxAttempts iterations
        return $value . config('sluggish.fallback-separator') . time(); // This is just a fallback; you can modify it based on your needs
    }
}
