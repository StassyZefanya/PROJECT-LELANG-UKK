<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HistorylelangController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\ListController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// route::get('/', [BarangController::class, 'welcome'])->name('welcome');

// route::redirect('/', '/login', 301);

route::controller(BarangController::class)->group(function() {
    Route::get('barang', 'index')->name('barang.index');
    Route::get('barang/create', 'create')->name('barang.create');
    Route::post('barang', 'store')->name('barang.store');
    Route::get('barang/{barang}', 'show')->name('barang.show');
    Route::get('barang/{barang}/edit', 'edit')->name('barang.edit');
    Route::put('barang/{barang}', 'update')->name('barang.update');
    Route::delete('barang/{barang}', 'destroy')->name('barang.destroy');

});

route::get('register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
route::post('register', [RegisterController::class, 'store'])->name('register-store')->middleware('guest');
route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');

route::get('logout', [LoginController::class, 'logout'])->name('logout-petugas');

route::get('/dashboard/admin', [Dashboardcontroller::class, 'admin'])->name('dashboard.admin')->middleware('auth', 'level:admin,petugas');
route::get('/dashboard/petugas', [Dashboardcontroller::class, 'petugas'])->name('dashboard.petugas')->middleware('auth', 'level:petugas');
route::get('/dashboard/masyarakat', [Dashboardcontroller::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth', 'level:masyarakat');

route::view('error/403', 'error.403')->name('error.403');

route::controller(LelangController::class)->group(function () {
    route::get('lelang', 'index')->name('lelang.index');
    route::get('lelang/{lelang}', 'show')->name('lelang.show');
    route::put('lelang/{lelang}', 'update')->name('lelang.update');
});

// middleware only admin
route::middleware(['auth', 'level:admin'])->group(function () {
    route::controller(usercontroller::class)->group(function () {
        route::get('user', 'index')->name('user.index');
        route::get('user/create', 'create')->name('user.create');
        route::post('user', 'store')->name('user.store');
        route::get('user/{user}', 'show')->name('user.show');
        route::get('user/{user}/edit', 'edit')->name('user.edit');
        route::put('user/{user}', 'update')->name('user.update');
        route::delete('user/{user}', 'destroy')->name('user.destroy');
    });
    route::get('admin/barang', [barangController::class, 'index']);
    route::get('admin/users', [lelangController::class, 'index']);
});

// middleware only petugas
route::middleware(['auth', 'level:petugas'])->group(function () {
    route::controller(LelangController::class)->group(function () {
        route::get('lelang/create', 'create')->name('lelang.create');
        route::post('lelang', 'store')->name('lelang.store');
        route::get('lelang/{lelang}/edit', 'edit')->name('lelang.edit');
        route::delete('lelang/{lelang}', 'destroy')->name('lelang.destroy');
    });
    route::get('petugas/barang', [barangController::class, 'index']);
    route::get('petugas/lelang', [lelangController::class, 'index']);
});

// middleware only masyarakat
route::middleware(['auth', 'level:masyarakat'])->group(function () {
    route::controller();
});
// ROUTE MASYARAKAT
Route::get('data-penawaran-anda', [MasyarakatController::class, 'index'])->name('masyarakatlelang.index')->middleware('auth', 'level:masyarakat');
Route::resource('masyarakat', MasyarakatController::class)->middleware('auth', 'level:admin');

//Controller HistoryLelang
Route::controller(HistorylelangController::class)->group(function() {
    //ROUTE HISTORY LELANG
    Route::get('/menawar/{lelang}', 'create')->name('lelangin.create')->middleware('auth','level:masyarakat');
    Route::get('/data-penawaran', 'index')->name('datapenawar.index')->middleware('auth','level:petugas');
    Route::post('/menawar/{lelang}', 'store')->name('lelangin.store')->middleware('auth','level:masyarakat');
    Route::delete('/data-penawaran/{lelang}', 'destroy')->name('lelangin.destroy')->middleware('auth','level:petugas');
        });



    

