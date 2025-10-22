<?php
namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementsController extends Controller
{
    public function index(Device $device, Request $request)
    {
        $query = Measurement::where('device_id', $device->id);

        if ($metric = $request->query('metric')) {
            $query->where('metric', $metric);
        }
        if ($since = $request->query('since')) {
            $query->where('recorded_at', '>=', $since);
        }
        if ($until = $request->query('until')) {
            $query->where('recorded_at', '<=', $until);
        }

        return $query->orderByDesc('recorded_at')->paginate(100);
    }
}
