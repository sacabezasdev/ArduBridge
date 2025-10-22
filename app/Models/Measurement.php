<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = ['id', 'device_id', 'metric', 'value', 'unit', 'recorded_at', 'payload'];
    protected $casts = [
        'id' => 'ulid',
        'device_id' => 'ulid',
        'recorded_at' => 'datetime',
        'payload' => 'array'   // Laravel will encode/decode JSONB
    ];
}
