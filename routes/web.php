<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
//use App\Livewire\Admin\PublicationPremises\PremisesOwner\EditPremisesOwners;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.dashboard'); // or wherever your main dashboard.blade.php is
    })->name('dashboard');
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
        /*Route::prefix('regions')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Regions\RegionsTable::class)->name('system.regions');
                Route::get('/register', \App\Livewire\Admin\Regions\CreateRegion::class)->name('system.regions.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Regions\EditRegion::class)->name('system.regions.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\Regions\ViewRegion::class)->name('system.regions.view');
            });
            // Province
        Route::prefix('provinces')
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
                Route::get('/{id}/permissions', \App\Livewire\System\Roles\RolePermissions::class)->name('system.roles.permissions');
            });

            //Permissions
        Route::prefix('premissions')
            ->group(function () {
                Route::get('/', \App\Livewire\System\Permissions\PermissionsTable::class)->name('system.permissions');
                Route::get('/register', \App\Livewire\System\Permissions\CreatePremission::class)->name('system.permissions.create');
                Route::get('/edit/{id}', \App\Livewire\System\Permissions\EditPermission::class)->name('system.permissions.edit');
                Route::get('/view/{id}', \App\Livewire\System\Permissions\ViewPermission::class)->name('system.permissions.view');
            });
*/
            // User types
        /*Route::prefix('user-types')
            ->group(function () {
                Route::get('/', \App\Livewire\System\UserTypes\UserTypesTable::class)->name('system.user-types');
                Route::get('/register', \App\Livewire\System\UserTypes\CreateUserType::class)->name('system.user-types.create');
                Route::get('/edit/{id}', \App\Livewire\System\UserTypes\EditUserType::class)->name('system.user-types.edit');
                Route::get('/view/{id}', \App\Livewire\System\UserTypes\ViewUserType::class)->name('system.user-types.view');
            });

            // Prescribed Actvity Types
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

            // Publication Premises Ower Types
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
        */
            // Publication Premises Owners
        Route::prefix('premises-owners')
            ->group(function () {
                /* Route::get('/', \App\Livewire\Admin\PublicationPremises\PremisesOwner\PremisesOwnersTable::class)
                    ->name('admin.publication-premises.premises-owner');
                Route::get('/', [\App\Http\Controllers\Administration\PremisesOwnerController::class, 'index'])
                    ->name('admin.publication-premises.premises-owner');*/
                 Route::get('/register', \App\Livewire\Admin\PublicationPremises\PremisesOwner\CreatePremisesOwners::class)
                    ->name('admin.publication-premises.premises-owner.create');
                 Route::get('/edit/{id}', \App\Livewire\Admin\PublicationPremises\PremisesOwner\EditPremisesOwners::class) //--> Note by SON: The route Route::get('/edit/{id}', EditPremisesOwners::class) is not required,
                    ->name('admin.publication-premises.premises-owner.edit');                                                // unless you want a dedicated edit page (not just a modal).

                //Route::get('/edit/{uuid}', EditPremisesOwners::class)
                    //->name('premises-owners.edit');

                 Route::get('/view/{id}', \App\Livewire\Admin\PublicationPremises\PremisesOwner\ViewPremisesOwners::class)
                     ->name('admin.publication-premises.premises-owner.view');
                Route::get('/{id}/manage', \App\Livewire\Admin\PublicationPremises\PremisesOwner\ManagePremises::class)
                     ->name('admin.publication-premises.premises-owner.manage');

                Route::group(['prefix' => '/{id}/publication-premises', 'middleware' => []], function () {
                    Route::get('/', \App\Livewire\Admin\PublicationPremises\PublicationPremises\PublicationPremisesTable::class)
                        ->name('admin.publication-premises.premises');
                    Route::get('/register', \App\Livewire\Admin\PublicationPremises\PublicationPremises\CreatePublicationPremises::class)
                        ->name('admin.publication-premises.premises.create');
                });

                Route::group(['prefix' => '/{id}/manage-classifications', 'middleware' => []], function () {
                    Route::get('/', \App\Livewire\Admin\Classifications\Classification\ClassificationTable::class)
                        ->name('admin.classifications.classified-items');
                });
            });

            // Publication Premises
        Route::prefix('publication-premises')
            ->group(function () {
                /* Route::get('/', \App\Livewire\Admin\PublicationPremises\PublicationPremises\PublicationPremisesTable::class)
                    ->name('admin.publication-premises.premises');
                Route::get('/register', \App\Livewire\Admin\PublicationPremises\PublicationPremises\CreatePublicationPremises::class)
                    ->name('admin.publication-premises.premises.create');*/
                Route::get('/edit/{id}', \App\Livewire\Admin\PublicationPremises\PublicationPremises\EditPublicationPremises::class)
                    ->name('admin.publication-premises.premises.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\PublicationPremises\PublicationPremises\ViewPublicationPremises::class)
                    ->name('admin.publication-premises.premises.view');
            });

        /*
        Route::group(['prefix' => '/{id}/publication-premises', 'middleware' => []], function () {
            Route::get('/', \App\Livewire\Admin\PublicationPremises\PublicationPremises\PublicationPremisesTable::class)
                    ->name('admin.publication-premises.premises');
        });
        */
        Route::prefix('manage-classifications')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Classifications\ManageClassifications::class)
                    ->name('admin.classifications.manage-classifications');
                //Route::get('/create', \App\Livewire\Admin\Classifications\Classification\CreateClassification::class)
                 //   ->name('admin.classifications.create-classification');

                // Films
                Route::prefix('films')
                    ->group(function () {
                        Route::get('/classify/{film:slug}', \App\Livewire\Admin\Classifications\Classification\CreateClassification::class)
                        ->name('admin.classifications.create-classification');
                    });
            });


        // Routing for Managing Classifications per Client
        Route::prefix('/{id}/manage-classifications')
            ->group(function () {
                 Route::get('/', \App\Livewire\Admin\Classifications\Classification\ClassificationTable::class)
                    ->name('admin.classifications.classified-items');

                // Films
                Route::prefix('films')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Films\FilmTable::class)
                            ->name('admin.classifications.films');
                        Route::get('/{film:slug}', \App\Livewire\Admin\Classifications\Films\ViewFilm::class)
                            ->name('admin.classifications.films.show');
                    });

                // TV Series
                Route::prefix('tv-series')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\TvSeries\TvSeriestable::class)
                            ->name('admin.classifications.tv-series');
                            Route::get('/{tv-series:slug}', \App\Livewire\Admin\Classifications\TvSeries\ViewTvSeries::class)
                            ->name('admin.classifications.tv-series.show');
                    });

                // Video Games
                Route::prefix('video-games')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\VideoGame\VideoGameTable::class)
                            ->name('admin.classifications.video-games');
                    });

                // Audio
                Route::prefix('audios')
                    ->group(function () {
                        // Routing for audio here
                    });


                // TV Ads
                Route::prefix('tv-ads')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Advertisement\AdvertisementTable::class)
                            ->name('admin.classifications.tv-ads');
                });

                // Literature Books
                Route::prefix('literatures')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Literature\LiteratureTable::class)
                            ->name('admin.classifications.literatures');
                });

            });

        //Route::get('/{id}/manage-classifications', \App\Livewire\Admin\Classifications\ManageClassifications::class)
        //    ->name('admin.classifications.manage-classifications');

        //Route::get('/manage-classifications', \App\Livewire\Admin\Classifications\ManageClassifications::class)
        //    ->name('admin.classifications.manage-classifications');

        // Sidebar routing for Classifications
        Route::get('/film-types', \App\Livewire\Admin\Classifications\FilmType\FilmTypeTable::class)
            ->name('admin.classifications.film-types');

        Route::prefix('manage-films-publications')
            ->group(function () {
                // Films
                Route::prefix('films')
                ->group(function () {
                    Route::get('/', \App\Livewire\Admin\Classifications\Films\FilmTable::class)
                        ->name('admin.classifications.films');
                    Route::get('/create', [\App\Http\Controllers\Admin\Classifications\FilmController::class, 'create'])
                        ->name('admin.classifications.films.create');
                    Route::get('/{film:slug}', \App\Livewire\Admin\Classifications\Films\ViewFilm::class)
                        ->name('admin.classifications.films.show');
                    /*
                    Route::get('/edit/{film}', \App\Livewire\Admin\Classifications\Films\EditFilm::class)
                        ->name('admin.classifications.films.edit');
                    */
                });

                // TV Series
                Route::prefix('tv-series')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\TvSeries\TvSeriestable::class)
                            ->name('admin.classifications.tv-series');
                        Route::get('/titles', \App\Livewire\Admin\Classifications\TvSeries\TvSeriesTitleTable::class)
                            ->name('admin.classifications.tv-series-title');
                        Route::get('/{tv-series:slug}', \App\Livewire\Admin\Classifications\TvSeries\ViewTvSeries::class)
                        ->name('admin.classifications.tv-series.show');
                        Route::get('/create', [\App\Http\Controllers\Admin\Classifications\TvSeriesController::class, 'create'])
                            ->name('admin.classifications.tv-series.create');
                        //Route::get('/edit/{id}', \App\Livewire\Admin\Classifications\TvSeries\EditTvSeries::class)
                            //->name('admin.classifications.tv-series.edit');
                        //Route::get('/view/{id}', \App\Livewire\Admin\Classifications\TvSeries\ViewTvSeries::class)
                            //->name('admin.classifications.tv-series.view');
                    });

                    // Video Games
                Route::prefix('video-games')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\VideoGame\VideoGameTable::class)
                            ->name('admin.classifications.video-games');
                    });

                // Audio
                Route::prefix('audios')
                    ->group(function () {
                        // Routing for audio here
                    });

                // TV Ads
                Route::prefix('tv-ads')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Advertisement\AdvertisementTable::class)
                            ->name('admin.classifications.tv-ads');
                });

                // Literature Books
                Route::prefix('literatures')
                    ->group(function () {
                        Route::get('/', \App\Livewire\Admin\Classifications\Literature\LiteratureTable::class)
                            ->name('admin.classifications.literatures');
                });
            });


        /*Route::get('/films', \App\Livewire\Admin\Classifications\Films\FilmTable::class)
            ->name('admin.classifications.films');
        Route::get('/films/{film}', \App\Livewire\Admin\Classifications\Films\ViewFilm::class)
            ->name('admin.classifications.films.show');
        */

        //Route::get('/{id}/classified-items', \App\Livewire\Admin\Classifications\Classification\ClassificationTable::class)
         //   ->name('admin.classifications.classified-items');
    }
);
require __DIR__.'/auth.php';
