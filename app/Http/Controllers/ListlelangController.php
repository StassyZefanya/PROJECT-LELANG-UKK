<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lelang;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;

class ListlelangController extends Controller
{
    //
    public function index()
    {
        $lelangs = lelang::all();
        return view('lelang.index', compact('lelangs'));
    }
    public function penawaran()
    {
        $lelangs = lelang::all();
        return view('listlelang.index', compact('lelangs'));
    }
    public function create()
    {
        $barangs = barang::select('id', 'nama_barang', 'harga_awal')
        ->whereNotIn('id', function ($query) {
            $query->select('barangs_id')->from('lelangs');
        })->get();
        return view('lelang.create', compact('barangs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'barangs_id' => 'required|exists:barangs,id|unique:lelangs,barangs_id',
            'tanggal' => 'required|date',
            'harga_akhir' => 'required|numeric'
        ], [
            'barang_id.required' => 'Barang Harus Diisi',
            'barang_id.exists' => 'Barang Tidak Ada Pada Data Barang',
            'barang_id.unique' => 'Barang Sudah Ada',
            'tanggal.required' => 'Tanggal Lelang Harus Diisi',
            'tanggal.date' => 'Tanggal Lelang Harus Berupa Tanggal',
            'harga_akhir.required' => 'Harga Akhir Harus Diisi',
            'harga_akhir.numeric' => 'Harga Akhir Harus Harus Berupa Angka',
        ]);
        $lelang = new lelang;
        $lelang->barangs_id = $request->barangs_id;
        $lelang->tanggal = $request->tanggal;
        $lelang->harga_akhir = $request->harga_akhir;
        $lelang->users_id = Auth::user()->id;
        $lelang->status = 'dibuka';
        $lelang->save();

        return redirect('petugas/lelang');
    }
}
