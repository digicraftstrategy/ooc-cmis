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
        Route::prefix('rated-films-publications')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Classifications\Classification\ClassificationTable::class)
                    ->name('admin.classifications.classified-items');
                Route::get('/create', \App\Livewire\Admin\Classifications\Classification\CreateClassification::class)
                    ->name('admin.classifications.classified-items.create');

            });

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
                Route::get('/create', \App\Livewire\Admin\Classifications\VideoGame\CreateVideoGame::class)
                    ->name('admin.classifications.video-games.create');
                Route::get('/edit/{game}', \App\Livewire\Admin\Classifications\VideoGame\EditVideoGame::class)
                    ->name('admin.classifications.video-games.edit');
                Route::get('/{game:slug}', \App\Livewire\Admin\Classifications\VideoGame\ViewVideoGame::class)
                    ->name('admin.classifications.video-games.view');
            });

        // TV Ads
        Route::prefix('advertisements')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Classifications\Advertisement\AdvertisementTable::class)
                    ->name('admin.classifications.advertisements');
                /*Route::get('/{advert:slug}', \App\Livewire\Admin\Classifications\Advertisement\ViewAdvertisement::class)
                    ->name('admin.classifications.advertisement.show');*/
                Route::get('/create', \App\Livewire\Admin\Classifications\Advertisement\CreateAdvertisement::class)
                    ->name('admin.classifications.advertisement.create');
                Route::get('/edit/{id}', \App\Livewire\Admin\Classifications\Advertisement\EditAdvertisement::class)
                    ->name('admin.classifications.advertisement.edit');
                Route::get('/view/{id}', \App\Livewire\Admin\Classifications\Advertisement\ViewAdvertisement::class)
                    ->name('admin.classifications.advertisement.view');
                /*Route::get('/{advert:slug}', App\Livewire\Admin\Classifications\Advertisement\ViewAdvertisement::class)
                    ->name('admin.classifications.advertisement.show');*/
        });

        // Literature Books
        Route::prefix('literatures')
            ->group(function () {
                Route::get('/', \App\Livewire\Admin\Classifications\Literature\LiteratureTable::class)
                    ->name('admin.classifications.literatures');
                Route::get('/create', \App\Livewire\Admin\Classifications\Literature\CreateLiterature::class)
                    ->name('admin.classifications.literatures.create');
                Route::get('/edit/{literature}', \App\Livewire\Admin\Classifications\Literature\EditLiterature::class)
                    ->name('admin.classifications.literatures.edit');
                Route::get('/{literature:slug}', \App\Livewire\Admin\Classifications\Literature\ViewLiterature::class)
                    ->name('admin.classifications.literatures.view');
            });

        // Audio
        Route::prefix('audios')
            ->group(function () {
                // Routing for audio here
            });
    }
);

// Invoices
    Route::prefix('invoices')
        ->group(function() {
            Route::get('/', \App\Livewire\Admin\Invoices\InvoiceTable::class)
                ->name('admin.invoices.list');

        });
