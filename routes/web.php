<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::get('/url/re-activate/{url}', function (Illuminate\Http\Request $request, App\Models\Url $url) {
  if (!$request->hasValidSignature()) {
    abort(401);
  }

  $url->failing = false;
  $url->save();

  return redirect('/');
})->name('url.re-activate');

Route::get('/test', function (\App\Services\UrlChecker $urlChecker) {
  $urls = \App\Models\Url::all();
  $urls->each(function ($url) {
    event(new \App\Events\CheckUrl($url));
  });
});

Route::get('/links', [\App\Http\Controllers\LinksController::class, 'index'])->name('links');
Route::get('/links/create', [\App\Http\Controllers\LinksController::class, 'create'])->name('links.create');
Route::post('/links', [\App\Http\Controllers\LinksController::class, 'store'])->name('links.store');
Route::delete('/links/{url}', [\App\Http\Controllers\LinksController::class, 'destroy'])->name('links.destroy');

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
