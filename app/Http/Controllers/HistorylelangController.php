<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lelang;
use App\Models\barang;
use App\Models\User;
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
        $historyLelangs = Historylelang::orderBy('harga', 'desc')->get();
        $lelangs = Lelang::all();
        $barangs = Barang::all();
        $users = User::all();
        return view('lelang.datapenawaran', compact('users','historyLelangs','lelangs','barangs'));
        // $historyLelangs = Historylelang::all();
        // return view('lelang.datapenawaran', compact('historyLelangs'));
    }
    public function cetakhistory()
    {
        //
        $cetakhistoryLelangs = HistoryLelang::orderBy('harga', 'desc')->get();
        return view('lelang.cetakhistory', compact('cetakhistoryLelangs'));
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
    public function setPemenang(Lelang $lelang, $id)
    {
    // Mengambil data history lelang berdasarkan id
    $historyLelang = HistoryLelang::findOrFail($id);

    // Mengubah status pada history lelang menjadi 'pemenang'
    $historyLelang->status = 'pemenang';
    $historyLelang->save();
    HistoryLelang::where('lelang_id', $historyLelang->lelang_id)
    ->where('status', 'pending')
    ->where('id', '<>', $historyLelang->id)
    ->update(['status' => 'gugur']);
    // Mengambil data lelang berdasarkan history lelang
    $lelang = $historyLelang->lelang;

    // Mengubah status pada lelang menjadi 'ditutup'
    $lelang->status = 'ditutup';
    $lelang->pemenang = $historyLelang->user->nama_petugas;
    $lelang->harga_akhir = $historyLelang->harga;
    $lelang->save();

    return redirect()->back()->with('success', 'Pemenang berhasil dipilih!');
    }
}
