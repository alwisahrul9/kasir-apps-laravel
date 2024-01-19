<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'required|file|image|mimes:png,jpg,jpeg|max:3075',
            'kategori_id' => 'required'
        ]);

        $request->file('gambar')->storeAs(
            'public/gambar',
            $request->gambar->hashName()
        );

        Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $request->gambar->hashName(),
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->back()->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $find = Menu::find($id);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|file|image|mimes:png,jpg,jpeg|max:3075',
            'kategori_id' => 'required'
        ]);

        if($request->hasFile('gambar')){
            $berkas_path = ('public/gambar/' . basename($find->gambar));
            Storage::delete($berkas_path);

            $request->file('gambar')->storeAs(
                'public/gambar',
                $request->gambar->hashName()
            );

            $find->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'gambar' => $request->gambar->hashName(),
                'kategori_id' => $request->kategori_id
            ]);

        } else {
            $find->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'kategori_id' => $request->kategori_id
            ]);
        }

        return redirect()->back()->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $find = Menu::find($id);

        $berkas_path = ('public/gambar/' . basename($find->gambar));
        Storage::delete($berkas_path);

        $find->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
