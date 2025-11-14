<?php

use App\Livewire\Dashboard;
use App\Livewire\Systems\Setings;
use App\Livewire\Users;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
// Systems Routes
Route::group(
    [
        'middleware' => ['auth', 'verified'],
        'prefix' => 'system'
    ],
    function () {

        // Regions
        Route::prefix('regions')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Regions\RegionsTable::class)->name('system.regions');
                Route::get('/register', \App\Livewire\Admin\Regions\CreateRegion::class)->name('system.regions.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Regions\EditRegion::class)->name('system.regions.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\Regions\ViewRegion::class)->name('system.regions.view');
        });
            // Provinces
        Route::prefix('provinces')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Province\ProvinceTable::class)->name('system.provinces');
                Route::get('/register', \App\Livewire\Admin\Province\CreateProvince::class)->name('system.provinces.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Province\EditProvince::class)->name('system.provinces.edit');
                Route::get('/view/{provinceId}', \App\Livewire\Admin\Province\ViewProvince::class)->name('system.provinces.view');
        });

            // Classification Rating
        Route::prefix('classification-ratings')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Classifications\ClassificationRating\ClassificationRatingTable::class)
                    ->name('admin.classifications.classification-ratings');
                Route::get('/register', \App\Livewire\Admin\Classifications\ClassificationRating\CreateClassificationRating::class)
                    ->name('admin.classifications.classification-ratings.create');
        });

            // Prescribed Activity Types
        Route::prefix('prescribed-activity-types')
            ->group(function () {
                Route::get('/', \App\Livewire\System\PrescribedActivityType\PrescribedActivityTypeTable::class)->name('system.prescribed-activity-types');
                Route::get('/register', \App\Livewire\System\PrescribedActivityType\CreatePrescribedActivityType::class)->name('system.prescribed-activity-types.create');
                Route::get('/edit/{id}', \App\Livewire\System\PrescribedActivityType\EditPrescribedActivityType::class)->name('system.prescribed-activity-types.edit');
                Route::get('/view/{id}', \App\Livewire\System\PrescribedActivityType\ViewPrescribedActivityType::class)->name('system.prescribed-activity-types.view');

        });

            // Prescribed Activities
        Route::prefix('prescribed-activities')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\PrescribedActivities\PrescribedActivityTable::class)->name('system.prescribed-activities');
                Route::get('/register', \App\Livewire\Admin\PrescribedActivities\CreatePrescribedActivity::class)->name('system.prescribed-activities.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\PrescribedActivities\EditPrescribedActivity::class)->name('system.prescribed-activities.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\PrescribedActivities\ViewPrescribedActivity::class)->name('system.prescribed-activities.view');
        });

            // User Types
        Route::prefix('user-types')
            ->group(function () {
                Route::get('/', \App\Livewire\System\UserTypes\UserTypesTable::class)->name('system.user-types');
                Route::get('/register', \App\Livewire\System\UserTypes\CreateUserType::class)->name('system.user-types.create');
                Route::get('/edit/{id}', \App\Livewire\System\UserTypes\EditUserType::class)->name('system.user-types.edit');
                Route::get('/view/{id}', \App\Livewire\System\UserTypes\ViewUserType::class)->name('system.user-types.view');
        });

            // Premises Owner Types
        Route::prefix('premises-owner-types')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes\PremisesOwnerTypesTable::class)
                    ->name('admin.publication-premises.premises-owner-types');
                 Route::get('/register', \App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes\CreatePremisesOwnerTypes::class)
                    ->name('admin.publication-premises.premises-owner-types.create');
                 Route::get('/edit/{id}', \App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes\EditPremisesOwnerTypes::class)
                    ->name('admin.publication-premises.premises-owner-types.edit');
                 Route::get('/view/{id}', \App\Livewire\Admin\PublicationPremises\PremisesOwnerTypes\ViewPremisesOwnerTypes::class)
                    ->name('admin.publication-premises.premises-owner-types.view');
        });

            // Roles
        Route::prefix('roles')
            ->group(function () {
                Route::get('/', \App\Livewire\System\Roles\RolesTable::class)->name('system.roles');
                Route::get('/register', \App\Livewire\System\Roles\CreateRole::class)->name('system.roles.create');
                Route::get('/edit/{id}', \App\Livewire\System\Roles\EditRole::class)->name('system.roles.edit');
                Route::get('/view/{id}', \App\Livewire\System\Roles\ViewRole::class)->name('system.roles.view');
                Route::get('/{id}/permissions', \App\Livewire\System\Roles\RolePermissions::class)->name('system.roles.permissions');
        });

            // Permissions
        Route::prefix('premissions')
            ->group(function () {
                Route::get('/', \App\Livewire\System\Permissions\PermissionsTable::class)->name('system.permissions');
                Route::get('/register', \App\Livewire\System\Permissions\CreatePremission::class)->name('system.permissions.create');
                Route::get('/edit/{id}', \App\Livewire\System\Permissions\EditPermission::class)->name('system.permissions.edit');
                Route::get('/view/{id}', \App\Livewire\System\Permissions\ViewPermission::class)->name('system.permissions.view');
        });
    }
);

// Publication Premises Routes
Route::group(
    [
        'middleware' => ['auth', 'verified'],
        //'prefix' => 'premises-owners'
    ],
    function () {

        // Publication Premises
        Route::prefix('premises-owners')
            ->group(function () {
                // Premises Owners table
                Route::get('/', \App\Livewire\Admin\PublicationPremises\PremisesOwner\PremisesOwnersTable::class)
                    ->name('admin.publication-premises.premises-owner');

                // Individual Premises owner per uuid
                Route::group(['prefix' => 'manage/{id}', 'middleware' => []], function () {
                    Route::get('/', \App\Livewire\Admin\PublicationPremises\PremisesOwner\ManagePremises::class)
                    ->name('admin.publication-premises.premises-owner.manage');

                    // Manage Premises Per owner
                    Route::group(['prefix' => '/publication-premises', 'middleware' => []], function () {
                        Route::get('/', \App\Livewire\Admin\PublicationPremises\PublicationPremises\PublicationPremisesTable::class)
                            ->name('admin.publication-premises.premises');

                            /** Might be a need to also add a route group for managing resources such as invoicing,
                             * licensing, etc per premsies. Where individual premises for each owner can be accessed by the premises uuid
                             */
                    });

                    // Manage Classifications Per Owner
                    Route::group(['prefix' => '/classified-films-publications', 'middleware' => []], function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Classification\ClassificationTable::class)
                            ->name('admin.classifications.classified-films-publications');
                    });
                });
        });
    }
);

// Classifications of Films & Publication Routes
Route::group(
    [
        'middleware' => ['auth', 'verified'],
        'prefix' => 'classifications'
    ],
    function () {
        //
    }
);
