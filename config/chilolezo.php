<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */
    'roles' => [
        'super_admin' => 'super_admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    */
    'permissions' => [

        /*
        |----------------------------------------------------------------------
        | Client Management
        |----------------------------------------------------------------------
        */
        'clients' => [
            'group' => 'Client Management',
            'actions' => [
                // Clients.php (list page)
                'clients.view'       => ['name' => 'View Clients',       'description' => 'View the clients list page'],
                'clients.sort'       => ['name' => 'Sort Clients',       'description' => 'Sort the clients table by columns'],

                // ClientCreate.php
                'clients.create'     => ['name' => 'Create Client',      'description' => 'Create a new client record'],
                'clients.upload'     => ['name' => 'Upload Client Files', 'description' => 'Upload document files when creating a client'],
            ],
        ],

        /*
        |----------------------------------------------------------------------
        | Client Detail / Show
        |----------------------------------------------------------------------
        */
        'client_show' => [
            'group' => 'Client Detail',
            'actions' => [
                // ClientShow.php
                'clients.show'                 => ['name' => 'View Client Detail',         'description' => 'View a single client detail page'],
                'clients.assign_process'       => ['name' => 'Assign Process to Client',   'description' => 'Open the assign-process modal and assign a process'],
                'clients.select_process'       => ['name' => 'Select Active Process',      'description' => 'Switch between assigned processes in the tracking view'],
                'clients.toggle_stage'         => ['name' => 'Toggle Stage Accordion',     'description' => 'Expand or collapse a stage section'],
                'clients.update_task_status'   => ['name' => 'Update Task Status',         'description' => 'Change a task status (pending, in_progress, completed)'],
                'clients.save_task_remarks'    => ['name' => 'Save Task Remarks',          'description' => 'Save free-text remarks on a task progress record'],
                'clients.view_task_detail'     => ['name' => 'View Task Detail Modal',     'description' => 'Open the task detail side-panel'],
            ],
        ],

        /*
        |----------------------------------------------------------------------
        | Client Task Action (individual task page)
        |----------------------------------------------------------------------
        */
        'client_task_action' => [
            'group' => 'Client Task Action',
            'actions' => [
                // ClientTaskAction.php
                'client_tasks.update_status'   => ['name' => 'Update Client Task Status',  'description' => 'Set task to any status (pending, in_progress, completed, skipped)'],
                'client_tasks.mark_complete'   => ['name' => 'Mark Task Complete',          'description' => 'Mark a client task as completed'],
                'client_tasks.mark_in_progress' => ['name' => 'Mark Task In Progress',     'description' => 'Mark a client task as in progress'],
                'client_tasks.reset_pending'   => ['name' => 'Reset Task to Pending',      'description' => 'Reset a client task back to pending'],
                'client_tasks.skip'            => ['name' => 'Skip Task',                   'description' => 'Skip a client task'],
                'client_tasks.save_remarks'    => ['name' => 'Save Task Action Remarks',   'description' => 'Persist remarks on the task action page'],
                'client_tasks.add_comment'     => ['name' => 'Add Task Comment',            'description' => 'Add a comment to a task'],
                'client_tasks.edit_comment'    => ['name' => 'Edit Task Comment',           'description' => 'Edit an existing task comment'],
                'client_tasks.delete_comment'  => ['name' => 'Delete Task Comment',         'description' => 'Delete a task comment'],
                'client_tasks.upload_files'    => ['name' => 'Upload Task Files',           'description' => 'Upload files to a task'],
                'client_tasks.delete_file'     => ['name' => 'Delete Task File',            'description' => 'Delete a file from a task'],
                'client_tasks.download_file'   => ['name' => 'Download Task File',          'description' => 'Download a file attached to a task'],
            ],
        ],

        /*
        |----------------------------------------------------------------------
        | Client Task List (all tasks overview)
        |----------------------------------------------------------------------
        */
        'client_task_list' => [
            'group' => 'Client Task List',
            'actions' => [
                // ClientTaskList.php
                'client_tasks.view_list'       => ['name' => 'View Client Task List',      'description' => 'View the paginated list of all client tasks'],
                'client_tasks.filter'          => ['name' => 'Filter Client Tasks',         'description' => 'Use filters on the client task list'],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Permission Groups
    |--------------------------------------------------------------------------
    */
    'permission_groups' => [
        'ipp_management'    => 'IPP Management',
        'user_management'   => 'User Management',
        'reports'           => 'Reports',
        'configuration'     => 'Configuration',
        'substations'       => 'Substations',
        'general'           => 'General',
        'client_management' => 'Client Management',
        'client_detail'     => 'Client Detail',
        'client_task_action' => 'Client Task Action',
        'client_task_list'  => 'Client Task List',
    ],

];
