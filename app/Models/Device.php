<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Device extends Model
{
    use HasUlids;

    // ULIDs are strings and not auto-incrementing
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'slug', 'api_key', 'meta'];
    protected $casts = [
        'meta' => 'array',
    ];
}
