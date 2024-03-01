<?php

namespace LaravelPulse\Sluggish\Interfaces;


interface SluggishInterface
{
    /**
     * @param mixed $parameter
     * @param mixed $model
     * @param string $modelField
     * @return string
     */
    public function generate(mixed $parameter, mixed $model, string $modelField, int $id): string;
}
