<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;

class Video extends Model
{
    use SoftDeletes, Uuid;

    const RATING_LIST = ['L', '12', '14', '16', '18'];

    protected $fillable = [
        'title', 'description', 'year_launched',
        'opened', 'rating', 'duration'
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'opened' => 'boolean',
        'year_launched' => 'integer',
        'duration' => 'integer'
    ];

    protected $keyType = 'string';

    public $incrementing = false;
}
