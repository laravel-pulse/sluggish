<?php

namespace LaravelPulse\Sluggish\Traits;

trait InteractDatabase
{
    /**
     * @param $model
     * @param $modelField
     * @param $value
     * @return mixed
     */
    protected function getModelValue($value, $model, $modelField, $id = null)
    {
        $query = $model::where($modelField, 'like', $value . '%');

        if ($id !== null) {
            $query->where('id', '<>', $id);
        }

        return $query->pluck($modelField);
    }
}
