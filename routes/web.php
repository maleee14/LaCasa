<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Props\PropertiesController;
use App\Http\Controllers\Users\UserController;
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

Auth::routes();

Route::get('/', [PropertiesController::class, 'index'])->name('home');
Route::get('/home', [PropertiesController::class, 'index'])->name('home');

Route::group(['prefix' => 'properties'], function () {
    Route::get('detail/{id}', [PropertiesController::class, 'detail'])->name('property.detail');
    // Insert Request
    Route::post('detail/{id}', [PropertiesController::class, 'insertRequest'])->name('insert.request');
    // Save Favorite
    Route::post('favorites/{id}', [PropertiesController::class, 'saveFavorite'])->name('favorite.property');
    // Buy or Rent Page
    Route::get('buy', [PropertiesController::class, 'buyProperty'])->name('buy.property');
    Route::get('rent', [PropertiesController::class, 'rentProperty'])->name('rent.property');
    // Display Property By Home Type
    Route::get('home-type/{hometype}', [PropertiesController::class, 'displayHomeType'])->name('display.property.hometype');
    // Display Property By Price
    Route::get('price-asc', [PropertiesController::class, 'priceAsc'])->name('price.property.asc');
    Route::get('price-desc', [PropertiesController::class, 'priceDesc'])->name('price.property.desc');
    // Search Property
    Route::get('searches', [PropertiesController::class, 'searches'])->name('searches.property');
});

Route::group(['prefix' => 'users'], function () {
    // Show All Request
    Route::get('requests', [UserController::class, 'allRequests'])->name('users.requests');
    Route::delete('requests/{id}', [UserController::class, 'deleteRequests'])->name('delete.requests');
    // Show All Favorite
    Route::get('favorites', [UserController::class, 'allFavorites'])->name('users.favorites');
    Route::delete('favorites/{id}', [UserController::class, 'deleteFavorite'])->name('delete.favorite');
});

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/admin/login', [AdminController::class, 'login'])->name('admins.login')->middleware('check');
Route::post('/admin/check-login', [AdminController::class, 'check'])->name('admins.check');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('index', [AdminController::class, 'index'])->name('admins.dashboard');
    // Admin Section
    Route::get('admins', [AdminController::class, 'allAdmin'])->name('admins.all');
    Route::get('create-admins', [AdminController::class, 'createAdmins'])->name('admins.create');
    Route::post('store-admins', [AdminController::class, 'storeAdmins'])->name('admins.store');
    Route::get('edit-admins{id}', [AdminController::class, 'editAdmins'])->name('admins.edit');
    Route::put('update-admins{id}', [AdminController::class, 'updateAdmins'])->name('admins.update');
    Route::delete('delete-admins/{id}', [AdminController::class, 'deleteAdmins'])->name('admins.delete');
    // Home Types Section
    Route::get('hometypes', [AdminController::class, 'HomeTypes'])->name('admins.hometypes');
    Route::get('create-hometypes', [AdminController::class, 'createHomeTypes'])->name('hometypes.create');
    Route::post('store-hometypes', [AdminController::class, 'storeHomeTypes'])->name('hometypes.store');
    Route::get('edit-hometypes/{id}', [AdminController::class, 'editHomeTypes'])->name('hometypes.edit');
    Route::patch('update-hometypes/{id}', [AdminController::class, 'updateHomeTypes'])->name('hometypes.update');
    Route::delete('delete-hometypes/{id}', [AdminController::class, 'deleteHomeTypes'])->name('hometypes.delete');
    // Request Section
    Route::get('requests', [AdminController::class, 'allRequest'])->name('requests.all');
    // Properties Section
    Route::get('properties', [AdminController::class, 'allProperties'])->name('properties.all');
    Route::get('create-properties', [AdminController::class, 'createProperties'])->name('properties.create');
    Route::post('store-properties', [AdminController::class, 'storeProperties'])->name('properties.store');
    Route::delete('delete-properties/{id}', [AdminController::class, 'deleteProperties'])->name('properties.delete');
    Route::get('edit-properties/{id}', [AdminController::class, 'editProperties'])->name('properties.edit');
    Route::put('update-properties/{id}', [AdminController::class, 'updateProperties'])->name('properties.update');
    // Gallery Image
    Route::get('create-gallery', [AdminController::class, 'createGallery'])->name('gallery.create');
    Route::post('store-gallery', [AdminController::class, 'storeGallery'])->name('gallery.store');
});
