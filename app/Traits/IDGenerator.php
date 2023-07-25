<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

// Trait ini digunakan untuk membuat ID secara acak sebanyak 20 digit
// Trait ini digunakan di tiap model
trait IDGenerator
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                $model->id = Str::random(20);
            } catch (Exception $e) {
                Log::error("ID GENERATOR ERROR " . $e->getMessage());
                abort(500, $e->getMessage());
            }
        });
    }
}
