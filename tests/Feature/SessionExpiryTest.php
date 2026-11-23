<?php

namespace Tests\Feature;

use App\Http\Middleware\ExpireSessionAtClosingTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SessionExpiryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['session.driver' => 'array']);
        app('session')->forgetDrivers();

        Route::middleware('web')
            ->get('/_test/session-expiry', fn () => response('', 204))
            ->middleware('session-closing-time');
    }

    public function test_session_expires_at_23_wita(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-23 22:59:00', 'Asia/Makassar'));

        try {
            $this->get('/_test/session-expiry')
                ->assertNoContent()
                ->assertSessionHas(
                    ExpireSessionAtClosingTime::SESSION_EXPIRY_KEY,
                    Carbon::parse('2026-11-23 23:00:00', 'Asia/Makassar')->getTimestamp()
                );

            Carbon::setTestNow(Carbon::parse('2026-11-23 23:00:00', 'Asia/Makassar'));
            Auth::shouldReceive('logout')->once();

            $this->get('/_test/session-expiry')
                ->assertRedirect('/login')
                ->assertSessionHas('info', 'Sesi Anda berakhir pada pukul 23.00 WITA. Silakan login kembali.');
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_session_started_after_23_wita_expires_at_23_the_next_day(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-23 23:01:00', 'Asia/Makassar'));

        try {
            $this->get('/_test/session-expiry')
                ->assertNoContent()
                ->assertSessionHas(
                    ExpireSessionAtClosingTime::SESSION_EXPIRY_KEY,
                    Carbon::parse('2026-11-24 23:00:00', 'Asia/Makassar')->getTimestamp()
                );
        } finally {
            Carbon::setTestNow();
        }
    }
}
