<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order; // Jika sudah ada model Order
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function index()
    {

        // Data statistik untuk dashboard
        $data = [
            'total_menu' => Menu::count(),
            'total_users' => User::where('role', 'user')->count(),
            'menu_tersedia' => Menu::where('is_available', true)
                                 ->where('stok', '>', 0)
                                 ->count(),
            'menu_habis' => Menu::where('stok', 0)->count(),
            'total_pendapatan' => 0, // Nanti diisi jika sudah ada orders
            'pesanan_baru' => 0, // Nanti diisi jika sudah ada orders
        ];

        // Jika sudah ada model Order, tambahkan statistik pesanan
        // try {
        //     $data['total_pendapatan'] = Order::where('status', 'selesai')->sum('total_harga');
        //     $data['pesanan_baru'] = Order::where('status', 'pending')->count();
        // } catch (\Exception $e) {
        //     // Table orders belum ada, biarkan nilai default
        // }

        // Menu terpopuler (contoh, nanti bisa diisi dari data pesanan)
        $menu_populer = Menu::where('is_available', true)
                          ->where('stok', '>', 0)
                          ->limit(5)
                          ->get();

        return view('admin.dashboard', compact('data', 'menu_populer'));
    }

    /**
     * Get chart data for dashboard (optional - untuk grafik)
     */
    public function getChartData()
    {
        // Data untuk chart (contoh)
        $chartData = [
            'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            'data' => [1200000, 1900000, 1500000, 1800000, 2200000, 2500000, 2000000]
        ];

        return response()->json($chartData);
    }

    /**
     * Get recent activities (optional)
     */
    public function getRecentActivities()
    {
        $activities = [
            [
                'icon' => 'fas fa-utensils',
                'color' => 'text-blue-500',
                'activity' => 'Menu baru "Es Jeruk" ditambahkan',
                'time' => '2 menit lalu'
            ],
            [
                'icon' => 'fas fa-shopping-cart',
                'color' => 'text-green-500', 
                'activity' => 'Pesanan #001 diterima',
                'time' => '5 menit lalu'
            ],
            [
                'icon' => 'fas fa-user',
                'color' => 'text-purple-500',
                'activity' => 'Customer baru mendaftar',
                'time' => '10 menit lalu'
            ],
            [
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'text-yellow-500',
                'activity' => 'Stok Nasi Kucing hampir habis',
                'time' => '1 jam lalu'
            ]
        ];

        return response()->json($activities);
    }
}