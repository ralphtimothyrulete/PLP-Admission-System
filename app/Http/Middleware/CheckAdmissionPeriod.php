<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckAdmissionPeriod
{
    public function handle(Request $request, Closure $next)
    {
        $startDate = Carbon::createFromDate(Carbon::now()->year - 1, 12, 1); // December 1st of the previous year
        $endDate = Carbon::createFromDate(Carbon::now()->year, 5, 31); // January 31st of the current year
        $currentDate = Carbon::now();

        // Exclude login, registration, and logout routes from the check
        if ($request->is('login') || $request->is('register') || $request->is('logout') || $request->is('password/*')) {
            return $next($request);
        }

        if ($currentDate->between($startDate, $endDate)) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Admissions are currently closed.');
    }
}