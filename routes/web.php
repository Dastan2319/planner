<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

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




Route::get('welcome/{locale}', function ($locale) {
    if (! in_array($locale, \Illuminate\Support\Facades\Config::get('app.locales'))) {
        abort(400);
    }
    App::setLocale($locale);
    return redirect()->back();
})->name('lang.change');

Auth::routes();

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomeController::class, 'index'])->name('home');
