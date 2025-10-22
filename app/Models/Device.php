<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Device extends Model
{
    use HasUlids;

    /** ULIDs are strings and not auto-incrementing */
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'slug', 'api_key', 'meta'];

    protected $casts = [
        'meta' => 'array',
    ];

    /** Relationships */
    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }
}
