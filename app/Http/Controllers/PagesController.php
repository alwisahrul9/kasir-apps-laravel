<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $data = Menu::with('kategori')->get();
        $kategori = Kategori::all();

        return view('dashboard', compact('data', 'kategori'));
    }

    public function entriOrder()
    {
        $data = Menu::with('kategori')->where('stok', '>', '0')->get();
        $kategori = Kategori::all();

        return view('entriOrder', compact('data', 'kategori'));
    }

    public function transaksiAktif()
    {
        $data = Order::with('menu')->where('active', 'yes')->latest()->get();

        return view('transaksiAktif', compact('data'));
    }
    
    public function riwayatTransaksi()
    {
        $data = Order::with('menu')->where('active', 'not')->latest()->get();

        return view('riwayatTransaksi', compact('data'));
    }

    public function loginPage()
    {
        return view('login');
    }

    public function generateLaporan(Request $request)
    {
        $now = Carbon::now();
        $data = Menu::with('order')->get();
        
        $dataTiapBulan = [];
        $inputTahun = "";

        $oldestData = Order::orderBy('updated_at', 'DESC')->first();
        $maxYear = $oldestData->updated_at->format('Y');

        $latestData = Order::latest()->first();
        $minYear = $latestData->updated_at->format('Y');

        if($request->has('inputTahun')){
            $dataTiapBulan = [];
            $inputTahun = $request->inputTahun;
            for($i = 1; $i <= 12; $i++){
                $riwayat = Order::whereMonth('updated_at', $i)
                                    ->whereYear('updated_at', $request->inputTahun)
                                    ->count();
                array_push($dataTiapBulan, $riwayat);
            }
        }
        
        for($i = 1; $i <= 12; $i++){
            $riwayat = Order::whereMonth('updated_at', $i)
                                ->whereYear('updated_at', $now)
                                ->count();
            array_push($dataTiapBulan, $riwayat);
        }
        
        return view('laporan', compact('data', 'riwayat', 'now', 'dataTiapBulan', 'minYear', 'maxYear', 'inputTahun'));
    }
}
