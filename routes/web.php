<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Authentication Routes (Login, Register, Password Reset)
Auth::routes();

// Public routes
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Home redirect - fixes the missing /home route
    Route::redirect('/home', '/dashboard');

    // Main dashboard router
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->isSecurity()) {
            return redirect()->route('security.dashboard');
        }
        if ($user->isResident()) {
            return redirect()->route('resident.dashboard');
        }

        // Fallback - shouldn't reach here but just in case
        return redirect('/');
    })->name('dashboard');

    // Profile Management Routes (for all authenticated users)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])
            ->name('profile.change-password');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])
            ->name('profile.update-password');
    });

    // Admin Routes
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
            ->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('apartments', ApartmentController::class);
    });

    // Security Routes
    Route::middleware(['can:security'])->group(function () {
        Route::get('/security/dashboard', [DashboardController::class, 'securityDashboard'])
            ->name('security.dashboard');
    });

    // Resident Routes
    Route::middleware(['can:resident'])->group(function () {
        Route::get('/resident/dashboard', [DashboardController::class, 'residentDashboard'])
            ->name('resident.dashboard');
        Route::get('/my-visitors', [VisitController::class, 'myVisitors'])
            ->name('my-visitors');
        Route::get('/schedule-visit', [VisitController::class, 'scheduleForm'])
            ->name('schedule-visit');
        Route::post('/schedule-visit', [VisitController::class, 'scheduleVisit'])
            ->name('schedule-visit.store');
    });

    Route::get('/visitors/search', [VisitorController::class, 'search'])
        ->name('visitors.search')
        ->middleware(['auth', 'can:admin,security']);

    Route::resource('residents', ResidentController::class)
        ->middleware(['auth', 'can:admin,security']);

    Route::resource('residents', ResidentController::class)
        ->middleware(['auth', 'can:admin,security']);

    Route::resource('apartments', ApartmentController::class)
        ->middleware(['auth', 'can:admin']);

    Route::put('/visitors/{visitor}/checkout', [VisitorController::class, 'checkout'])
        ->name('visitors.checkout')
        ->middleware(['auth', 'can:admin,security']);

    // Security and Admin shared routes
    Route::middleware(['can:admin,security'])->group(function () {
        Route::resource('residents', ResidentController::class);
        Route::resource('visitors', VisitorController::class);
        Route::resource('visits', VisitController::class);
        Route::post('visits/{visit}/check-in', [VisitController::class, 'checkIn'])
            ->name('visits.check-in');
        Route::post('visits/{visit}/check-out', [VisitController::class, 'checkOut'])
            ->name('visits.check-out');

        Route::prefix('reports')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('reports.index');
            Route::get('/visitors', [ReportController::class, 'visitors'])->name('reports.visitors');
            Route::get('/visits', [ReportController::class, 'visits'])->name('reports.visits');
            Route::get('/export/{type}', [ReportController::class, 'export'])->name('reports.export');
        });
    });
});
