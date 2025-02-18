<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsActive;
use App\Livewire\Logs;
use App\Livewire\Main;
use App\Livewire\Organizations\OrganizationsForm;
use App\Livewire\Organizations\OrganizationsIndex;
use App\Livewire\Permissions\PermissionsIndex;
use App\Livewire\Roles\RolePermissions;
use App\Livewire\Roles\RolesForm;
use App\Livewire\Roles\RolesIndex;
use App\Livewire\Tesst;
use App\Livewire\Users\UsersForm;
use App\Livewire\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('livewire.Main');
// });

Route::middleware(['auth', EnsureUserIsActive::class])->group(function () {
    Route::get('/main', Main::class)->name('Main');
    Route::get('/users', UsersIndex::class)->name('users');
    Route::get('/usersform', UsersForm::class)->name('users-form');
    Route::get('/org', OrganizationsIndex::class)->name('org');
    Route::get('/org-form', OrganizationsForm::class)->name('org-form');
    Route::get('/logs', Logs::class)->name('logs');
    Route::get('/permission', PermissionsIndex::class)->name('permission');
    Route::get('/roles', RolesIndex::class)->name('role');
    Route::get('/tesst', Tesst::class)->name('tesst');
    Route::get('/perission', PermissionsIndex::class)->name('permission');
    Route::get('/rolesform', RolesForm::class)->name('role-form');
    Route::get('/roles/{roleId}/permissions', RolePermissions::class)->name('role-permissions');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
