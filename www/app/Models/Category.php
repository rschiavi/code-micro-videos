<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;

class Category extends Model
{
    use SoftDeletes, Uuid;

    public $fillable = [
        'name', 'description', 'is_active'
    ];

    public $dates = [
        'deleted_at'
    ];

    public $incrementing = false;

    public $keyType = 'string';
}
