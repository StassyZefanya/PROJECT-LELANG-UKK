<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lelang;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;
use App\Models\Historylelang;

class HistorylelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $historyLelangs = Historylelang::all();
        return view('lelang.datapenawaran', compact('historyLelangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Historylelang $historyLelang, Lelang $lelang)
    {
        //
        $lelangs = Lelang::find($lelang->id);
        $historyLelangs = Historylelang::orderBy('harga', 'desc')->get()->where('lelang_id',$lelang->id);
        return view('masyarakat.penawaran', compact('lelangs', 'historyLelangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lelang $lelang, Barang $barang)
    {
        //
        // ddd($request);
        $request->validate([
            'harga_penawaran'   => 'required|numeric',
        ],
        [
            'harga_penawaran.required'  => "Harga penawaran harus diisi",
            'harga_penawaran.numeric'  => "Harga penawaran harus berupa angka",
            
        ]);

        $historyLelang = new Historylelang();
        $historyLelang->lelang_id = $lelang->id;
        $historyLelang->nama_barang = $lelang->barang->nama_barang;
        $historyLelang->users_id = Auth::user()->id;
        $historyLelang->harga = $request->harga_penawaran;
        $historyLelang->status = 'pending';
        $historyLelang->save();

        return redirect()->route('lelangin.create', $lelang->id)->with('success', 'Anda berhasil menawar barang ini');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historylelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function show(Historylelang $historyLelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historylelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Historylelang $historyLelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historylelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historylelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historylelang $historyLelang)
    {
        //
        // $historyLelangs = HistoryLelang::find($historyLelang->id);
        $historyLelang->delete();
        // if(empty($historyLelang)) {
        //     return;
        // }
        return redirect()->route('datapenawar.index');
    }
}
