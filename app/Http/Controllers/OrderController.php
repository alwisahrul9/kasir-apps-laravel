<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Array untuk menampung menu id
        $idMenu = [];

        // Array untuk menampung request Menu
        $listMenu = [];

        // Array untuk menampung request Quantity
        $listQuantity = [];

        // Array untuk total harga tiap barang
        $totalHargaPerItem = [];

        // Waktu sekarang
        $now = Carbon::now()->toDateString();

        foreach($request->menu as $item){
            array_push($listMenu, $item);
        }

        foreach($request->quantity as $item){
            array_push($listQuantity, $item);
        }

        // Lakukan looping sebanyak total request menu untuk didapatkan id pada table menu
        for($i = 0; $i < count($listMenu); $i++){
            $getData = Menu::where('nama', $listMenu[$i])->first();

            if($listQuantity[$i] > $getData->stok){
                return redirect()->back()->with('gagal', 'Ada pesanan yang melebihi stok');
            }

            // Hitung total harga tiap barang (harga x kuantitas)
            $totalPerItem = $getData->harga * $listQuantity[$i];

            // Masukkan hasil perhitungan ke array $totalHargaPerItem
            array_push($totalHargaPerItem, $totalPerItem);

            // Masukkan hasil id menu ke array $idMenu
            array_push($idMenu, $getData->id);
        }

        // Buat data order baru
        Order::create([
            'total' => $request->total,
            'no_meja' => $request->no_meja,
            'tanggal' => $now,
        ]);

        // Ambil data order yang baru saja kita buat
        $getOrderId = Order::latest()->first();

        // Lakukan looping sebanyak array $idMenu untuk melakukan insert ke table order_detail
        for($i = 0; $i < count($idMenu); $i++){
            OrderDetail::create([
                'menu_id' => $idMenu[$i],
                'order_id' => $getOrderId->id,
                'quantity' => $listQuantity[$i],
                'harga' => $totalHargaPerItem[$i]
            ]);

            DB::table('menus')->where('id', $idMenu[$i])->decrement('stok', $listQuantity[$i]);
        }

        // Kembali ke halaman sebelumnya
        return redirect()->back()->with('berhasil', 'Pesanan dibuat');
    }

    public function update($id){
        $find = Order::find($id);

        $find->update([
            'active' => 'not'
        ]);

        return redirect()->back()->with('status', 'Transaksi berhasil');
    }

    public function destroy($id){
        $findOrder = Order::find($id);

        $getMenuId = OrderDetail::where('order_id', $findOrder->id)->get()   ;

        foreach($getMenuId as $item){
            DB::table('menus')->where('id', $item->menu_id)->increment('stok', $item->quantity);
        }
        
        OrderDetail::where('order_id', $findOrder->id)->delete();
        $findOrder->delete();

        return redirect()->back()->with('status', 'Transaksi dihapus');
    }

    public function printTransaksi($id)
    {
        $find = Order::with('menu')->find($id);

        return view('print.transaksi', compact('find'));
    }

    public function printLaporan()
    {
        $now = Carbon::now();
        $data = Menu::with('order')->get();

        return view('print.laporan', compact('data', 'now'));
    }
}
