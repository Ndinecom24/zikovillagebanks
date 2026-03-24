# 05 — Models & Relationships

> Eloquent models, their tables, fillable fields, relationships, accessors, and traits.

---

## Model Index

| # | Model | Table | Traits | Soft Delete |
|---|-------|-------|--------|:-----------:|
| 1 | `User` | `users` | HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes | ✅ |
| 2 | `IndependentProducer` | `independent_producers` | HasFactory, SoftDeletes | ✅ |
| 3 | `ClientDetails` | `clients` | HasFactory, SoftDeletes | ✅ |
| 4 | `ClientProcess` | `client_process` | HasFactory, SoftDeletes | ✅ |
| 5 | `ClientTaskProgress` | `client_task_progress` | HasFactory | ❌ |
| 6 | `ClientTaskComment` | `client_task_comments` | HasFactory | ❌ |
| 7 | `ClientTaskFile` | `client_task_files` | HasFactory | ❌ |
| 8 | `Process` | `processes` | HasFactory, SoftDeletes | ✅ |
| 9 | `ProcessModule` | `process_modules` | HasFactory, SoftDeletes | ✅ |
| 10 | `ProcessTask` | `process_tasks` | HasFactory, SoftDeletes | ✅ |
| 11 | `ResponsibleOffices` | `responsible_offices` | HasFactory, SoftDeletes | ✅ |
| 12 | `Role` | `roles` | HasFactory | ❌ |
| 13 | `Permission` | `permissions` | HasFactory | ❌ |
| 14 | `Province` | `provinces` | HasFactory | ❌ |
| 15 | `Districts` | `districts` | HasFactory | ❌ |
| 16 | `ConnectionPoints` | `connection_points` | HasFactory | ❌ |
| 17 | `Technology` | `technologies` | HasFactory | ❌ |
| 18 | `Venture` | `ventures` | HasFactory | ❌ |
| 19 | `Status` | `statuses` | HasFactory | ❌ |
| 20 | `Document` | `documents` | HasFactory, SoftDeletes | ✅ |
| 21 | `DocumentFolder` | `document_folders` | HasFactory, SoftDeletes | ✅ |
| 22 | `DocumentCategory` | `document_categories` | HasFactory, SoftDeletes | ✅ |
| 23 | `FileUploads` | `file_uploads` | HasFactory, SoftDeletes | ✅ |
| 24 | `Module` | `modules` | HasFactory | ❌ |
| 25 | `ModuleTasks` | `module_tasks` | HasFactory | ❌ |
| 26 | `Comments` | `comments` | HasFactory | ❌ |
| 27 | `Nodes` | `nodes` | HasFactory | ❌ |
| 28 | `IndependentProducerList` | `independent_producer_lists` | HasFactory | ❌ |
| 29 | `PhrisUserDetails` | *(external Oracle)* | — | ❌ |

---

## Detailed Model Definitions

---

### `User`

**File:** `app/Models/User.php`
**Table:** `users`

**Fillable:**
`name`, `staff_no`, `directorate`, `email`, `avatar`, `job_title`, `user_unit`, `mobile_no`, `user_role_id`, `password`, `password_changed`, `total_login`, `uuid`

**Relationships:**

| Method | Type | Related Model | Pivot Table | Pivot Columns |
|--------|------|---------------|-------------|---------------|
| `offices()` | belongsToMany | `ResponsibleOffices` | `office_user` | `role_in_office` |

> Role/permission relationships provided by `HasRolesAndPermissions` trait:
> - `roles()` → belongsToMany → `Role` (via `role_user`)
> - `hasRole($role)`, `hasPermission($permission)`, etc.

---

### `IndependentProducer`

**File:** `app/Models/IndependentProducer.php`
**Table:** `independent_producers`
**Eager-loads:** `province`, `districts`, `ventures`

**Fillable:** *(30+ fields)* `system_ref`, `invoiced_services`, `technology`, `engagement_number`, `name_of_ipp`, `date_of_application`, `size_of_plant`, `size_of_plant_unit`, `province_id`, `district_id`, `proposed_connection_point`, `total_system_generated`, `available_capacity`, `voltage_level`, `date_of_connection`, `expiry_connection_point`, `status_of_engagement`, `updates_on_engagements`, `date_of_update`, `updated_by`, `contact_person_name`, `contact_person_email`, `contact_person_phone`, `type_of_venture`, `expected_date_commissioning`, `expected_commercial`, `preferred_connection_level`, `ipp_tariff`, `status_id`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `province()` | belongsTo | `Province` |
| `districts()` | belongsTo | `Districts` |
| `ventures()` | belongsTo | `Venture` |

---

### `ClientDetails`

**File:** `app/Models/ClientDetails.php`
**Table:** `clients`

**Fillable:** `company_name`, `phone`, `email`, `address_line_1`, `address_line`, `city`, `province`, `country`, `tpin`, `is_active`, `created_by`, `created_by_staff_no`, `phone_area_code`, `postal_code`

**Relationships:**

| Method | Type | Related Model | Notes |
|--------|------|---------------|-------|
| `clientProcesses()` | hasMany | `ClientProcess` | All processes assigned to this client |
| `activeProcesses()` | hasMany | `ClientProcess` | Scoped to `status = 'in_progress'` |

---

### `ClientProcess`

**File:** `app/Models/ClientProcess.php`
**Table:** `client_process`

**Fillable:** `client_id`, `process_id`, `status`, `started_at`, `completed_at`, `started_by`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `client()` | belongsTo | `ClientDetails` |
| `process()` | belongsTo | `Process` |
| `starter()` | belongsTo | `User` |
| `taskProgress()` | hasMany | `ClientTaskProgress` |

**Computed Attributes:** `progress` (percentage), `current_module`

---

### `ClientTaskProgress`

**File:** `app/Models/ClientTaskProgress.php`
**Table:** `client_task_progress`

**Fillable:** `client_process_id`, `process_task_id`, `status`, `remarks`, `completed_by`, `completed_at`

**Casts:** `completed_at` → datetime

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `clientProcess()` | belongsTo | `ClientProcess` |
| `processTask()` | belongsTo | `ProcessTask` |
| `completedByUser()` | belongsTo | `User` |
| `comments()` | hasMany | `ClientTaskComment` |
| `files()` | hasMany | `ClientTaskFile` |

---

### `ClientTaskComment`

**File:** `app/Models/ClientTaskComment.php`
**Table:** `client_task_comments`

**Fillable:** `client_task_progress_id`, `user_id`, `body`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `taskProgress()` | belongsTo | `ClientTaskProgress` |
| `user()` | belongsTo | `User` |

---

### `ClientTaskFile`

**File:** `app/Models/ClientTaskFile.php`
**Table:** `client_task_files`

**Fillable:** `client_task_progress_id`, `uploaded_by`, `original_name`, `stored_name`, `path`, `ext`, `mime_type`, `size_mb`, `description`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `taskProgress()` | belongsTo | `ClientTaskProgress` |
| `uploader()` | belongsTo | `User` |

**Accessors:** `human_size`, `icon_class`, `download_url`

---

### `Process`

**File:** `app/Models/Process.php`
**Table:** `processes`

**Fillable:** `name`, `description`, `status`, `created_by`

**Relationships:**

| Method | Type | Related Model | Notes |
|--------|------|---------------|-------|
| `modules()` | hasMany | `ProcessModule` | Ordered by `order` |
| `creator()` | belongsTo | `User` | |
| `clientProcesses()` | hasMany | `ClientProcess` | |

---

### `ProcessModule`

**File:** `app/Models/ProcessModule.php`
**Table:** `process_modules`

**Fillable:** `process_id`, `name`, `description`, `order`, `status`

**Relationships:**

| Method | Type | Related Model | Notes |
|--------|------|---------------|-------|
| `process()` | belongsTo | `Process` | |
| `tasks()` | hasMany | `ProcessTask` | Ordered by `id` desc |

---

### `ProcessTask`

**File:** `app/Models/ProcessTask.php`
**Table:** `process_tasks`

**Fillable:** `module_id`, `title`, `description`, `priority`, `due_date`, `status`, `created_by`

**Relationships:**

| Method | Type | Related Model | Pivot Table | Pivot Columns |
|--------|------|---------------|-------------|---------------|
| `module()` | belongsTo | `ProcessModule` | — | — |
| `offices()` | belongsToMany | `ResponsibleOffices` | `office_task` | `status`, `remarks`, `assigned_at` |
| `creator()` | belongsTo | `User` | — | — |

**Accessors:** `is_overdue` (bool), `priority_color` (hex), `status_color` (hex)

---

### `ResponsibleOffices`

**File:** `app/Models/ResponsibleOffices.php`
**Table:** `responsible_offices`

**Fillable:** `responsible_office`, `office_status`

**Relationships:**

| Method | Type | Related Model | Pivot Table | Pivot Columns |
|--------|------|---------------|-------------|---------------|
| `users()` | belongsToMany | `User` | `office_user` | `role_in_office` |
| `tasks()` | belongsToMany | `ProcessTask` | `office_task` | `status`, `remarks`, `assigned_at` |
| `roles()` | belongsToMany | `Role` | `role_office` | — |

---

### `Role`

**File:** `app/Models/Role.php`
**Table:** `roles`

**Fillable:** `name`, `slug`, `description`

**Relationships:**

| Method | Type | Related Model | Pivot Table |
|--------|------|---------------|-------------|
| `permissions()` | belongsToMany | `Permission` | `role_permission` |
| `users()` | belongsToMany | `User` | `role_user` |
| `offices()` | belongsToMany | `ResponsibleOffices` | `role_office` |

**Methods:** `hasPermission($permission)`, `givePermission($permission)`, `revokePermission($permission)`

---

### `Permission`

**File:** `app/Models/Permission.php`
**Table:** `permissions`

**Fillable:** `name`, `slug`, `group`

**Relationships:**

| Method | Type | Related Model | Pivot Table |
|--------|------|---------------|-------------|
| `roles()` | belongsToMany | `Role` | `role_permission` |

---

### `Province`

**File:** `app/Models/Province.php`
**Table:** `provinces`
**Eager-loads:** `districts`

**Fillable:** `province`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `districts()` | hasMany | `Districts` |

---

### `Districts`

**File:** `app/Models/Districts.php`
**Table:** `districts`
**Eager-loads:** `connectionPoint`

**Fillable:** `province_id`, `district`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `province()` | belongsTo | `Province` |
| `connectionPoint()` | hasMany | `ConnectionPoints` |

---

### `ConnectionPoints`

**File:** `app/Models/ConnectionPoints.php`
**Table:** `connection_points`

**Fillable:** `district_id`, `substation`, `voltage_level`, `layout`, `firm_capacity`, `installed_capacity`, `substation_capacity`, `coordinates`, `status_id`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `districts()` | belongsTo | `Districts` |

---

### `Document`

**File:** `app/Models/Document.php`
**Table:** `documents`

**Fillable:** `folder_id`, `category_id`, `client_id`, `file_name`, `original_name`, `file_path`, `file_type`, `file_extension`, `mime_type`, `file_size`, `description`, `uploaded_by`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `folder()` | belongsTo | `DocumentFolder` |
| `category()` | belongsTo | `DocumentCategory` |
| `client()` | belongsTo | `IndependentProducer` |
| `uploader()` | belongsTo | `User` |

**Scopes:** `scopeInFolder`, `scopeOfCategory`, `scopeForClient`
**Accessors:** `human_size`, `icon_class`, `download_url`, `is_previewable`, `display_name`

---

### `DocumentFolder`

**File:** `app/Models/DocumentFolder.php`
**Table:** `document_folders`

**Fillable:** `name`, `parent_id`, `created_by`

**Relationships:**

| Method | Type | Related Model | Notes |
|--------|------|---------------|-------|
| `parent()` | belongsTo | `DocumentFolder` | Self-referencing |
| `children()` | hasMany | `DocumentFolder` | Direct children |
| `childrenRecursive()` | hasMany | `DocumentFolder` | Recursive eager-load |
| `documents()` | hasMany | `Document` | |
| `creator()` | belongsTo | `User` | |

---

### `DocumentCategory`

**File:** `app/Models/DocumentCategory.php`
**Table:** `document_categories`

**Fillable:** `name`, `description`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `documents()` | hasMany | `Document` |

---

### `FileUploads`

**File:** `app/Models/FileUploads.php`
**Table:** `file_uploads`

**Fillable:** `uuid`, `name`, `original_name`, `size`, `path`, `ext`, `mime_type`, `folder`, `model_id`, `modal_code`, `model_code`, `type`, `description`, `uploaded_by`

**Relationships:**

| Method | Type | Related Model |
|--------|------|---------------|
| `uploader()` | belongsTo | `User` |

**Accessors:** `human_size`, `icon_class`

---

## Relationship Diagram (Key Chains)

### Process Tracking Chain
```
ClientDetails
  └── ClientProcess (client_id)
       ├── Process (process_id)
       │    └── ProcessModule (process_id, ordered)
       │         └── ProcessTask (module_id)
       │              └── ResponsibleOffices (via office_task pivot)
       │                   └── Users (via office_user pivot)
       └── ClientTaskProgress (client_process_id)
            ├── ProcessTask (process_task_id)
            ├── ClientTaskComment (client_task_progress_id)
            │    └── User (user_id)
            └── ClientTaskFile (client_task_progress_id)
                 └── User (uploaded_by)
```

### RBAC Chain
```
User
  ├── Roles (via role_user pivot)
  │    ├── Permissions (via role_permission pivot)
  │    └── ResponsibleOffices (via role_office pivot)
  └── ResponsibleOffices (via office_user pivot, with role_in_office)
       └── ProcessTasks (via office_task pivot, with status/remarks)
```

### Geographic Chain
```
Province
  └── Districts (province_id)
       └── ConnectionPoints (district_id)
            └── IndependentProducer (province_id, district_id)
```

### Document Chain
```
DocumentFolder (self-referencing parent_id)
  └── Document (folder_id)
       ├── DocumentCategory (category_id)
       ├── IndependentProducer (client_id)
       └── User (uploaded_by)
```

---

## Custom Trait

### `HasRolesAndPermissions`

**File:** `app/Traits/HasRolesAndPermissions.php`
**Used by:** `User` model

**Methods provided:**

| Method | Purpose |
|--------|---------|
| `roles()` | belongsToMany relationship to `Role` |
| `hasRole($role)` | Check if user has a role (by slug) |
| `hasPermission($permission)` | Check if user has permission through any role |
| `assignRole($role)` | Attach a role to user |
| `removeRole($role)` | Detach a role from user |

---

*Last updated: March 2026*
