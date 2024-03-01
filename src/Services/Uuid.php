<?php

namespace LaravelPulse\Sluggish\Services;

use LaravelPulse\Sluggish\Interfaces\SluggishInterface;
use LaravelPulse\Sluggish\Traits\CheckParameterValidation;
use LaravelPulse\Sluggish\Traits\GetUniqueValue;
use Illuminate\Support\Str;

class Uuid implements SluggishInterface
{
    use CheckParameterValidation, GetUniqueValue;
    /**
     * Generate a unique id for a given input parameter and ID.
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

        return $this->setUniqueUuid($parameter, $model, $modelField, $id);
    }

    public function setUniqueUuid($parameter, $model, $modelField, $id = null): string
    {
        $uuid = $this->generateUuid($parameter);

        return $id > 0 ? $this->getUniqueUuid($uuid, $model, $modelField, $id) :
            $this->getUniqueUuid($uuid, $model, $modelField);
    }

    protected function generateUuid($parameter): string
    {
        switch ($parameter) {
            case "order":
                return Str::orderedUuid();
            case "time":
                return uniqid();
            case "hexad":
                return Str::uuid();
            case "datetime":
                return date('Ymd') . time();
            case "hash":
                return bcrypt($parameter);
            case substr($parameter, -1) === "-":
                return uniqid($parameter, true);
            case is_numeric($parameter):
                return mt_rand($parameter, 999999) . time(); // Adjust the range as needed
            case "random":
                return mt_rand(000, 999) . time(); // Generate a random numeric string
            case "random-4":
                return mt_rand(1000, 9999);
            case "random-5":
                return mt_rand(10000, 99999);
            case "random-6":
                return mt_rand(100000, 999999);
            case "random-7":
                return mt_rand(1000000, 9999999);
            case "random-8":
                return mt_rand(10000000, 99999999);
            case "random-9":
                return mt_rand(100000000, 999999999);
            case "random-10":
                return mt_rand(1000000000, 9999999999);
            case "random-11":
                return mt_rand(10000000000, 99999999999);
            case "random-12":
                return mt_rand(100000000000, 999999999999);

            default:
                throw new \InvalidArgumentException("Invalid parameter: $parameter");
        }
    }

    /**
     * Get a unique uuid, appending a number if necessary.
     */
    protected function getUniqueUuid($uuid, $model, $modelField, $id = null): string
    {
        return $this->getUniqueValue($uuid, $model, $modelField, $id);
    }
}
