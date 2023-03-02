<?php

namespace App\Http\Controllers;

use App\Models\masyarakat;
use App\Models\User;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\HistoryLelang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->get()->where('users_id',Auth::user()->id);
        $lelangs = Lelang::all();
        $barangs = Barang::all();
        $users = User::all();
        return view('masyarakat.index', compact('users','historyLelangs','lelangs','barangs'));
    }

    public function listlelang()
    {
        $lelangs =  Lelang::orderBy('created_at', 'desc')->get();
        return view('masyarakat.listlelang', compact('lelangs',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $masyarakats = User::find($user->id);
        return view('masyarakat.show', compact('masyarakats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(masyarakat $masyarakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, masyarakat $masyarakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy(masyarakat $masyarakat)
    {
        //
    }
}
