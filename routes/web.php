<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('regions', \App\Livewire\Admin\Regions\RegionsTable::class)->name('system.regions');
Route::get('regions/register', \App\Livewire\Admin\Regions\CreateRegion::class)->name('system.regions.create');
Route::get('regions/edit/{id}', \App\Livewire\Admin\Regions\EditRegion::class)->name('system.regions.edit');
Route::get('regions/view/{id}', \App\Livewire\Admin\Regions\ViewRegion::class)->name('system.regions.view');

require __DIR__.'/auth.php';
