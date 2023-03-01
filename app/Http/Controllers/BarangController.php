<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = DB::table('barangs')->insert([
            'nama_barang' => $request->nama_barang,
            'tanggal' => $request->tanggal,
            'harga_barang' => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi,
        ]
        );
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        $databarang = DB::table('barangs')->get();
        return view('barang.show', compact('databarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        $barangs = barang::find($barang->id);
        return view('barang.edit', compact('barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        $query = DB::table('barangs')->update([

            'nama_barang' => $request->nama_barang,
            'tanggal' => $request->tanggal,
            'harga_barang' => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi,
        ]
        );
        return redirect('barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        $barangs = Barang::find($barang->id);
        $barangs->delete();

        return redirect('barang');
    }
}
