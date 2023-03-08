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
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
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
//CONTROLLER REGISTER
route::controller(RegisterController::class)->group(function(){
//ROUTE REGISTER
    route::get('register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
route::post('register', [RegisterController::class, 'store'])->name('register-store')->middleware('guest');
});


//CONTROLLER LOGIN
route::controller(LoginController::class)->group(function(){
    //ROUTE LOGIN LOGOUT
route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');
route::get('logout', [LoginController::class, 'logout'])->name('logout-petugas');
});
//CONTROLLER DASHBOARD
route::controller(DashboardController::class)->group(function(){
// ROUTE DASHBOARD
route::get('/dashboard/admin', [Dashboardcontroller::class, 'admin'])->name('dashboard.admin')->middleware('auth', 'level:admin,petugas');
route::get('/dashboard/petugas', [Dashboardcontroller::class, 'petugas'])->name('dashboard.petugas')->middleware('auth', 'level:petugas');
route::get('/dashboard/masyarakat', [Dashboardcontroller::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth', 'level:masyarakat');
});
route::view('error/403', 'error.403')->name('error.403');

//Controller lelang
route::controller(LelangController::class)->group(function () {
   //route lelang
   Route::get('masyarakat/lelang', 'listlelang')->name('lelang.listlelang')->middleware('auth', 'level:masyarakat');
   Route::get('listlelang', 'listlelang')->name('lelang.listlelang')->middleware('auth', 'level:masyarakat,admin,petugas');
   Route::get('petugas/lelang', 'index')->name('lelangpetugas.index')->middleware('auth', 'level:petugas');
   Route::get('petugas/lelang/create', 'create')->name('lelang.create')->middleware('auth', 'level:petugas');
   Route::post('petugas/lelang', 'store')->name('lelang.store')->middleware('auth', 'level:petugas');
   Route::get('/menawar/{lelang}', 'show')->name('lelangin.show')->middleware('auth','level:masyarakat');
   Route::get('/petugas/lelang/{lelang}', 'show')->name('lelangpetugas.show')->middleware('auth','level:petugas');
   Route::put('/petugas/lelang/{lelang}', 'update')->name('lelang.update')->middleware('auth','level:petugas');
   Route::get('/admin/lelang/{lelang}', 'show')->name('lelangadmin.show')->middleware('auth','level:admin');
   Route::get('/cetak-lelang', 'cetaklelang')->name('cetak.lelang')->middleware('auth','level:admin,petugas');
   Route::get('/cetak-penawaran/{lelang}', 'cetakpenawaran')->name('cetak.penawaran')->middleware('auth','level:admin,petugas');
   Route::delete('/petugas/lelang/', 'destroy')->name('lelang.destroy')->middleware('auth','level:petugas');
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
Route::get('list-lelang', [MasyarakatController::class, 'listlelang'])->name('masyarakat.listlelang')->middleware('auth','level:masyarakat');
Route::resource('masyarakat', MasyarakatController::class)->middleware('auth', 'level:admin');

// ROUTE LIST LELANG
Route::get('/dashboard/masyarakat/listlelang', [ListController::class, 'index'])->name('listlelang.index')->middleware('auth','level:masyarakat');

//Controller HistoryLelang
Route::controller(HistorylelangController::class)->group(function() {
    //ROUTE HISTORY LELANG
    Route::get('/menawar/{lelang}', 'create')->name('lelangin.create')->middleware('auth','level:masyarakat');
Route::get('cetak-history', 'cetakhistory')->name('cetak.history')->middleware('auth','level:petugas,admin');
Route::get('/data-penawaran', 'index')->name('datapenawar.index')->middleware('auth','level:petugas,admin');
Route::post('/menawar/{lelang}', 'store')->name('lelangin.store')->middleware('auth','level:masyarakat');
Route::post('/komentar/{lelang}', 'storecomments')->name('lelangin.storecomments')->middleware('auth','level:masyarakat,petugas,admin');
Route::delete('/data-penawaran/{lelang}', 'destroy')->name('lelangin.destroy')->middleware('auth','level:petugas');
Route::put('/lelangpetugas/{id}/pemenang', 'setPemenang')->name('lelangpetugas.setpemenang');
Route::get('cetak-history', 'cetakhistory')->name('cetak.history')->middleware('auth','level:petugas,admin');

        });
 // Controller User
 Route::controller(UserController::class)->group(function() {
    // ROUTE USER
    Route::post('/admin/operator/create', 'store')->name('user.store')->middleware('auth','level:admin');
    Route::get('/admin/operator/create', 'create')->name('user.create')->middleware('auth','level:admin');
    Route::get('/admin/users', 'index')->name('user.index')->middleware('auth','level:admin');
    Route::get('/admin/users/{user}/edit', 'edit')->name('user.edit')->middleware('auth','level:admin');
    Route::get('/admin/users/{user}', 'show')->name('user.show')->middleware('auth','level:admin');
    Route::delete('/admin/users/{user}', 'destroy')->name('user.destroy')->middleware('auth','level:admin');
    Route::put('/admin/users/{user}', 'update')->name('user.update')->middleware('auth','level:admin');
    Route::get('profile', 'profile')->name('profile.index')->middleware('auth','level:admin,petugas,masyarakat');
    Route::put('profile', 'updateprofile')->name('user.updateprofile')->middleware('auth','level:admin,petugas,masyarakat');
    Route::get('profile', 'editprofile')->name('user.editprofile')->middleware('auth','level:admin,petugas,masyarakat');
        });

        // ROUTE GENERATE LAPORAN
        route::get('generate-pdf', [ReportController::class, 'generatePdf'])->name('generatePdf');
    


    

