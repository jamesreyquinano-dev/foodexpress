<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // 1. Fetch all registered users
        $user = User::all();

        // 2. Count metrics so user.blade.php doesn't crash
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalSales = Order::sum('total_price');

        // 3. Gather chart data (Updated to use SQLite compatible date logic)
        $weeklyData = Order::select(
            DB::raw("
                CASE strftime('%w', created_at)
                    WHEN '0' THEN 'Sunday'
                    WHEN '1' THEN 'Monday'
                    WHEN '2' THEN 'Tuesday'
                    WHEN '3' THEN 'Wednesday'
                    WHEN '4' THEN 'Thursday'
                    WHEN '5' THEN 'Friday'
                    WHEN '6' THEN 'Saturday'
                END as day
            "),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $chartData = [];
        foreach ($daysOfWeek as $day) {
            $chartData[] = $weeklyData[$day] ?? 0;
        }

        // Pass everything to the view
        return view('user', compact('user', 'totalUsers', 'totalOrders', 'totalSales', 'chartData'));
    }
}