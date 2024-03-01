<?php

namespace LaravelPulse\Sluggish\Services;

use Illuminate\Support\Str;
use LaravelPulse\Sluggish\Interfaces\SluggishInterface;
use LaravelPulse\Sluggish\Traits\CheckParameterValidation;
use LaravelPulse\Sluggish\Traits\GetUniqueValue;

class SeqIdentifier implements SluggishInterface
{
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
        return SeqIdentifier::SequentialIndex($parameter, $model, $modelField, $id);
    }

    public static function SequentialIndex($parameter = 'SH', $model, $modelField, $length = 3)
    {
        $previousLength = $length;

        $lastRecord = $model::orderBy('id', 'desc')->first();

        if (!$lastRecord) {
            $lastNumber = ''; // initial starting
        }

        $lastRecordId = ((int) substr($lastRecord->$modelField, strlen($parameter)) / 1) * 1;
        $lastNumberLength = strlen($lastRecordId + 1);
        $previousLength = $length - $lastNumberLength;
        $lastNumber = $lastRecordId + 1;

        $zeros = ""; // default separator configured
        for ($i = 0; $i < $previousLength; $i++) {
            $zeros .= "0";
        }
        return $parameter . $zeros . $lastNumber;
    }
}
