<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AuthenticatedController;
use Illuminate\Support\Facades\Http;
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

Route::get('/province', function () {

    $response = Http::withHeaders([
        'key' => '777404a6bf87b04dc0a7cc99e9ac87c7',
    ])->get('https://api.rajaongkir.com/starter/province');

    // $statusCode = $response->json()['rajaongkir']['status']['code'];
    // $province = $response->json()['rajaongkir']['results'];

    dd($response->json());
    // dd($province);

});
Route::get('/city', function () {

    $response = Http::withHeaders([
        'key' => '777404a6bf87b04dc0a7cc99e9ac87c7',
    ])->get('https://api.rajaongkir.com/starter/city');

    dd($response->json()['rajaongkir']['results']);

});

// Route::get('/brands', [BrandController::class, 'index']);
// Route::post('/brands', [BrandController::class, 'store']);
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

Route::get('/brands-create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');

Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{id}/update', [BrandController::class, 'update'])->name('brands.update');

Route::delete('/brands/{id}/destroy', [BrandController::class, 'destroy'])->name('brands.destroy');


Route::get('/brands-login', [AuthenticatedController::class, 'index'])->name('brands.index');

Route::post('/brands-logins', [AuthenticatedController::class, 'login'])->name('brands.login');

Route::post('/logout', [AuthenticatedController::class, 'logout'])->name('logout');


Route::get('/brands-me', [AuthenticatedController::class, 'me']);


