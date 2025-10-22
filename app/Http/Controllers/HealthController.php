<?php
namespace App\Http\Controllers;
class HealthController extends Controller
{
    public function __invoke()
    {
        return ['status' => 'ok', 'time' => now()->toIso8601String()];
    }
}
