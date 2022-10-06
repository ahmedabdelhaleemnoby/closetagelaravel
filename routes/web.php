<?php

use App\Http\Controllers\Admin\AboutFeatureController;
use App\Http\Controllers\Admin\AboutsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MainFeatureController;
use App\Http\Controllers\Admin\ProductsController;
use App\Models\MainFeature;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/register', [App\Http\Controllers\User\RegisterController::class, 'register']);
// Route::post('/register', [App\Http\Controllers\User\RegisterController::class, 'submit']);
Route::get('/product/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'show']);
Route::resource('carts', ProductsController::class);
Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'home']);

    Route::get('/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'showLoginForm']);

    Route::post('/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'login']);

    Route::get('/logout', [App\Http\Controllers\AdminAuth\LoginController::class, 'logout']);

    Route::get('/add/admin', [App\Http\Controllers\Admin\admin\AdminController::class, 'addAdmin']);
    Route::post('/add/admin', [App\Http\Controllers\Admin\admin\AdminController::class, 'addAdmin']);
    Route::get('/admins', [App\Http\Controllers\Admin\admin\AdminController::class, 'admins']);
    Route::get('/edit/admin/{id}', [App\Http\Controllers\Admin\admin\AdminController::class, 'edit']);
    Route::post('/edit/admin/{id}', [App\Http\Controllers\Admin\admin\AdminController::class, 'edit']);
    Route::get('/delete/admin/{id}', [App\Http\Controllers\Admin\admin\AdminController::class, 'delete']);

    Route::get('/add/image', [App\Http\Controllers\Admin\image\ImageController::class, 'addImage']);
    Route::post('/add/image', [App\Http\Controllers\Admin\image\ImageController::class, 'addImage']);
    Route::get('/images', [App\Http\Controllers\Admin\image\ImageController::class, 'images']);
    Route::get('/edit/image/{id}', [App\Http\Controllers\Admin\image\ImageController::class, 'edit']);
    Route::post('/edit/image/{id}', [App\Http\Controllers\Admin\image\ImageController::class, 'edit']);
    Route::get('/delete/image/{id}', [App\Http\Controllers\Admin\image\ImageController::class, 'delete']);


    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);



    Route::resource('about', AboutsController::class);
    Route::resource('about/{id}/features', AboutFeatureController::class);

    Route::resource('mainFeature', MainFeatureController::class);
    Route::resource('features', FeatureController::class);


    // Route::resource('about/features', AboutFeatureController::class);
    // Route::get('about/{id}/features/create', 'AboutFeatureController@store');
    // Route::post('about/{id}/features.store', 'AboutFeatureController@store');
    // Route::post('store', 'AboutFeatureController@store')->name("features.store");
    // Route::get('/register', [App\Http\Controllers\AdminAuth\RegisterController::class, 'showRegistrationForm']);
    // Route::post('/register', [App\Http\Controllers\AdminAuth\RegisterController::class, 'register']);


    Route::post('/password/email', [App\Http\Controllers\AdminAuth\ForgotPasswordController::class, 'sendResetLinkEmail']);

    Route::post('/password/reset', [App\Http\Controllers\AdminAuth\ResetPasswordController::class, 'reset']);

    Route::get('/password/reset', [App\Http\Controllers\AdminAuth\ForgotPasswordController::class, 'showLinkRequestForm']);

    Route::get('/password/reset', [App\Http\Controllers\AdminAuth\ResetPasswordController::class, 'showResetForm']);
});
