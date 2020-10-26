<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;

class CastMember extends Model
{
    use SoftDeletes, Uuid;

    const TYPE_DIRECTOR = 1;
    const TYPE_ACTOR = 2;

    public $fillable = [
        'name', 'type'
    ];

    public $dates = [
        'deleted_at'
    ];

    public $casts = [
        'type' => 'integer'
    ];

    public $incrementing = false;

    public $keyType = 'string';
}
