<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Middleware\EnsureUserIsActive;
use App\Livewire\AdminDashboard\Cases\CaseDonations;
use App\Livewire\AdminDashboard\Cases\Cases\CompletedCase;
use App\Livewire\AdminDashboard\Cases\Requests\AcceptedRequests as CasesAccepted;
use App\Livewire\AdminDashboard\Cases\Requests\AcceptedRequestsCards as CasesAcceptedCards;
// use App\Livewire\AdminDashboard\Cases\All\AllCasesIndex;
// use App\Livewire\AdminDashboard\Cases\OragnizationCases\OrganizationCasesIndex;
use App\Livewire\AdminDashboard\Cases\Requests\AdditionalRequestsForm;
use App\Livewire\AdminDashboard\Cases\Requests\RefinedRequests as CasesRefined;
use App\Livewire\AdminDashboard\Cases\Requests\Requests as CasesRequests;
// use App\Livewire\AdminDashboard\Cases\Requests\AdditionalRequestsIndex;
// use App\Livewire\AdminDashboard\Cases\Responses\AdditionalResponses;
use App\Livewire\AdminDashboard\Donations\DonationsList;
use App\Livewire\AdminDashboard\Donations\DonationsReport;
use App\Livewire\AdminDashboard\Logs;
use App\Livewire\AdminDashboard\Main;
use App\Livewire\AdminDashboard\Organizations\JoinRequests\JoinRequsts;
use App\Livewire\AdminDashboard\Organizations\OrganizationsForm;
use App\Livewire\AdminDashboard\Organizations\OrganizationsIndex;
use App\Livewire\AdminDashboard\Partners\PartnersForm;
use App\Livewire\AdminDashboard\Partners\PartnersIndex;
use App\Livewire\AdminDashboard\Projects\Requests\AcceptedRequests;
use App\Livewire\AdminDashboard\Projects\Requests\AcceptedRequestsCards;
use App\Livewire\AdminDashboard\Projects\Requests\RefinedRequests;
use App\Livewire\AdminDashboard\Projects\Requests\Requests;
use App\Livewire\AdminDashboard\Cases\Requests\Request;
use App\Livewire\AdminDashboard\Projects\Accepted\CompletedProject;
use App\Livewire\AdminDashboard\Users\UsersForm;
use App\Livewire\AdminDashboard\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

// Route::post('/stripe/webhook',[StripePaymentController::class , 'stripeWebhook'] );

Route::post('/theme/toggle', function () {
    $currentTheme = session('theme', 'dark');
    $newTheme = $currentTheme === 'dark' ? 'light' : 'dark';
    session(['theme' => $newTheme]);
    return back();
})->name('theme.toggle');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:admin', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
require __DIR__.'/orgnaization-auth.php';

require __DIR__.'/organization-dashboard.php';
require __DIR__.'/admin-dashboard.php';
