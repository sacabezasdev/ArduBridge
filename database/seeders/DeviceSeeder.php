<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Device::updateOrCreate(
            ['slug' => 'arduino-01'],
            [
                'id' => (string) \Illuminate\Support\Str::ulid(),
                'name' => 'Arduino #01',
                'api_key' => 'DEVKEY-CHANGE-ME',
                'meta' => ['location' => 'Lab shelf']
            ]
        );
    }
}
