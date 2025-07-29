<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data penjualan hari ini
        $today = Carbon::today();
        $todaySales = Penjualan::whereDate('TanggalPenjualan', $today)->get();
        $todaySalesCount = $todaySales->count();
        $todayRevenue = $todaySales->sum('TotalHarga');

        // Total semua penjualan
        $totalSalesCount = Penjualan::count();
        $totalRevenue = Penjualan::sum('TotalHarga');

        // Penjualan terbaru (limit 5)
        $recentSales = Penjualan::with(['user', 'bayar'])->latest()->take(5)->get();

        // Data chart penjualan dan revenue 7 hari terakhir
        $last7Days = Carbon::now()->subDays(6);
        $salesPerDay = Penjualan::select(
            DB::raw('DATE(TanggalPenjualan) as date'),
            DB::raw('COUNT(*) as total_sales'),
            DB::raw('SUM(TotalHarga) as total_revenue')
        )
            ->whereDate('TanggalPenjualan', '>=', $last7Days)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = [];
        $chartSalesData = [];
        $chartRevenueData = [];

        // Inisialisasi label dan data 7 hari ke belakang
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->format('d M');
            $chartLabels[] = $label;

            $dayData = $salesPerDay->firstWhere('date', $date);
            $chartSalesData[] = $dayData ? (int) $dayData->total_sales : 0;
            $chartRevenueData[] = $dayData ? (int) $dayData->total_revenue : 0;
        }

        return view('admin.dashboard', compact(
            'todaySalesCount',
            'totalSalesCount',
            'todayRevenue',
            'totalRevenue',
            'recentSales',
            'chartLabels',
            'chartSalesData',
            'chartRevenueData'
        ));
    }
}
