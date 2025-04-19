<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    DashboardController,
    SecurityAlertsController,
    VisitorController,
    VisitorManagementController,
    ResidentDirectoryController,
    ResidentController,
    AnalyticsController,
    GuestController,
    TableController,
    CheckinController,
    HomeController,
    UserController,
    ProfileController,
    PageController,
    FileUploadController
};

Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Guest Routes
Route::get('/guest', [GuestController::class, 'index'])->name('guest');
Route::post('/guest/upload', [GuestController::class, 'uploadVisitorDetails'])->name('guest.upload');

// Security Routes
Route::get('/securityAlerts', [SecurityAlertsController::class, 'index'])->name('securityAlerts');

// Resident Routes
Route::prefix('resident')->group(function () {
    Route::get('/directory', [ResidentDirectoryController::class, 'index'])->name('resident.directory');
    Route::get('/create', [ResidentController::class, 'create'])->name('resident.create');
    Route::post('/store', [ResidentController::class, 'store'])->name('resident.store');
});

// Visitor Management Routes
Route::prefix('visitor')->group(function () {
    Route::get('/management', [VisitorManagementController::class, 'index'])->name('visitor.management');
    Route::post('/store', [VisitorController::class, 'store'])->name('visitor.store');
});

// Check-in Routes
Route::prefix('checkin')->group(function () {
    Route::get('/', [CheckinController::class, 'index'])->name('checkin');
    Route::post('/send-email', [VisitorManagementController::class, 'sendEmail'])->name('checkin.send-email');
});

// Other Public Routes
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/tables', [TableController::class, 'retrieveTableInformation'])->name('tables');
Route::post('/upload-files', [FileUploadController::class, 'uploadFiles'])->name('upload.files');

Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/details', [HomeController::class, 'details'])->name('details');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/password', [ProfileController::class, 'password'])->name('profile.password');
    });

    // User Management Routes
    Route::resource('users', UserController::class)->except(['show']);
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['auth'])->get('{page}', [PageController::class, 'index'])->name('page.index');
