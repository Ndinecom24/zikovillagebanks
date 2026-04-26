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
    Route::get('/home', \App\Livewire\VillageBanking\Dashboard\Dashboard::class)->name('home')->middleware('permission:view-dashboard');
    Route::get('/dashboard', \App\Livewire\VillageBanking\Dashboard\Dashboard::class)->name('dashboard')->middleware('permission:view-dashboard');

    /* ── Discover Village Banks ──────────────────────── */
    Route::get('/discover', \App\Livewire\VillageBanking\Discovery\VBDiscovery::class)->name('discover')->middleware('permission:discover-banks');

    Route::group(['middleware' => 'village_bank'], function () {

        /* ── Members ────────────────────────────────────── */
        Route::get('/members', \App\Livewire\VillageBanking\Members\MemberList::class)->name('members.index')->middleware('permission:view-members');
        Route::get('/members/create', \App\Livewire\VillageBanking\Members\MemberCreate::class)->name('members.create')->middleware('permission:create-members');
        Route::get('/members/approval', \App\Livewire\VillageBanking\Members\MemberApproval::class)->name('members.approval')->middleware('permission:approve-members');
        Route::get('/members/join-requests', \App\Livewire\VillageBanking\Members\JoinRequestManager::class)->name('members.join-requests')->middleware('permission:manage-join-requests');
        Route::get('/members/{memberId}', \App\Livewire\VillageBanking\Members\MemberShow::class)->name('members.show')->middleware('permission:view-members');

        /* ── Circles ────────────────────────────────────── */
        Route::get('/circles', \App\Livewire\VillageBanking\Circles\CircleList::class)->name('circles.index')->middleware('permission:view-circles');
        Route::get('/circles/create', \App\Livewire\VillageBanking\Circles\CircleCreate::class)->name('circles.create')->middleware('permission:create-circles');
       Route::get('/circles/{circleId}', \App\Livewire\VillageBanking\Circles\CircleShow::class)->name('circles.show')->middleware('permission:view-circles');
        Route::get('/circles/{circleId}/members', \App\Livewire\VillageBanking\Circles\CircleMembers::class)->name('circles.members')->middleware('permission:manage-circles');

        /* ── Months & Phases ────────────────────────────── */
        Route::get('/circles/{circleId}/months', \App\Livewire\VillageBanking\Months\MonthManager::class)->name('months.index')->middleware('permission:manage-months');
        Route::get('/months/{monthId}/phases', \App\Livewire\VillageBanking\Months\PhaseManager::class)->name('phases.index')->middleware('permission:manage-months');

        /* ── Shares ─────────────────────────────────────── */
        Route::get('/shares', \App\Livewire\VillageBanking\Shares\ShareList::class)->name('shares.index')->middleware('permission:view-shares');
        Route::get('/shares/declare', \App\Livewire\VillageBanking\Shares\ShareDeclaration::class)->name('shares.declare')->middleware('permission:declare-shares');
        Route::get('/shares/{declarationId}', \App\Livewire\VillageBanking\Shares\ShareShow::class)->name('shares.show')->middleware('permission:view-shares');

        /* ── Insurance ──────────────────────────────────── */
        Route::get('/insurance', \App\Livewire\VillageBanking\Shares\InsuranceSummary::class)->name('insurance.index')->middleware('permission:view-shares');

        /* ── Loans ──────────────────────────────────────── */
        Route::get('/loans', \App\Livewire\VillageBanking\Loans\LoanList::class)->name('loans.index')->middleware('permission:view-loans');
        Route::get('/loans/request', \App\Livewire\VillageBanking\Loans\LoanRequest::class)->name('loans.request')->middleware('permission:request-loans');
        Route::get('/loans/approval', \App\Livewire\VillageBanking\Loans\LoanApproval::class)->name('loans.approval')->middleware('permission:approve-loans');
        Route::get('/loans/pairing', \App\Livewire\VillageBanking\Loans\LoanPairing::class)->name('loans.pairing')->middleware('permission:pair-loans');
        Route::get('/loans/forced', \App\Livewire\VillageBanking\Loans\ForcedLoan::class)->name('loans.forced')->middleware('permission:force-loans');
        Route::get('/loans/{loanId}', \App\Livewire\VillageBanking\Loans\LoanShow::class)->name('loans.show')->middleware('permission:view-loans');

        /* ── Payments ───────────────────────────────────── */
        Route::get('/payments/upload', \App\Livewire\VillageBanking\Payments\PaymentUpload::class)->name('payments.upload')->middleware('permission:upload-payments');
        Route::get('/payments/confirm', \App\Livewire\VillageBanking\Payments\PaymentConfirmation::class)->name('payments.confirm')->middleware('permission:confirm-payments');

        /* ── Repayments ─────────────────────────────────── */
        Route::get('/repayments', \App\Livewire\VillageBanking\Repayments\RepaymentForm::class)->name('repayments.index')->middleware('permission:view-repayments');
        Route::get('/repayments/tracker', \App\Livewire\VillageBanking\Repayments\RepaymentTracker::class)->name('repayments.tracker')->middleware('permission:view-repayments');
        Route::get('/repayments/{loanId}', \App\Livewire\VillageBanking\Repayments\RepaymentShow::class)->name('repayments.show')->middleware('permission:view-repayments');

        /* ── Shareout ───────────────────────────────────── */
        Route::get('/shareout', \App\Livewire\VillageBanking\Shareout\ShareoutCalculator::class)->name('shareout.index')->middleware('permission:view-shareout');
        Route::get('/shareout/{shareoutId}', \App\Livewire\VillageBanking\Shareout\ShareoutShow::class)->name('shareout.show')->middleware('permission:view-shareout');
    Route::get('/shareout/{shareoutId}/member/{allocationId}', \App\Livewire\VillageBanking\Shareout\ShareoutMemberDetail::class)->name('shareout.member')->middleware('permission:view-shareout');
        Route::get('/social-fund', \App\Livewire\VillageBanking\Shareout\SocialFundManager::class)->name('social-fund.index')->middleware('permission:view-shareout');

        /* ── Reports ────────────────────────────────────── */
        Route::get('/reports', \App\Livewire\VillageBanking\Reports\ReportsHub::class)->name('reports.index')->middleware('permission:view-reports');
        Route::get('/reports/dashboard', \App\Livewire\VillageBanking\Reports\ReportsDashboard::class)->name('reports.dashboard')->middleware('permission:view-reports');
        Route::get('/reports/financial', \App\Livewire\VillageBanking\Reports\FinancialReport::class)->name('reports.financial')->middleware('permission:view-reports');
        Route::get('/reports/membership', \App\Livewire\VillageBanking\Reports\MembershipReport::class)->name('reports.membership')->middleware('permission:view-reports');
        Route::get('/reports/loans', \App\Livewire\VillageBanking\Reports\LoansReport::class)->name('reports.loans')->middleware('permission:view-reports');
        Route::get('/reports/analytics', \App\Livewire\VillageBanking\Reports\AnalyticsCharts::class)->name('reports.analytics')->middleware('permission:view-reports');

        /* ── Rules & Bylaws ─────────────────────────────── */
        Route::get('/rules', \App\Livewire\VillageBanking\Rules\RuleManager::class)->name('rules.manage')->middleware('permission:view-rules');
        Route::get('/rules/{ruleId}', \App\Livewire\VillageBanking\Rules\RuleShow::class)->name('rules.show')->middleware('permission:view-rules');
        Route::get('/compliance', \App\Livewire\VillageBanking\Rules\ComplianceCenter::class)->name('compliance.index')->middleware('permission:view-rules');

        /* ── Polls & Voting ─────────────────────────────── */
        Route::get('/polls', \App\Livewire\VillageBanking\Polls\PollManager::class)->name('polls.index')->middleware('permission:manage-polls');
        Route::get('/polls/vote', \App\Livewire\VillageBanking\Polls\PollVoting::class)->name('polls.vote')->middleware('permission:vote-polls');
        Route::get('/polls/{pollId}', \App\Livewire\VillageBanking\Polls\PollShow::class)->name('polls.show')->middleware('permission:view-polls');

        /* ── Settings / Configuration ───────────────────── */
        Route::get('/settings/bank-configuration', \App\Livewire\VillageBanking\Settings\BankConfiguration::class)->name('settings.bank-config')->middleware('permission:manage-bank-config');
        /* ── Communications ─────────────────────────────── */
        Route::get('/communications', \App\Livewire\VillageBanking\Communications\CommunicationManager::class)->name('communications.index')->middleware('permission:manage-communications');
    }); /* end village_bank middleware */

    /* ══════════════════════════════════════════════
     *  VILLAGE BANKS (Super Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/village-banks', \App\Livewire\VillageBanks\VillageBankList::class)->name('village-banks.index')->middleware('permission:view-village-banks');
    Route::get('/village-banks/create', \App\Livewire\VillageBanks\VillageBankCreate::class)->name('village-banks.create')->middleware('permission:manage-village-banks');
    Route::get('/village-banks/{bankId}', \App\Livewire\VillageBanks\VillageBankShow::class)->name('village-banks.show')->middleware('permission:view-village-banks');

    /* ══════════════════════════════════════════════
     *  USER PROFILE (Self-service)
     * ══════════════════════════════════════════════ */
    Route::get('/profile', \App\Livewire\UserManagement\UserProfile::class)->name('profile');

    /* ══════════════════════════════════════════════
     *  USER MANAGEMENT
     * ══════════════════════════════════════════════ */
    Route::get('/users', \App\Livewire\UserManagement\UserList::class)->name('users.index')->middleware('permission:view-users');
    Route::get('/users/{id}', \App\Livewire\UserManagement\UserShow::class)->name('users.show')->middleware('permission:view-users');
    Route::get('/user-roles', \App\Livewire\UserManagement\UserRoleManager::class)->name('user-roles.index')->middleware('permission:manage-roles');

    /* ══════════════════════════════════════════════
     *  ROLE-BASED ACCESS
     * ══════════════════════════════════════════════ */
    Route::get('/roles', \App\Livewire\RoleBasedAccess\Roles\RoleList::class)->name('roles.index')->middleware('permission:manage-roles');
    Route::get('/roles/{id}', \App\Livewire\RoleBasedAccess\Roles\RoleShow::class)->name('roles.show')->middleware('permission:manage-roles');
    Route::get('/permissions', \App\Livewire\RoleBasedAccess\Permissions\PermissionList::class)->name('permissions.index')->middleware('permission:manage-roles');

    /* ══════════════════════════════════════════════
     *  ACTIVITY LOGS
     * ══════════════════════════════════════════════ */
    Route::get('/activity-logs', \App\Livewire\ActivityLogs\ActivityLogList::class)->name('activity-logs.index')->middleware('permission:view-activity-logs');
    Route::get('/activity-logs/{id}', \App\Livewire\ActivityLogs\ActivityLogShow::class)->name('activity-logs.show')->middleware('permission:view-activity-logs');

    /* ══════════════════════════════════════════════
     *  SUBSCRIPTION & LICENSING (Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/subscription/plans', \App\Livewire\Subscription\SubscriptionPlanManager::class)->name('subscription.plans')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/applications', \App\Livewire\Subscription\ApplicationReview::class)->name('subscription.applications')->middleware('permission:review-applications');
    Route::get('/subscription/payments', \App\Livewire\Subscription\PaymentReview::class)->name('subscription.payments')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/licenses', \App\Livewire\Subscription\LicenseManager::class)->name('subscription.licenses')->middleware('permission:manage-licenses');
    Route::get('/subscription/payment-config', \App\Livewire\Subscription\PaymentConfigManager::class)->name('subscription.payment-config')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/promo-codes', \App\Livewire\Subscription\PromoCodeManager::class)->name('subscription.promo-codes')->middleware('permission:manage-subscriptions');
    Route::get('/subscription/sms', \App\Livewire\Subscription\SmsManager::class)->name('subscription.sms')->middleware('permission:manage-sms');

    /* ══════════════════════════════════════════════
     *  TRAINING PROGRAMS (Admin)
     * ══════════════════════════════════════════════ */
    Route::get('/training/programs', \App\Livewire\Subscription\TrainingProgramManager::class)->name('training.programs')->middleware('permission:manage-training');
    Route::get('/training/applications', \App\Livewire\Subscription\TrainingApplicationReview::class)->name('training.applications')->middleware('permission:manage-training');

    Route::get('/license-expired', \App\Livewire\Subscription\LicenseExpired::class)->name('license.expired');
});

/* ══════════════════════════════════════════════
 *  PUBLIC PAGES (No Auth)
 * ══════════════════════════════════════════════ */
Route::get('/', \App\Livewire\Subscription\LandingPage::class)->name('landing');
Route::get('/welcome', \App\Livewire\Subscription\LandingPage::class)->name('welcome');
