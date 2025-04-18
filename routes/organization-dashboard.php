<?php

use App\Http\Controllers\Organization\OrganizationProfileController;
use App\Http\Middleware\EnsureUserIsActive;
use App\Livewire\OrganizationDashboard\Cases\Cases\CompletedCase;
use App\Livewire\OrganizationDashboard\Cases\Cases\CompletedCaseTable;
use App\Livewire\OrganizationDashboard\Cases\Request\AcceptedReqeusts;
use App\Livewire\OrganizationDashboard\Cases\Request\RefinedRequests;

use App\Livewire\OrganizationDashboard\Main;
use App\Livewire\OrganizationDashboard\OrgUsers\OrgUsersForm;
use App\Livewire\OrganizationDashboard\OrgUsers\OrgUsersIndex;
use App\Livewire\OrganizationDashboard\Projects\Request\AcceptedRequsts;
use App\Livewire\OrganizationDashboard\Projects\Request\RefinedRequsts;
use App\Livewire\OrganizationDashboard\Projects\Request\RequestForm;
use App\Livewire\OrganizationDashboard\Projects\Request\RequestIndex;

use App\Livewire\OrganizationDashboard\Cases\Request\ReqeustForm as ReqeustFormCases;
use App\Livewire\OrganizationDashboard\Cases\Request\ReqeustsList as RequestListCases;
use App\Livewire\OrganizationDashboard\Projects\Projects\CompletedProject;
use App\Livewire\OrganizationDashboard\Projects\Projects\CompletedProjectTable;
use Illuminate\Support\Facades\Route;

Route::prefix('organization')->name('organization.')->middleware(['auth:organization', EnsureUserIsActive::class])->group(function () {
    Route::get('/main', Main::class)->name('Main');
    Route::get('/users', OrgUsersIndex::class)->name('users');
    Route::get('/users/form', OrgUsersForm::class)->name('users-form');
    Route::get('/project/add-request', RequestForm::class)->name('projects-requests-form');
    Route::get('/project/request-list', RequestIndex::class)->name('projects-requests');

    Route::get('/project/accepted-requests', AcceptedRequsts::class)->name('project-accpected');
    Route::get('/project/refined-requests', RefinedRequsts::class)->name('project-refined');


    Route::get('/case/add-request', ReqeustFormCases::class)->name('cases-requests-form');
    Route::get('/case/request-list', RequestListCases::class)->name('cases-requests');
    Route::get('/case/accepted-requests', AcceptedReqeusts::class)->name('case-accpected');
    Route::get('/case/refined-requests', RefinedRequests::class)->name('case-refined');


    Route::get('/projects/completed/project-table', CompletedProjectTable::class)->name('completed-project-table');   
    Route::get('/cases/completed/case-table', CompletedCaseTable::class)->name('completed-case-table');      
    Route::get('/cases/completed/case-card', CompletedCase::class)->name('completed-case-card');
    Route::get('/projects/completed/project-card', CompletedProject::class)->name('completed-project-card');
    
});


Route::middleware('auth:organization')->prefix('organization')->name('organization.')->group(function () {
    Route::get('profile', [OrganizationProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [OrganizationProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [OrganizationProfileController::class, 'destroy'])->name('profile.destroy');
});
