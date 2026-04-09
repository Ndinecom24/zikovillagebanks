<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    /* ══════════════════════════════════════════════
     *  VILLAGE BANKING (requires bank selection)
     * ══════════════════════════════════════════════ */

    /* ── Dashboard ──────────────────────────────────── */
    Route::get('/home', \App\Http\Livewire\VillageBanking\Dashboard\Dashboard::class)->name('home')->middleware('permission:view-dashboard');
    Route::get('/dashboard', \App\Http\Livewire\VillageBanking\Dashboard\Dashboard::class)->name('dashboard')->middleware('permission:view-dashboard');

    /* ── Discover Village Banks ──────────────────────── */
    Route::get('/discover', \App\Http\Livewire\VillageBanking\Discovery\VBDiscovery::class)->name('discover')->middleware('permission:discover-banks');

    Route::group(['middleware' => 'village_bank'], function () {

        /* ── Members ────────────────────────────────────── */
        Route::get('/members', \App\Http\Livewire\VillageBanking\Members\MemberList::class)->name('members.index')->middleware('permission:view-members');
        Route::get('/members/create', \App\Http\Livewire\VillageBanking\Members\MemberCreate::class)->name('members.create')->middleware('permission:create-members');
        Route::get('/members/approval', \App\Http\Livewire\VillageBanking\Members\MemberApproval::class)->name('members.approval')->middleware('permission:approve-members');
        Route::get('/members/join-requests', \App\Http\Livewire\VillageBanking\Members\JoinRequestManager::class)->name('members.join-requests')->middleware('permission:manage-join-requests');
        Route::get('/members/{memberId}', \App\Http\Livewire\VillageBanking\Members\MemberShow::class)->name('members.show')->middleware('permission:view-members');

        /* ── Circles ────────────────────────────────────── */
        Route::get('/circles', \App\Http\Livewire\VillageBanking\Circles\CircleList::class)->name('circles.index')->middleware('permission:view-circles');
        Route::get('/circles/create', \App\Http\Livewire\VillageBanking\Circles\CircleCreate::class)->name('circles.create')->middleware('permission:create-circles');
        Route::get('/circles/{circleId}', \App\Http\Livewire\VillageBanking\Circles\CircleShow::class)->name('circles.show')->middleware('permission:view-circles');
        Route::get('/circles/{circleId}/members', \App\Http\Livewire\VillageBanking\Circles\CircleMembers::class)->name('circles.members')->middleware('permission:manage-circles');

        /* ── Months & Phases ────────────────────────────── */
        Route::get('/circles/{circleId}/months', \App\Http\Livewire\VillageBanking\Months\MonthManager::class)->name('months.index')->middleware('permission:manage-months');
        Route::get('/months/{monthId}/phases', \App\Http\Livewire\VillageBanking\Months\PhaseManager::class)->name('phases.index')->middleware('permission:manage-months');

        /* ── Shares ─────────────────────────────────────── */
        Route::get('/shares', \App\Http\Livewire\VillageBanking\Shares\ShareList::class)->name('shares.index')->middleware('permission:view-shares');
        Route::get('/shares/declare', \App\Http\Livewire\VillageBanking\Shares\ShareDeclaration::class)->name('shares.declare')->middleware('permission:declare-shares');
        Route::get('/shares/{declarationId}', \App\Http\Livewire\VillageBanking\Shares\ShareShow::class)->name('shares.show')->middleware('permission:view-shares');

        /* ── Insurance ──────────────────────────────────── */
        Route::get('/insurance', \App\Http\Livewire\VillageBanking\Shares\InsuranceSummary::class)->name('insurance.index')->middleware('permission:view-shares');

        /* ── Loans ──────────────────────────────────────── */
        Route::get('/loans', \App\Http\Livewire\VillageBanking\Loans\LoanList::class)->name('loans.index')->middleware('permission:view-loans');
        Route::get('/loans/request', \App\Http\Livewire\VillageBanking\Loans\LoanRequest::class)->name('loans.request')->middleware('permission:request-loans');
        Route::get('/loans/approval', \App\Http\Livewire\VillageBanking\Loans\LoanApproval::class)->name('loans.approval')->middleware('permission:approve-loans');
        Route::get('/loans/pairing', \App\Http\Livewire\VillageBanking\Loans\LoanPairing::class)->name('loans.pairing')->middleware('permission:pair-loans');
        Route::get('/loans/forced', \App\Http\Livewire\VillageBanking\Loans\ForcedLoan::class)->name('loans.forced')->middleware('permission:force-loans');
        Route::get('/loans/{loanId}', \App\Http\Livewire\VillageBanking\Loans\LoanShow::class)->name('loans.show')->middleware('permission:view-loans');

        /* ── Payments ───────────────────────────────────── */
        Route::get('/payments/upload', \App\Http\Livewire\VillageBanking\Payments\PaymentUpload::class)->name('payments.upload')->middleware('permission:upload-payments');
        Route::get('/payments/confirm', \App\Http\Livewire\VillageBanking\Payments\PaymentConfirmation::class)->name('payments.confirm')->middleware('permission:confirm-payments');

        /* ── Repayments ─────────────────────────────────── */
        Route::get('/repayments', \App\Http\Livewire\VillageBanking\Repayments\RepaymentForm::class)->name('repayments.index')->middleware('permission:view-repayments');
        Route::get('/repayments/tracker', \App\Http\Livewire\VillageBanking\Repayments\RepaymentTracker::class)->name('repayments.tracker')->middleware('permission:view-repayments');
        Route::get('/repayments/{loanId}', \App\Http\Livewire\VillageBanking\Repayments\RepaymentShow::class)->name('repayments.show')->middleware('permission:view-repayments');

        /* ── Shareout ───────────────────────────────────── */
        Route::get('/shareout', \App\Http\Livewire\VillageBanking\Shareout\ShareoutCalculator::class)->name('shareout.index')->middleware('permission:view-shareout');
        Route::get('/shareout/{shareoutId}', \App\Http\Livewire\VillageBanking\Shareout\ShareoutShow::class)->name('shareout.show')->middleware('permission:view-shareout');

        /* ── Reports ────────────────────────────────────── */
        Route::get('/reports', \App\Http\Livewire\VillageBanking\Reports\ReportsHub::class)->name('reports.index')->middleware('permission:view-reports');
        Route::get('/reports/dashboard', \App\Http\Livewire\VillageBanking\Reports\ReportsDashboard::class)->name('reports.dashboard')->middleware('permission:view-reports');
        Route::get('/reports/financial', \App\Http\Livewire\VillageBanking\Reports\FinancialReport::class)->name('reports.financial')->middleware('permission:view-reports');
        Route::get('/reports/membership', \App\Http\Livewire\VillageBanking\Reports\MembershipReport::class)->name('reports.membership')->middleware('permission:view-reports');
        Route::get('/reports/loans', \App\Http\Livewire\VillageBanking\Reports\LoansReport::class)->name('reports.loans')->middleware('permission:view-reports');
        Route::get('/reports/analytics', \App\Http\Livewire\VillageBanking\Reports\AnalyticsCharts::class)->name('reports.analytics')->middleware('permission:view-reports');

        /* ── Rules & Bylaws ─────────────────────────────── */
        Route::get('/rules', \App\Http\Livewire\VillageBanking\Rules\RuleManager::class)->name('rules.manage')->middleware('permission:view-rules');
        Route::get('/rules/{ruleId}', \App\Http\Livewire\VillageBanking\Rules\RuleShow::class)->name('rules.show')->middleware('permission:view-rules');

        /* ── Polls & Voting ─────────────────────────────── */
        Route::get('/polls', \App\Http\Livewire\VillageBanking\Polls\PollManager::class)->name('polls.index')->middleware('permission:manage-polls');
        Route::get('/polls/vote', \App\Http\Livewire\VillageBanking\Polls\PollVoting::class)->name('polls.vote')->middleware('permission:vote-polls');
        Route::get('/polls/{pollId}', \App\Http\Livewire\VillageBanking\Polls\PollShow::class)->name('polls.show')->middleware('permission:view-polls');

        /* ── Settings / Configuration ───────────────────── */
        Route::get('/settings/bank-configuration', \App\Http\Livewire\VillageBanking\Settings\BankConfiguration::class)->name('settings.bank-config')->middleware('permission:manage-bank-config');

    }); /* end village_bank middleware */

    /* ══════════════════════════════════════════════
     *  VILLAGE BANKS (Super Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/village-banks', \App\Http\Livewire\VillageBanks\VillageBankList::class)->name('village-banks.index')->middleware('permission:view-village-banks');
    Route::get('/village-banks/create', \App\Http\Livewire\VillageBanks\VillageBankCreate::class)->name('village-banks.create')->middleware('permission:manage-village-banks');
    Route::get('/village-banks/{bankId}', \App\Http\Livewire\VillageBanks\VillageBankShow::class)->name('village-banks.show')->middleware('permission:view-village-banks');

    /* ══════════════════════════════════════════════
     *  USER PROFILE (Self-service)
     * ══════════════════════════════════════════════ */
    Route::get('/profile', \App\Http\Livewire\UserManagement\UserProfile::class)->name('profile');

    /* ══════════════════════════════════════════════
     *  USER MANAGEMENT
     * ══════════════════════════════════════════════ */
    Route::get('/users', \App\Http\Livewire\UserManagement\UserList::class)->name('users.index')->middleware('permission:view-users');
    Route::get('/users/{id}', \App\Http\Livewire\UserManagement\UserShow::class)->name('users.show')->middleware('permission:view-users');
    Route::get('/user-roles', \App\Http\Livewire\UserManagement\UserRoleManager::class)->name('user-roles.index')->middleware('permission:manage-roles');

    /* ══════════════════════════════════════════════
     *  ROLE-BASED ACCESS
     * ══════════════════════════════════════════════ */
    Route::get('/roles', \App\Http\Livewire\RoleBasedAccess\Roles\RoleList::class)->name('roles.index')->middleware('permission:manage-roles');
    Route::get('/roles/{id}', \App\Http\Livewire\RoleBasedAccess\Roles\RoleShow::class)->name('roles.show')->middleware('permission:manage-roles');
    Route::get('/permissions', \App\Http\Livewire\RoleBasedAccess\Permissions\PermissionList::class)->name('permissions.index')->middleware('permission:manage-roles');

    /* ══════════════════════════════════════════════
     *  ACTIVITY LOGS
     * ══════════════════════════════════════════════ */
    Route::get('/activity-logs', \App\Http\Livewire\ActivityLogs\ActivityLogList::class)->name('activity-logs.index')->middleware('permission:view-activity-logs');
    Route::get('/activity-logs/{id}', \App\Http\Livewire\ActivityLogs\ActivityLogShow::class)->name('activity-logs.show')->middleware('permission:view-activity-logs');

    /* ══════════════════════════════════════════════
     *  SUBSCRIPTION & LICENSING (Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/subscription/plans', \App\Http\Livewire\Subscription\SubscriptionPlanManager::class)->name('subscription.plans')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/applications', \App\Http\Livewire\Subscription\ApplicationReview::class)->name('subscription.applications')->middleware('permission:review-applications');
    Route::get('/subscription/payments', \App\Http\Livewire\Subscription\PaymentReview::class)->name('subscription.payments')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/licenses', \App\Http\Livewire\Subscription\LicenseManager::class)->name('subscription.licenses')->middleware('permission:manage-licenses');
    Route::get('/subscription/payment-config', \App\Http\Livewire\Subscription\PaymentConfigManager::class)->name('subscription.payment-config')->middleware('permission:manage-subscriptions');

    /* ══════════════════════════════════════════════
     *  TRAINING PROGRAMS (Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/training/programs', \App\Http\Livewire\Subscription\TrainingProgramManager::class)->name('training.programs')->middleware('permission:manage-training');
    Route::get('/training/applications', \App\Http\Livewire\Subscription\TrainingApplicationReview::class)->name('training.applications')->middleware('permission:manage-training');

    Route::get('/license-expired', \App\Http\Livewire\Subscription\LicenseExpired::class)->name('license.expired');
});

/* ══════════════════════════════════════════════
 *  PUBLIC PAGES (No Auth)
 * ══════════════════════════════════════════════ */
Route::get('/', \App\Http\Livewire\Subscription\LandingPage::class)->name('landing');
Route::get('/welcome', \App\Http\Livewire\Subscription\LandingPage::class)->name('welcome');
