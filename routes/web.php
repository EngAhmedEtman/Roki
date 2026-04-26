<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\SettingController;

// Landing Page
Route::get('/', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Design::where('is_active', true)->latest();

    if ($request->ajax()) {
        $designs = $query->paginate(8);
        $items = collect($designs->items())->map(function($design) {
            $design->img_url = $design->image ? \Illuminate\Support\Facades\Storage::url($design->image) : null;
            return $design;
        });
        return response()->json([
            'designs' => $items,
            'has_more' => $designs->hasMorePages()
        ]);
    }

    $designs = $query->paginate(8);
    $settings = \App\Models\Setting::pluck('value', 'key');
    return view('welcome', compact('designs', 'settings'));
})->name('home');

Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// API/Tracking
Route::post('/track', [App\Http\Controllers\Api\AnalyticsController::class, 'track'])->name('track');

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::resource('designs', DesignController::class);
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::patch('messages/{message}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.read');
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
