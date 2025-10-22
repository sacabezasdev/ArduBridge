<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let HasUlids handle ID generation automatically.
        // Only create if it doesn't already exist by slug.
        Device::firstOrCreate(
            ['slug' => 'arduino-01'],
            [
                'name' => 'Arduino #01',
                'api_key' => 'DEVKEY-CHANGE-ME',
                'meta' => ['location' => 'Lab shelf'],
            ]
        );
    }
}
