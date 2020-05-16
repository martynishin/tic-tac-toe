<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait Uuid
 *
 * @package App\Traits
 */
trait Uuid
{
    /**
     * @return void
     */
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
