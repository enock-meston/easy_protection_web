<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class GlobalActivityLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->trackActivity($request);
        return $next($request);
    }

    protected function trackActivity(Request $request)
    {

        $user = null;

        // Only try to get auth user if guard is available
        if (Auth::check()) {
            $user = Auth::user();
        }
        // dd($user);
        // exit();
        ActivityLog::create([
            'user_id' => $user?->id,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        Log::info('Global Activity Triggered', [
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_id' => Auth::user()?->id,
            'timestamp' => now(),
        ]);
    }
}
