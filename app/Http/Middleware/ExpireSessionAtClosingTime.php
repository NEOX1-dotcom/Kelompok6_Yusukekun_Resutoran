<?php

namespace App\Http\Middleware;

use App\Support\SessionClosingTime;
use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExpireSessionAtClosingTime
{
    public const SESSION_EXPIRY_KEY = 'auth_session_expires_at';

    public function handle(Request $request, Closure $next): Response
    {
        $expiresAt = $request->session()->get(self::SESSION_EXPIRY_KEY);

        if ($expiresAt === null) {
            $request->session()->put(
                self::SESSION_EXPIRY_KEY,
                SessionClosingTime::nextClosingTimestamp()
            );

            return $next($request);
        }

        if (CarbonImmutable::now(SessionClosingTime::TIMEZONE)->getTimestamp() >= (int) $expiresAt) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('info', 'Sesi Anda berakhir pada pukul 23.00 WITA. Silakan login kembali.');
        }

        return $next($request);
    }
}
