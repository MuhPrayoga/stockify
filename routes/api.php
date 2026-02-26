    
    <?php

    use Illuminate\Support\Facades\Route;

    Route::middleware('api')->group(function () {
        //
    });
    
    // <?php

    // use Illuminate\Support\Facades\Route;
    // use App\Http\Controllers\ProductController;
    // use App\Http\Controllers\StockTransactionController;
    // use App\Http\Controllers\StockReportController;
    // use App\Http\Controllers\CategoryController;
    // use App\Http\Controllers\ProductAttributeController;
    // use App\Http\Controllers\SupplierController;
    // use App\Http\Controllers\ActivityLogController;
    // use App\Http\Controllers\StockOpnameController;
    // use App\Http\Controllers\AdminDashboardController;
    // use App\Http\Controllers\ManagerDashboardController;
    // use App\Http\Controllers\StaffDashboardController;
    // use App\Http\Controllers\ChartController;
    // use App\Http\Controllers\UserController;
    // use App\Http\Controllers\DashboardController;
    // use App\Http\Controllers\AttributeController;
    // use App\Http\Controllers\AppSettingController;
    // use App\Http\Controllers\AuthController;

    // // ================= AUTHENTICATED =================
    // Route::middleware('auth')->group(function () {

    //     // App settings
    //     Route::get('/app-settings', [AppSettingController::class, 'show']);
    //     Route::post('/app-settings', [AppSettingController::class, 'update']);

    //     Route::post('/logout', [AuthController::class, 'logout']);
    //     Route::get('/me', [AuthController::class, 'me']);
    //     Route::get('/my-activity-logs', [ActivityLogController::class, 'myLogs']);
    //     Route::get('/activity-logs', [ActivityLogController::class, 'index']);

    //     // ================= PRODUK (READ ONLY SEMUA USER) =================
    //     Route::get('/products', [ProductController::class, 'index']);
    //     Route::get('/products/{product}', [ProductController::class, 'show']);
    //     Route::get('/products/{id}/attributes', [ProductAttributeController::class, 'index']);

    //     // ================= STAFF GUDANG =================
    //     Route::middleware('role:Staff Gudang')->group(function () {
    //         Route::get('/dashboard/staff', [StaffDashboardController::class, 'index']);
    //         Route::post('/stock/in', [StockTransactionController::class, 'storeIncoming']);
    //         Route::post('/stock/out', [StockTransactionController::class, 'storeOutgoing']);

    //         // Riwayat transaksi sendiri
    //         Route::get('/my-stock-transactions', [StockTransactionController::class, 'myTransactions']);
    //     });

    //     // ================= MANAGER GUDANG =================
    //     Route::middleware('role:Manajer Gudang')->group(function () {
    //         Route::get('/dashboard/manager', [ManagerDashboardController::class, 'index']);
    //         Route::post('/products/{id}/attributes', [ProductAttributeController::class, 'store']);
    //         Route::put('/product-attributes/{id}', [ProductAttributeController::class, 'update']);
    //         Route::delete('/product-attributes/{id}', [ProductAttributeController::class, 'destroy']);
    //         Route::post('/stock-opname', [StockOpnameController::class, 'store']);
    //     });

    //     // ================= ADMIN =================
    //     Route::middleware('role:Admin')->group(function () {
    //         Route::get('/dashboard/admin', [AdminDashboardController::class, 'index']);
    //         Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    //         // category management
    //         Route::get('/categories', [CategoryController::class, 'index']);
    //         Route::get('/categories/{id}', [CategoryController::class, 'show']);
    //         Route::post('/categories', [CategoryController::class, 'store']);
    //         Route::put('/categories/{id}', [CategoryController::class, 'update']);
    //         Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    //         // attribute management
    //         Route::get('/attributes', [AttributeController::class, 'index']);
    //         Route::get('/attributes/{id}', [AttributeController::class, 'show']);
    //         Route::post('/attributes', [AttributeController::class, 'store']);
    //         Route::put('/attributes/{id}', [AttributeController::class, 'update']);
    //         Route::delete('/attributes/{id}', [AttributeController::class, 'destroy']);

    //         // supplier management

    //         // user management
    //         Route::get('/users', [UserController::class, 'index']);
    //         Route::get('/users/{id}', [UserController::class, 'show']);
    //         Route::put('/users/{id}', [UserController::class, 'update']);
    //         Route::put('/users/{id}/activate', [UserController::class, 'activate']);
    //         Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate']);

    //         // Dashboard chart data
    //         Route::get('/charts/stock-transactions', [AdminDashboardController::class, 'stockChart']);
    //         Route::get('/charts/products-category', [AdminDashboardController::class, 'productCategoryChart']);
    //         Route::get('/charts/low-stock', [AdminDashboardController::class, 'lowStockChart']);
    //     });

    //     // ================= MANAGER + ADMIN =================
    //     Route::middleware('role:Manajer Gudang,Admin')->group(function () {

    //         // Chart data
    //         Route::get('/charts/stock-transactions', [ChartController::class, 'stockTransactionsChart']);
    //         Route::get('/charts/stock-by-category', [ChartController::class, 'stockByCategory']);
    //         Route::get('/charts/user-activities', [ChartController::class, 'userActivities']);
    //         Route::get('/charts/product-stock-history/{product_id}', [ChartController::class, 'productStockHistory']);

    //         // Supplier management
    //         Route::get('/suppliers', [SupplierController::class, 'index']);

    //         // Produk management
    //         Route::post('/products', [ProductController::class, 'store']);
    //         Route::put('/products/{product}', [ProductController::class, 'update']);

    //         // Stock Opname
    //         Route::get('/stock-opname', [StockOpnameController::class, 'index']);

    //         // Approval flow
    //         Route::post('/stock/{id}/approve', [StockTransactionController::class, 'approve']);
    //         Route::post('/stock/{id}/reject', [StockTransactionController::class, 'reject']);

    //         // Monitoring
    //         Route::get('/stock-transactions', [StockTransactionController::class, 'index']);
    //         Route::get('/stock-transactions/{id}', [StockTransactionController::class, 'show']);

    //         // Reports
    //         Route::get('/reports/stock', [StockReportController::class, 'stockReport']);
    //         Route::get('/reports/transactions', [StockReportController::class, 'transactionReport']);
    //         Route::get('/reports/low-stock', [StockReportController::class, 'lowStock']);
    //         Route::get('/reports/activity-logs', [ActivityLogController::class, 'index']);
    //     });
    // });
