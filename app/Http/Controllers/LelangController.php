<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\lelang;
use App\Models\HistoryLelang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lelangs = lelang::orderBy('created_at','desc')->get();
        $barangs = Barang::select('id', 'nama_barang', 'harga_barang')
                    ->whereNotIn('id', function($query)
                    {
                        $query->select('barangs_id')->from('lelangs');
                    })->get();
        return view('lelang.index', compact('lelangs','barangs'));
    }
    public function cetaklelang()
    {
        //
        $cetaklelangs = Lelang::all();
        return view('lelang.cetaklelang', compact('cetaklelangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barangs = barang::select('id', 'nama_barang', 'harga_barang')
            ->whereNotIn('id', function ($query) {
                $query->select('barangs_id')->from('lelangs');
            })->get();
        return view('lelang.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'barangs_id'         => 'required|exists:barangs,id|unique:lelangs,barangs_id',
                'tanggal'    => 'required|date',
            ],
            [
                'barangs_id.required'        => 'Barang Harus Diisi',
                'barangs_id.exists'          => 'Barang Tidak Ada Pada Data Barang',
                'barangs_id.unique'          => 'Barang Sudah Di Lelang',
                'tanggal.required'   => 'Tanggal Lelang Harus Diisi',
                'tanggal.date'       => 'Tanggal Lelang Harus Berupa Tanggal',
                
            ]
        );
        $lelang = new lelang;
        $lelang->barangs_id = $request->barangs_id;
        $lelang->tanggal = $request->tanggal;
        $lelang->harga_akhir = '0';
        $lelang->users_id = Auth::user()->id;
        $lelang->status = 'dibuka';
        $lelang->pemenang = 'Belum Ada';
        $lelang->save();

        return redirect('petugas/lelang')->with('success','Data lelang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function show(lelang $lelang)
    {
        //
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->get()->where('lelang_id',$lelang->id);
        $lelangs = Lelang::find($lelang->id);
        return view('lelang.show', compact('lelangs','historyLelangs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(lelang $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lelang $lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(lelang $lelang)
    {
        //
        $lelangs = lelang::select('id', 'barangs_id', 'tanggal', 'harga_akhir', 'status')->get();
        return view('listlelang.index', compact('lelangs'));
    }
    public function cetakpenawaran(Lelang $lelang, $status = null)
    {
    $lelangs = Lelang::find($lelang->id);
    
    if($status == 'pemenang'){
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'pemenang')->get();
    } elseif($status == 'pending') {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'pending')->get();
    } elseif($status == 'gugur') {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'gugur')->get();
    } else {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->get();
    }
    
    return view('lelang.cetakdatapenawaran', compact('lelangs','historyLelangs','comments'));
    }
}
