<?php

namespace LaravelPulse\Sluggish\Services;

use LaravelPulse\Sluggish\Interfaces\SluggishInterface;

class SeqIdentifier implements SluggishInterface
{
    /**
     * Generate a unique slug for a given input parameter and ID.
     *
     * @param string $parameter
     * @param mixed $model
     * @param string $modelField
     * @param int $value
     * @return string
     */
    public function generate($parameter, $model, $modelField, $value): string
    {
        return SeqIdentifier::SequentialIndex($parameter, $model, $modelField, $value);
    }

    /**
     * Generate a unique slug for a given input parameter and ID.
     *
     * @param string $parameter
     * @param mixed $model
     * @param string $modelField
     * @param string $value
     * @return string
     */
    public static function SequentialIndex($parameter = 'SH-', $model, $modelField, $length)
    {
        $length > 0 ? $previousLength = $length
            : $previousLength = config('sluggish.default-value');

        $lastNumber = ''; // initial starting

        $lastRecord = $model::orderBy('id', 'desc')->first();

        if ($lastRecord) {
            $lastRecordId = ((int) substr($lastRecord->$modelField, strlen($parameter)) / 1) * 1;
            $lastNumberLength = strlen($lastRecordId + 1);
            $previousLength = $length - $lastNumberLength;
            $lastNumber = $lastRecordId + 1;
        }

        return (new SeqIdentifier())->calculate($parameter, $previousLength, $lastNumber);
    }

    /**
     * Generate a unique slug for a given input parameter and ID.
     *
     * @param string $parameter
     * @param mixed $model
     * @param int $lastNumber
     * @return string
     */
    protected function calculate($parameter, $previousLength, $lastNumber): string
    {
        $zeros = ""; // default separator configured
        for ($i = 0; $i < $previousLength; $i++) {
            $zeros .= "0";
        }
        return $parameter . $zeros . $lastNumber;
    }
}
