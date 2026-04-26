<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\SettingController;

use App\Models\Design;
use App\Models\Setting;

Route::get('/', function () {
    $designs = Design::where('is_active', true)->latest()->paginate(10);
    $settings = Setting::pluck('value', 'key')->toArray();
    
    if (request()->ajax()) {
        return response()->json([
            'designs' => $designs->items(),
            'has_more' => $designs->hasMorePages()
        ]);
    }

    return view('welcome', compact('designs', 'settings'));
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Designs
    Route::resource('designs', DesignController::class);
    
    // Messages
    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{id}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{id}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
