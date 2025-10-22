<?php
namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Measurement;
use Illuminate\Http\Request;

class IngestController extends Controller
{
    public function store(Request $request)
    {
        // Simple device authentication via header (rotate per device)
        $apiKey = $request->header('X-Device-Key');
        $device = Device::where('api_key', $apiKey)->first();
        if (!$device) {
            return response()->json(['error' => 'Unauthorized device'], 401);
        }

        $data = $request->validate([
            'metric' => 'required|string|max:64',
            'value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:16',
            'recorded_at' => 'nullable|date',      // Arduino can send its own timestamp
            'payload' => 'nullable',           // any JSON
        ]);

        $m = Measurement::create([
            'device_id' => $device->id,
            'metric' => $data['metric'],
            'value' => $data['value'] ?? null,
            'unit' => $data['unit'] ?? null,
            'recorded_at' => isset($data['recorded_at']) ? $data['recorded_at'] : now(),
            'payload' => $data['payload'] ?? null,
        ]);

        return response()->json($m, 201);
    }
}
