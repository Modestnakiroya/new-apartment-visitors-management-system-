<?php
use App\Http\Controllers\SecurityAlertsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorManagementController;
use App\Http\Controllers\ResidentDirectoryController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\VisitorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can rgister web routes for your application. These
| routes are loaded by the RouteServieceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/upload-files', [FileUploadController::class, 'uploadFiles'])->name('upload.files');

Route::get('/securityAlerts', [SecurityAlertsController::class, 'index'])->name('securityAlerts');

Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitorManagement', [VisitorManagementController::class, 'index'])->name('visitorManagement');

Route::get('/residentDirectory', [ResidentDirectoryController::class, 'index'])->name('residentDirectory');

Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics');


Route::get('/guest', [App\Http\Controllers\GuestController::class, 'index'])->name('guest');

Route::post('/guest', [GuestController::class, 'uploadVisitorDetails'])->name('upload.files');


Route::get('/tables', [App\Http\Controllers\TableController::class, 'retrieveTableInformation'])->name('page.index');
Route::get('/checkin', [App\Http\Controllers\CheckinController::class, 'index'])->name('checkin');

Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');
Route::get('/details', 'App\Http\Controllers\HomeController@details')->name('details');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});




