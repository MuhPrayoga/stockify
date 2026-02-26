<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AppSettingController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| JSON DATA ROUTES (API STYLE - SESSION BASED)
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| APP SETTINGS
|--------------------------------------------------------------------------
*/
Route::get('/app-settings', [AppSettingController::class, 'show']);
Route::post('/app-settings', [AppSettingController::class, 'update']);


/*
|--------------------------------------------------------------------------
| USER & AUTH
|--------------------------------------------------------------------------
*/
Route::get('/me', [AuthController::class, 'me']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::put('/users/{id}/activate', [UserController::class, 'activate']);
Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate']);


/*
|--------------------------------------------------------------------------
| ACTIVITY LOGS
|--------------------------------------------------------------------------
*/
Route::get('/activity-logs', [ActivityLogController::class, 'index']);
Route::get('/my-activity-logs', [ActivityLogController::class, 'myLogs']);


/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware(['auth', 'role:Admin,Manajer Gudang'])->group(function () {

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});


/*
|--------------------------------------------------------------------------
| CATEGORIES
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| ATTRIBUTES (MASTER)
|--------------------------------------------------------------------------
*/
Route::get('/attributes', [AttributeController::class, 'index']);
Route::get('/attributes/{id}', [AttributeController::class, 'show']);
Route::post('/attributes', [AttributeController::class, 'store']);
Route::put('/attributes/{id}', [AttributeController::class, 'update']);
Route::delete('/attributes/{id}', [AttributeController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| PRODUCT ATTRIBUTES (MANAGER ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Manajer Gudang'])->group(function () {

    // List semua product attributes
    Route::get('/product-attributes', [ProductAttributeController::class, 'list']);

    // Ambil attributes untuk 1 product
    Route::get('/products/{productId}/attributes', [ProductAttributeController::class, 'index']);

    // Store / Update attributes
    Route::post('/products/{productId}/attributes', [ProductAttributeController::class, 'store']);

    // Summary
    Route::get('/product-attributes-summary', [ProductAttributeController::class, 'summary']);

    // Ambil attributes + value untuk 1 product
    Route::get('/products/{productId}/attributes', [ProductAttributeController::class, 'getByProduct']);

    // Simpan / update
    Route::post('/products/{productId}/attributes', [ProductAttributeController::class, 'storeOrUpdate']);


});


/*
|--------------------------------------------------------------------------
| SUPPLIERS
|--------------------------------------------------------------------------
*/
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| STOCK TRANSACTIONS
|--------------------------------------------------------------------------
*/
Route::middleware('role:Staff Gudang')->group(function () {

    Route::post('/stock/in', [StockTransactionController::class, 'storeIncoming']);
    Route::post('/stock/out', [StockTransactionController::class, 'storeOutgoing']);
});

Route::middleware('role:Admin,Manajer Gudang,Staff Gudang')->group(function () {

    Route::get('/stock-transactions', [StockTransactionController::class, 'index']);
    Route::get('/stock-transactions/{id}', [StockTransactionController::class, 'show']);

    Route::post('/stock/{id}/approve', [StockTransactionController::class, 'approve']);
    Route::post('/stock/{id}/complete', [StockTransactionController::class, 'complete']);
    Route::post('/stock/{id}/reject', [StockTransactionController::class, 'reject']);
});


/*
|--------------------------------------------------------------------------
| STOCK OPNAME
|--------------------------------------------------------------------------
*/
Route::get('/stock-opname', [StockOpnameController::class, 'index']);
Route::post('/stock-opname', [StockOpnameController::class, 'store']);


/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
*/
Route::get('/reports/stock', [StockReportController::class, 'stockReport']);
Route::get('/reports/transactions', [StockReportController::class, 'transactionReport']);
Route::get('/reports/low-stock', [StockReportController::class, 'lowStock']);
Route::get('/reports/activity-logs', [ActivityLogController::class, 'index']);


/*
|--------------------------------------------------------------------------
| CHARTS
|--------------------------------------------------------------------------
*/
Route::get('/charts/stock-transactions', [ChartController::class, 'stockTransactionsChart']);
Route::get('/charts/stock-by-category', [ChartController::class, 'stockByCategory']);
Route::get('/charts/user-activities', [ChartController::class, 'userActivities']);
Route::get('/charts/product-stock-history/{product_id}', [ChartController::class, 'productStockHistory']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (SESSION BASED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:Admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | DASHBOARD
            |--------------------------------------------------------------------------
            */
            Route::get('/dashboard', fn () =>
                view('pages.admin.dashboard')
            )->name('dashboard');

            Route::get('/dashboard/data', [AdminDashboardController::class, 'index']);


            /*
            |--------------------------------------------------------------------------
            | PRODUCTS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('products')->name('products.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.admin.products.index')
                )->name('index');

                Route::get('/create', fn () =>
                    view('pages.admin.products.create')
                )->name('create');

                Route::get('/edit/{id}', fn ($id) =>
                    view('pages.admin.products.edit', compact('id'))
                )->name('edit');


                /*
                |------------------------------------------
                | CATEGORIES
                |------------------------------------------
                */
                Route::prefix('categories')->name('categories.')->group(function () {

                    Route::get('/create', fn () =>
                        view('pages.admin.products.categories.create')
                    )->name('create');

                    Route::get('/edit/{id}', fn ($id) =>
                        view('pages.admin.products.categories.edit', compact('id'))
                    )->name('edit');
                });


                /*
                |------------------------------------------
                | ATTRIBUTES
                |------------------------------------------
                */
                Route::prefix('attributes')->name('attributes.')->group(function () {

                    Route::get('/create', fn () =>
                        view('pages.admin.products.attributes.create')
                    )->name('create');

                    Route::get('/edit/{id}', fn ($id) =>
                        view('pages.admin.products.attributes.edit', compact('id'))
                    )->name('edit');
                });

            });


            /*
            |--------------------------------------------------------------------------
            | STOCKS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('stocks')->name('stock.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.admin.stock.index')
                )->name('index');

                Route::get('/opname/create', fn () =>
                    view('pages.admin.stock.opnames.create')
                )->name('stocks.opname.create');

            });


            /*
            |--------------------------------------------------------------------------
            | SUPPLIERS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('suppliers')->name('suppliers.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.admin.suppliers.index')
                )->name('index');

                Route::get('/create', fn () =>
                    view('pages.admin.suppliers.createSupplier')
                )->name('create');

                Route::get('/{id}/edit', fn ($id) =>
                    view('pages.admin.suppliers.editSupplier', compact('id'))
                )->name('edit');
            });


            /*
            |--------------------------------------------------------------------------
            | USERS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('users')->name('users.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.admin.users.index')
                )->name('index');

                Route::get('/edit/{id}', fn ($id) =>
                    view('pages.admin.users.editUser', compact('id'))
                )->name('edit');
            });


            /*
            |--------------------------------------------------------------------------
            | REPORTS
            |--------------------------------------------------------------------------
            */
            Route::get('/reports', fn () =>
                view('pages.admin.reports.index')
            )->name('reports.index');


            /*
            |--------------------------------------------------------------------------
            | SETTINGS
            |--------------------------------------------------------------------------
            */
            Route::get('/settings', fn () =>
                view('pages.admin.settings.index')
            )->name('settings.index');
        });



    /*
    |--------------------------------------------------------------------------
    | MANAGER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:Manajer Gudang')
        ->prefix('manager')
        ->name('manager.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | DASHBOARD
            |--------------------------------------------------------------------------
            */
            Route::get('/dashboard', fn () =>
                view('pages.manager.dashboard')
            )->name('dashboard');

            Route::get('/dashboard/data', [ManagerDashboardController::class, 'index']);


            /*
            |--------------------------------------------------------------------------
            | PRODUCTS (VIEW)
            |--------------------------------------------------------------------------
            */
             Route::prefix('products')->name('products.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.manager.products.index')
                )->name('index');

                Route::get('/create', fn () =>
                    view('pages.manager.products.create')
                )->name('create');

                Route::get('/edit/{id}', fn ($id) =>
                    view('pages.manager.products.edit', compact('id'))
                )->name('edit');

                Route::prefix('attributes')->name('attributes.')->group(function () {

                    Route::get('/edit/{productId}', fn ($productId) =>
                        view('pages.manager.products.productAttributes.edit', compact('productId'))
                    )->name('edit');

                });

            });

            /*
            |--------------------------------------------------------------------------
            | STOCKS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('stocks')->name('stocks.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.manager.stocks.index')
                )->name('index');

                Route::get('/opname/create', fn () =>
                    view('pages.manager.stocks.opnames.create')
                )->name('stocks.opname.create');
            });


            /*
            |--------------------------------------------------------------------------
            | SUPPLIERS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('suppliers')->name('suppliers.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.manager.suppliers.index')
                )->name('index');
            });


            /*
            |--------------------------------------------------------------------------
            | REPORTS (VIEW)
            |--------------------------------------------------------------------------
            */
            Route::prefix('reports')->name('reports.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.manager.reports.index')
                )->name('index');
            });

        });



    /*
    |--------------------------------------------------------------------------
    | STAFF ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:Staff Gudang')
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {

            Route::get('/dashboard', fn () =>
                view('pages.staff.dashboard')
            )->name('dashboard');

            Route::get('/dashboard/data', [StaffDashboardController::class, 'index']);

            Route::get('/tasks', fn () =>
                view('pages.staff.tasks')
            )->name('staff.tasks');

            Route::prefix('stocks')->name('stocks.')->group(function () {

                Route::get('/', fn () =>
                    view('pages.staff.stocks.index')
                )->name('index');

            });

        });

});