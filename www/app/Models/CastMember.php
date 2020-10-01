<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;

class CastMember extends Model
{
    use SoftDeletes, Uuid;

    public $fillable = [
        'name', 'type'
    ];

    public $dates = [
        'deleted_at'
    ];

    public $incrementing = false;

    public $keyType = 'string';
}
