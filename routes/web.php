<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
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
    if (! in_array($locale, Config::get('app.locales'))) {
        abort(400);
    }
    App::setLocale($locale);
    session()->put('locale',$locale);
    return redirect()->back();
})->name('lang.change');

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->group(function (){

        Route::resource('tags',TagsController::class)
            ->except('index');

        Route::resource('tasks',TasksController::class)
            ->except('index');

        Route::resource('priority',PriorityController::class);
    });

Route::get('/tags',[TagsController::class,'index'])
    ->name('tags');

Route::get('/tasks',[TasksController::class,'index'])
    ->name('tasks');

Route::post('/tasks/{task}/toggle',[TasksController::class,'toggle'])
    ->name('tasks.toggle');

