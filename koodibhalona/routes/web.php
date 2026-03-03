<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\CustomTranslation;

use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\AdminAuth;

// Frontend Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');

Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Admin Login (public)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->middleware(AdminAuth::class)->group(function() {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');
    Route::get('/about-page', [AdminController::class, 'about'])->name('admin.about');
    Route::post('/about-page', [AdminController::class, 'aboutUpdate'])->name('admin.about.update');
    Route::get('/translations', [AdminController::class, 'translations'])->name('admin.translations.index');
    Route::post('/translations', [AdminController::class, 'translationsStore'])->name('admin.translations.store');
    Route::put('/translations/{id}', [AdminController::class, 'translationsUpdate'])->name('admin.translations.update');
    Route::patch('/translations/{id}/toggle', [AdminController::class, 'translationsToggle'])->name('admin.translations.toggle');
    Route::delete('/translations/{id}', [AdminController::class, 'translationsDestroy'])->name('admin.translations.destroy');
    Route::get('/objectives', [AdminController::class, 'objectives'])->name('admin.objectives');
    Route::post('/objectives', [AdminController::class, 'objectivesUpdate'])->name('admin.objectives.update');
    Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners');
    Route::post('/banners', [AdminController::class, 'bannersUpdate'])->name('admin.banners.update');

    // Services Management
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    // Gallery Management
    Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class)->names([
        'index' => 'admin.gallery.index',
        'create' => 'admin.gallery.create',
        'store' => 'admin.gallery.store',
        'edit' => 'admin.gallery.edit',
        'update' => 'admin.gallery.update',
        'destroy' => 'admin.gallery.destroy',
    ]);

    // Teams Management
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class)->names([
        'index' => 'admin.teams.index',
        'create' => 'admin.teams.create',
        'store' => 'admin.teams.store',
        'edit' => 'admin.teams.edit',
        'update' => 'admin.teams.update',
        'destroy' => 'admin.teams.destroy',
    ]);
});

// API Routes for Dynamic Translations (No Authentication Required)
Route::get('/api/translations', function(Request $request) {
    $lang = $request->query('lang', 'kn');
    return \App\Models\CustomTranslation::forLanguage($lang);
})->name('api.translations');

Route::get('/api/translations/all', function() {
    $rows = CustomTranslation::where('is_hidden', false)->get();
    $result = [];
    foreach ($rows as $row) {
        $result[$row->english_word] = [
            'kn' => $row->kannada_word,
            'te' => $row->telugu_word,
            'hi' => $row->hindi_word,
            'ta' => $row->tamil_word,
        ];
    }
    return response()->json($result);
})->name('api.translations.all');

Route::get('/api/translations/check-updates', function(Request $request) {
    $since = $request->query('since', 0);
    $latest = CustomTranslation::where('is_hidden', false)
        ->latest('updated_at')
        ->first();
    
    $hasUpdates = $latest && strtotime($latest->updated_at) > ($since / 1000);
    
    return response()->json([
        'hasUpdates' => $hasUpdates,
        'lastUpdate' => $latest ? strtotime($latest->updated_at) * 1000 : 0
    ]);
})->name('api.translations.check');
