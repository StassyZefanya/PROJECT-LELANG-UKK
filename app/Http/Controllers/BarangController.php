<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\lelang;
use App\Models\user;
use App\Models\HistoryLelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $barangs = Barang::all();
        return view('barang.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'tanggal' => 'required',
            'harga_barang' => 'required',
            'deskripsi_barang' => 'required'
        ],
        [
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'harga_barang.required' => 'Harga awal tidak boleh kosong',
            'deskripsi_barang.required' => 'Deskripsi barang tidak boleh kosong',
        ]
    );

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        $validateData['users_id'] = Auth::id();
        // Barang::create([
        //     'nama_barang' => $request->nama_barang,
        //     'tanggal' => $request->tanggal,
        //     'harga_barang' => $request->harga_barang,
        //     'deskripsi_barang' => $request->deskripsi_barang
        // ]);

        Barang::create($validateData);
        return redirect()->route('barang.index')->with('success', 'Data Barang Berhasil Ditambahkan');
    
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
        $rules = [
            'nama_barang' => 'required',
            'tanggal' => 'required',
            'harga_barang' => 'required',
            'deskripsi_barang' => 'required',
        ];
        $validateData = $request->validate($rules);
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }
    
            // $barangs = Barang::find($barang->id);
            // $barangs->nama_barang = $request->nama_barang;
            // $barangs->tanggal = $request->tanggal;
            // $barangs->harga_barang = $request->harga_barang;
            // $barangs->image = $request->image;
            // $barangs->deskripsi_barang = $request->deskripsi_barang;
            // $barangs->update();
            Barang::where('id', $barang->id)
                   ->update($validateData);
            return redirect()->route('barang.index')->with('editsuccess', 'Data Barang Berhasil Diedit');
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

        return redirect()->route('barang.index')->with('deletesuccess', 'Data Barang Berhasil Dihapus');
    }
}
