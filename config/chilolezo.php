<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    | Slugs for the system roles. Referenced via config('chilolezo.roles.xxx').
    */
    'roles' => [
        'super_admin'      => 'super-admin',
        'chairperson'      => 'chairperson',
        'secretary'        => 'secretary',
        'treasurer'        => 'treasurer',
        'committee_member' => 'committee-member',
        'member'           => 'member',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions Registry
    |--------------------------------------------------------------------------
    | Single source of truth for every permission in the system.
    | Grouped by functional area. The slug is the key used for @can / Gate.
    */
    'permissions' => [

        /* ── Dashboard ────────────────────────── */
        'dashboard' => [
            'group' => 'Dashboard',
            'items' => [
                'view-dashboard' => 'Access the main dashboard',
            ],
        ],

        /* ── Member Management ────────────────── */
        'members' => [
            'group' => 'Member Management',
            'items' => [
                'view-members'         => 'View member list',
                'create-members'       => 'Register new members',
                'edit-members'         => 'Edit member details',
                'approve-members'      => 'Approve or reject pending members',
                'manage-join-requests' => 'Review and approve join requests',
            ],
        ],

        /* ── Circle Management ────────────────── */
        'circles' => [
            'group' => 'Circle Management',
            'items' => [
                'view-circles'   => 'View banking circles',
                'create-circles' => 'Create new circles',
                'manage-circles' => 'Edit, activate, close circles',
                'manage-months'  => 'Open/close months and phases',
            ],
        ],

        /* ── Shares & Insurance ───────────────── */
        'shares' => [
            'group' => 'Shares & Insurance',
            'items' => [
                'declare-shares'      => 'Declare monthly share amount',
                'view-shares'         => 'View share declarations',
                'configure-insurance' => 'Set insurance rules for a circle',
            ],
        ],

        /* ── Loan Management ──────────────────── */
        'loans' => [
            'group' => 'Loan Management',
            'items' => [
                'request-loans' => 'Submit a loan request',
                'approve-loans' => 'Approve or reject loan requests',
                'view-loans'    => 'View all loans',
                'pair-loans'    => 'Match borrowers with lenders',
                'force-loans'   => 'Apply forced loans to members',
            ],
        ],

        /* ── Payments ─────────────────────────── */
        'payments' => [
            'group' => 'Payments',
            'items' => [
                'upload-payments'        => 'Upload proof of payment',
                'confirm-payments'       => 'Confirm or reject payments',
                'manage-payment-methods' => 'Configure payment methods',
            ],
        ],

        /* ── Repayments ───────────────────────── */
        'repayments' => [
            'group' => 'Repayments',
            'items' => [
                'make-repayments' => 'Submit loan repayments',
                'view-repayments' => 'View repayment history',
            ],
        ],

        /* ── Shareout ─────────────────────────── */
        'shareout' => [
            'group' => 'Shareout',
            'items' => [
                'calculate-shareout' => 'Run shareout calculations',
                'view-shareout'      => 'View shareout results',
            ],
        ],

        /* ── Rules & Bylaws ───────────────────── */
        'rules' => [
            'group' => 'Rules & Bylaws',
            'items' => [
                'manage-rules' => 'Create, edit, delete rules and bylaws',
                'view-rules'   => 'View rules and acknowledge them',
            ],
        ],

        /* ── Polls & Voting ───────────────────── */
        'polls' => [
            'group' => 'Polls & Voting',
            'items' => [
                'manage-polls' => 'Create, edit, open, close polls',
                'vote-polls'   => 'Cast votes and comment on polls',
                'view-polls'   => 'View poll results',
            ],
        ],

        /* ── Reports ──────────────────────────── */
        'reports' => [
            'group' => 'Reports',
            'items' => [
                'view-reports'   => 'Access financial and operational reports',
                'export-reports' => 'Export reports to PDF/Excel',
            ],
        ],

        /* ── Bank Configuration ───────────────── */
        'settings' => [
            'group' => 'Settings',
            'items' => [
                'manage-bank-config' => 'Configure village bank settings',
            ],
        ],

        /* ── Communications ────────────────────── */
        'communications' => [
            'group' => 'Communications',
            'items' => [
                'manage-communications' => 'Send and manage village bank communications',
            ],
        ],

        /* ── Village Banks (platform) ─────────── */
        'village_banks' => [
            'group' => 'Village Banks',
            'items' => [
                'manage-village-banks' => 'Create and manage village banks',
                'view-village-banks'   => 'View village bank details',
            ],
        ],

        /* ── User Management ──────────────────── */
        'users' => [
            'group' => 'User Management',
            'items' => [
                'view-users'   => 'View user list',
                'create-users' => 'Create new users',
                'edit-users'   => 'Edit user details',
                'delete-users' => 'Delete users',
                'manage-roles' => 'Manage roles and permissions',
            ],
        ],

        /* ── Subscriptions & Licensing ────────── */
        'subscriptions' => [
            'group' => 'Subscriptions',
            'items' => [
                'manage-subscriptions' => 'Manage subscription plans and payments',
                'manage-licenses'      => 'Issue, revoke, and manage licenses',
                'review-applications'  => 'Approve or reject bank applications',
                'view-applications'    => 'View submitted bank applications',
                'manage-sms'           => 'Send and manage SMS messages',
            ],
        ],

        /* ── Training ─────────────────────────── */
        'training' => [
            'group' => 'Training',
            'items' => [
                'manage-training' => 'Manage training programs and applications',
            ],
        ],

        /* ── Activity Logs ────────────────────── */
        'activity_logs' => [
            'group' => 'Activity Logs',
            'items' => [
                'view-activity-logs' => 'View system activity logs',
            ],
        ],

        /* ── Discovery ────────────────────────── */
        'discovery' => [
            'group' => 'Discovery',
            'items' => [
                'discover-banks' => 'Search and request to join village banks',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Role → Permission Mapping
    |--------------------------------------------------------------------------
    | Defines which permissions each role receives. 'all' = every permission.
    */
    'role_permissions' => [

        'super-admin' => 'all',

        'chairperson' => [
            'view-dashboard',
            // Members
            'view-members', 'create-members', 'edit-members', 'approve-members', 'manage-join-requests',
            // Circles
            'view-circles', 'create-circles', 'manage-circles', 'manage-months',
            // Shares
            'declare-shares', 'view-shares', 'configure-insurance',
            // Loans
            'request-loans', 'approve-loans', 'view-loans', 'pair-loans', 'force-loans',
            // Payments
            'upload-payments', 'confirm-payments', 'manage-payment-methods',
            // Repayments
            'make-repayments', 'view-repayments',
            // Shareout
            'calculate-shareout', 'view-shareout',
            // Governance
            'manage-rules', 'view-rules', 'manage-polls', 'vote-polls', 'view-polls',
            // Reports & Settings
            'view-reports', 'export-reports', 'manage-bank-config',
            // Communications
            'manage-communications',
            // Village Banks
            'manage-village-banks', 'view-village-banks',
            // Users (view only)
            'view-users',
            // Discovery
            'discover-banks',
        ],

        'secretary' => [
            'view-dashboard',
            'view-members', 'create-members', 'approve-members', 'edit-members', 'manage-join-requests',
            'view-circles', 'create-circles', 'manage-circles', 'manage-months',
            'view-shares', 'view-loans', 'view-repayments', 'view-shareout',
            'manage-rules', 'view-rules', 'manage-polls', 'vote-polls', 'view-polls',
            'view-reports', 'view-users', 'view-village-banks', 'discover-banks',
            'manage-communications',
        ],

        'treasurer' => [
            'view-dashboard',
            'view-members', 'view-circles',
            'declare-shares', 'view-shares', 'configure-insurance',
            'view-loans', 'pair-loans',
            'upload-payments', 'confirm-payments', 'manage-payment-methods',
            'view-repayments', 'calculate-shareout', 'view-shareout',
            'view-rules', 'vote-polls', 'view-polls',
            'view-reports', 'export-reports', 'view-village-banks', 'discover-banks',
        ],

        'committee-member' => [
            'view-dashboard',
            'view-members', 'approve-members',
            'view-circles', 'view-shares',
            'approve-loans', 'view-loans',
            'confirm-payments',
            'view-repayments', 'view-shareout',
            'view-rules', 'vote-polls', 'view-polls',
            'view-reports', 'view-village-banks', 'discover-banks',
        ],

        'member' => [
            'view-dashboard',
            'view-members', 'view-circles',
            'declare-shares', 'view-shares',
            'request-loans', 'view-loans',
            'upload-payments',
            'make-repayments', 'view-repayments',
            'view-shareout',
            'view-rules', 'vote-polls', 'view-polls',
            'view-village-banks', 'discover-banks',
        ],
    ],
];
