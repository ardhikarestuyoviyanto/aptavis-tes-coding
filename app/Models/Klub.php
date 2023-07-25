<?php

namespace App\Models;

use App\Traits\IDGenerator;
use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    // Trait ini digunakan untuk generate ID otomatis
    use IDGenerator;

    protected $table = 'klub';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
}
