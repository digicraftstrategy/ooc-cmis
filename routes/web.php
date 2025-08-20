<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        // Check if user email is verified
        /*if (!$user->verified()) {
            return redirect()->route('verification.notice')
                ->with('info', 'Please verify your email address to continue.');
        }

        // Check if user has vehicle owner setup using the same method as middleware
        if ($user->isClientUser() && !$user->isVehicleOwner()) {
            return redirect()->route('app.client.onbaord.index');
        } else if ($user->isClientUser() && !$user->isVehicleOwner() && !$user->vehicleOwner->isAtive()) {
            return redirect()->route('app.client.onbaord.account-pending-approval');
        }*/
        // All checks passed, redirect to dashboard
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Route::get('dashboard', Dashboard::class)
    ->middleware([
        'auth',
        'verified',
        //'verify_user_account_setup',
        //'validate_active_vehicle_owner'
    ])->name('dashboard');
/*
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
*/
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Protected Routes: Accessed by authenticated users
Route::group(
    [
        'middleware' => ['auth', 'verified'],
    ],
    function () {
        // Region
        Route::prefix('regions')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Regions\RegionsTable::class)->name('system.regions');
                Route::get('/register', \App\Livewire\Admin\Regions\CreateRegion::class)->name('system.regions.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Regions\EditRegion::class)->name('system.regions.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\Regions\ViewRegion::class)->name('system.regions.view');
            });
            // Province
        ROute::prefix('provinces')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Province\ProvinceTable::class)->name('system.provinces');
                Route::get('/register', \App\Livewire\Admin\Province\CreateProvince::class)->name('system.provinces.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Province\EditProvince::class)->name('system.provinces.edit');
                Route::get('/view/{provinceId}', \App\Livewire\Admin\Province\ViewProvince::class)->name('system.provinces.view');
            });

            //Roles
        Route::prefix('roles')
            ->group(function () {
                Route::get('/', \App\Livewire\System\Roles\RolesTable::class)->name('system.roles');
                Route::get('/register', \App\Livewire\System\Roles\CreateRole::class)->name('system.roles.create');
                Route::get('/edit/{id}', \App\Livewire\System\Roles\EditRole::class)->name('system.roles.edit');
                Route::get('/view/{id}', \App\Livewire\System\Roles\ViewRole::class)->name('system.roles.view');     
            });

            //Permissions
        Route::prefix('premissions')
            ->group(function () {
                Route::get('/', \App\Livewire\System\Permissions\PermissionsTable::class)->name('system.permissions');
                Route::get('/register', \App\Livewire\System\Permissions\CreatePremission::class)->name('system.permissions.create');
                Route::get('/edit/{id}', \App\Livewire\System\Permissions\EditPermission::class)->name('system.permissions.edit');
                Route::get('/view/{id}', \App\Livewire\System\Permissions\ViewPermission::class)->name('system.permissions.view');
            });
    }
);
require __DIR__.'/auth.php';
