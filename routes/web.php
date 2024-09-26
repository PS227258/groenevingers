<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\OAuthLoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostcodeController;
use App\Http\Middleware\EnsureRoleIsValid;
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

/* homepage routes */
Route::get("/", [HomepageController::class, "index"])->name("homepage.index");

/* shop routes */
Route::resource("/shop", ShopController::class)->only(["index", "show"]);

/* order routes */
Route::resource("/order", OrderController::class)->only(["index", "store"]);
Route::patch("/order", [OrderController::class, 'setCustomerInformation'])->name('order.setCustomerInformation');
Route::delete('/orderrow/{id}', [OrderController::class, 'destroyOrderrow'])->name('orderrow.destroy');

/* checkout routes */
Route::get("/checkout", [CheckoutController::class, 'index'])->name('checkout.index');

/* contact routes */
Route::get("/contact", function () {
    return view("contact");
})->name("contact.index");

/* pdf routes */
Route::get("/get-pdf", [DomPdfController::class, "getPdf"])->name("pdf.index");

/* Google OAuth routes */
Route::get('/google/redirect', [OAuthLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [OAuthLoginController::class, 'handleGoogleCallback'])->name('google.callback');

/* Github OAuth routes */
Route::get('/github/redirect', [OAuthLoginController::class, 'redirectToGithub'])->name('github.redirect');
Route::get('/github/callback', [OAuthLoginController::class, 'handleGithubCallback'])->name('github.callback');

/* Postcode routes */
Route::get('/postcode-lookup', [PostcodeController::class, 'showLookupForm'])->name('postcode.lookup.form');
Route::post('/postcode-lookup', [PostcodeController::class, 'lookup'])->name('postcode.lookup');

/* dashboard routes */
Route::get("/dashboard", [DashboardController::class, "index"])->middleware(["auth", "verified"])->name("dashboard");

/* routes only accessible to authenticated users */
Route::middleware("auth")->group(function () {
    /* - profile routes - */
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");

    /* - user routes - */
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get("/dashboard/users", [UserController::class, "index"])->name("users.index");

    /* - product routes - */
    Route::get("/dashboard/products", [ProductController::class, "index"])->name("products.index");
});

/* routes only accessible to Administrators, Accountants and Managers */
Route::middleware("auth", "verified", "role:Admin,Accountant,Manager")->group(function () {
    /* - user routes - */
    Route::resource("/dashboard/users", UserController::class)->except(["index", "show", "create", "store"]);

    /* - product routes - */
    Route::resource("/dashboard/products", ProductController::class)->except(["index"]);
});

/* routes only accessible to Administrators and Accountants */
Route::middleware(["auth", "verified", "role:Admin,Accountant"])->group(function () {
    /* - management routes - */
    Route::resource("/dashboard/management", ManagementController::class)->only(['index', 'show', 'create', 'store', 'update']);

    /* - order management routes - */
    Route::delete("/dashboard/orders/{id}/{rowId}", [OrderManagementController::class, "destroyOrderRow"])->name('orders.destroyOrderRow');
    Route::post("/dashboard/orders/updaterow/{id}", [OrderManagementController::class, "updateOrderRow"])->name('orders.updateOrderRow');
    Route::post("/dashboard/orders/update/{id}/{statusId}", [OrderManagementController::class, "updateStatus"])->name('orders.updateStatus');
    Route::post("/dashboard/orders/rollback/{id}/{statusId}", [OrderManagementController::class, "rollbackStatus"])->name('orders.rollbackStatus');
    Route::post("/dashboard/orders/{id}", [OrderManagementController::class, "cancelOrder"])->name('orders.cancelOrder');
    Route::get("/dashboard/orders/sort/{key}", [OrderManagementController::class, "sortOrders"])->name('orders.sortOrders');
    Route::patch("/dashboard/orders/update/{id}", [OrderManagementController::class, "updateOrderInformation"])->name('orders.updateOrderInformation');
    Route::resource("/dashboard/orders", OrderManagementController::class)->except(['create', 'store', 'update', 'destroy']);
});

require __DIR__ . "/auth.php";
