<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Analytics;
use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AnalyticsController extends Controller
{
    public function track(Request $request)
    {
        $event = $request->input('event');
        $value = $request->input('value');
        $sessionId = session()->getId();

        // Register active user
        Cache::put('online-user-' . $sessionId, true, now()->addMinutes(2));

        if ($event === 'heartbeat') {
            Analytics::updateOrCreate(
                ['session_id' => $sessionId, 'event' => 'heartbeat'],
                ['ip_address' => $request->ip(), 'updated_at' => now()]
            );
        } elseif ($event) {
            Analytics::create([
                'session_id' => $sessionId,
                'event' => $event,
                'value' => $value,
                'ip_address' => $request->ip(),
            ]);

            // If design view, increment design views count
            if ($event === 'design_view' && $value) {
                Design::where('id', $value)->increment('views');
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
