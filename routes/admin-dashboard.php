<?php

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
use App\Livewire\AdminDashboard\CurrenciesList;
// use App\Livewire\AdminDashboard\Cases\Requests\AdditionalRequestsIndex;
// use App\Livewire\AdminDashboard\Cases\Responses\AdditionalResponses;
use App\Livewire\AdminDashboard\Donations\DonationsList;
use App\Livewire\AdminDashboard\Donations\DonationsReport;
use App\Livewire\AdminDashboard\Donors\DonorsList;
use App\Livewire\AdminDashboard\Logs;
use App\Livewire\AdminDashboard\Main;
use App\Livewire\AdminDashboard\Notifications\NotificationsList;
use App\Livewire\AdminDashboard\Organizations\JoinRequests\JoinRequsts;
use App\Livewire\AdminDashboard\Organizations\OrganizationDonations;
use App\Livewire\AdminDashboard\Organizations\OrganizationsForm;
use App\Livewire\AdminDashboard\Organizations\OrganizationsIndex;
use App\Livewire\AdminDashboard\Partners\PartnersForm;
use App\Livewire\AdminDashboard\Partners\PartnersIndex;
use App\Livewire\AdminDashboard\Projects\Requests\AcceptedRequests;
use App\Livewire\AdminDashboard\Projects\Requests\AcceptedRequestsCards;
use App\Livewire\AdminDashboard\Projects\Requests\RefinedRequests;
use App\Livewire\AdminDashboard\Projects\Requests\Requests;
use App\Livewire\AdminDashboard\Projects\Accepted\CompletedProject;
use App\Livewire\AdminDashboard\Users\UsersForm;
use App\Livewire\AdminDashboard\Users\UsersIndex;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:admin', EnsureUserIsActive::class])->group(function () {
    Route::get('/users', UsersIndex::class)->name('users');
    Route::get('/usersform', UsersForm::class)->name('users-form');
    Route::get('/main', Main::class)->name('Main');
    Route::get('/organizations', OrganizationsIndex::class)->name('org');
    Route::get('/organizations-join-requests', JoinRequsts::class)->name('join-requests');
    Route::get('/org-form', OrganizationsForm::class)->name('org-form');
    Route::get('/partner-form', PartnersForm::class)->name('partner-form');
    Route::get('/partners', PartnersIndex::class)->name('partners');
    Route::get('/case-form', AdditionalRequestsForm::class)->name('additional-request-case-form');
    // Route::get('/org-case', OrganizationCasesIndex::class)->name('org-case');

    Route::get('/donations', DonationsList::class)->name('donations');
    Route::get('/donations/reports', DonationsReport::class)->name('donations-report');

    // Route::get('/all-case', AllCasesIndex::class)->name('all-case');
    // Route::get('/case-response', AdditionalResponses::class)->name('case-response');
    Route::get('/cases/request', CasesRequests::class)->name('cases-request');
    Route::get('/cases/refined-case', CasesRefined::class)->name('refined-case');
    Route::get('/cases/accpeted-case', CasesAccepted::class)->name('accepted_case');
    Route::get('/cases/accpeted-case-card', CasesAcceptedCards::class)->name('accepted-case-card');
    // Route::get('/case-request', AdditionalRequestsIndex::class)->name('case-request');

    Route::get('/cases/donations', CaseDonations::class)->name('case-donations');
    Route::get('/cases/completed-case', CompletedCase::class)->name('completed_case');
    Route::get('/projects/completed-project', CompletedProject::class)->name('completed_project');



    Route::get('/donors', DonorsList::class)->name('donors');

    Route::get('/projects/request', Requests::class)->name('projects-request');
    Route::get('/projects/refined-request', RefinedRequests::class)->name('refined-project');
    Route::get('/projects/accpeted-request', AcceptedRequests::class)->name('accepted-project');
    Route::get('/projects/accpeted-request-card', AcceptedRequestsCards::class)->name('accepted-project-card');



    Route::get('/notifications', NotificationsList::class)->name('notification');
    Route::get('/system-logs', Logs::class)->name('logs');

    Route::get('/currencies-rate', CurrenciesList::class)->name('currncies-list');

    Route::get('/organizations/reports', OrganizationDonations::class)->name('org-donations-report');
});