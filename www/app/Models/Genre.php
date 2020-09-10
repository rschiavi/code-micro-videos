<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;

class Genre extends Model
{
    use SoftDeletes, Uuid;

    public $fillable = [
        'name', 'is_active'
    ];

    public $dates = [
        'deleted_at'
    ];

    public $casts = [
        'is_active' => 'boolean'
    ];

    public $incrementing = false;

    public $keyType = 'string';
}
