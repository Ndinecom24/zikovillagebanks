# 03 — Database Schema

> All tables, columns, relationships, pivot tables, and migration history.

---

## Entity Relationship Overview

```
┌─────────────────┐       ┌──────────────────┐       ┌─────────────────────┐
│    provinces     │──1:N──│    districts      │──1:N──│  connection_points  │
└─────────────────┘       └──────────────────┘       └─────────────────────┘
                                   │
                                   │ FK
                          ┌────────▼────────┐
                          │ independent_    │
                          │ producers       │──── file_uploads
                          └────────┬────────┘
                                   │ FK (province_id, district_id)
                                   │

┌──────────────┐     ┌──────────────────┐     ┌────────────────────┐
│   clients    │─1:N─│  client_process  │─1:N─│ client_task_       │
│              │     │                  │     │ progress           │
└──────────────┘     └───────┬──────────┘     └──┬─────────────────┘
                             │ FK                  │ 1:N         1:N
                     ┌───────▼──────────┐     ┌───▼──────┐  ┌──────▼──────┐
                     │   processes      │     │ client_  │  │ client_     │
                     └───────┬──────────┘     │ task_    │  │ task_files  │
                             │ 1:N            │ comments │  └─────────────┘
                     ┌───────▼──────────┐     └──────────┘
                     │ process_modules  │
                     └───────┬──────────┘
                             │ 1:N
                     ┌───────▼──────────┐     ┌─────────────────────┐
                     │  process_tasks   │─M:N─│ responsible_offices │
                     └──────────────────┘     └──────┬──────────────┘
                           (office_task)              │ M:N
                                              ┌──────▼──────┐
                                              │    users     │
                                              └──────┬───────┘
                                               (office_user)
                                                     │ M:N
                                              ┌──────▼──────┐
                                              │    roles     │──M:N── permissions
                                              └─────────────┘
                                               (role_user, role_permission, role_office)
```

---

## Table Definitions

### Core Business Tables

#### `independent_producers`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | Auto-increment |
| `system_ref` | string | System reference code |
| `name_of_ipp` | string | IPP company name |
| `technology` | string | Technology type |
| `engagement_number` | string | Engagement tracking number |
| `date_of_application` | date | Application date |
| `size_of_plant` | string | Plant capacity |
| `size_of_plant_unit` | string | MW / kW |
| `province_id` | FK → provinces | Geographic location |
| `district_id` | FK → districts | Geographic location |
| `proposed_connection_point` | string | Target substation |
| `total_system_generated` | string | Total generation capacity |
| `available_capacity` | string | Available capacity |
| `voltage_level` | string | Connection voltage |
| `date_of_connection` | date | Grid connection date |
| `expiry_connection_point` | date | Connection expiry |
| `status_of_engagement` | string | Engagement status text |
| `updates_on_engagements` | text | Latest update notes |
| `date_of_update` | date | Last status update date |
| `updated_by` | string | Last updated by (name) |
| `contact_person_name` | string | Primary contact |
| `contact_person_email` | string | Contact email |
| `contact_person_phone` | string | Contact phone |
| `type_of_venture` | string | Joint Venture, BOO, etc. |
| `expected_date_commissioning` | date | Expected commissioning |
| `expected_commercial` | date | Expected commercial operation |
| `preferred_connection_level` | string | Preferred voltage level |
| `ipp_tariff` | string | Proposed tariff |
| `status_id` | FK → statuses | Current status |
| `invoiced_services` | string | Invoiced services |
| `created_at` / `updated_at` | timestamps | Laravel timestamps |
| `deleted_at` | timestamp | Soft delete |

#### `clients` (model: `ClientDetails`)
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `company_name` | string | Client company name |
| `phone` | string | Phone number |
| `phone_area_code` | string | Country code |
| `email` | string | Email address |
| `address_line_1` | string | Street address |
| `address_line` | string | Address line 2 |
| `city` | string | City |
| `province` | string | Province name (text, not FK) |
| `country` | string | Country |
| `postal_code` | string | Postal/ZIP code |
| `tpin` | string | Tax Payer Identification Number |
| `is_active` | boolean | Active flag |
| `created_by` | string | Creator name |
| `created_by_staff_no` | string | Creator staff number |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

---

### Process & Task Tracking Tables

#### `processes`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Process name |
| `description` | text | Process description |
| `status` | string | `active` / `inactive` |
| `created_by` | FK → users | Creator |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `process_modules`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `process_id` | FK → processes | Parent process |
| `name` | string | Module name |
| `description` | text | Module description |
| `order` | integer | Sort order within process |
| `status` | string | `active` / `inactive` |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `process_tasks`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `module_id` | FK → process_modules | Parent module |
| `title` | string | Task title |
| `description` | text | Task description |
| `priority` | string | `low` / `medium` / `high` / `critical` |
| `due_date` | date | Task due date |
| `status` | string | `active` / `inactive` |
| `created_by` | FK → users | Creator |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `client_process`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `client_id` | FK → clients | Client |
| `process_id` | FK → processes | Assigned process |
| `status` | string | `in_progress` / `completed` |
| `started_at` | timestamp | When process was started |
| `completed_at` | timestamp | When all tasks completed |
| `started_by` | FK → users | Who initiated |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `client_task_progress`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `client_process_id` | FK → client_process | Parent client-process link |
| `process_task_id` | FK → process_tasks | Which task |
| `status` | string | `pending` / `in_progress` / `completed` / `skipped` |
| `remarks` | text | Task notes (legacy single remark) |
| `completed_by` | FK → users | Who completed |
| `completed_at` | timestamp | When completed |
| `created_at` / `updated_at` | timestamps | |
| **Unique constraint** | | `(client_process_id, process_task_id)` |

#### `client_task_comments`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `client_task_progress_id` | FK → client_task_progress | Parent task |
| `user_id` | FK → users | Comment author |
| `body` | text | Comment content |
| `created_at` / `updated_at` | timestamps | |

#### `client_task_files`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `client_task_progress_id` | FK → client_task_progress | Parent task |
| `uploaded_by` | FK → users | Uploader |
| `original_name` | string | Original filename |
| `stored_name` | string | Disk filename |
| `path` | string | Storage path |
| `ext` | string(20) | File extension |
| `mime_type` | string | MIME type |
| `size_mb` | decimal(10,2) | File size in MB |
| `description` | text | Optional description |
| `created_at` / `updated_at` | timestamps | |

---

### Geographic Tables

#### `provinces`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `province` | string | Province name |
| `created_at` / `updated_at` | timestamps | |

#### `districts`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `province_id` | FK → provinces | Parent province |
| `district` | string | District name |
| `created_at` / `updated_at` | timestamps | |

#### `connection_points`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `district_id` | FK → districts | Parent district |
| `substation` | string | Substation name |
| `voltage_level` | string | Voltage level |
| `layout` | string | Substation layout |
| `firm_capacity` | string | Firm capacity |
| `installed_capacity` | string | Installed capacity |
| `substation_capacity` | string | Total substation capacity |
| `coordinates` | string | GPS coordinates |
| `status_id` | FK → statuses | Operational status |
| `created_at` / `updated_at` | timestamps | |

---

### Auth / RBAC Tables

#### `users`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Full name |
| `staff_no` | string | ZESCO staff number |
| `directorate` | string | Organisational directorate |
| `email` | string | Email (unique) |
| `avatar` | string | Avatar file path |
| `job_title` | string | Job title |
| `user_unit` | string | Organisational unit |
| `mobile_no` | string | Mobile phone |
| `user_role_id` | integer | Legacy role field |
| `password` | string | Hashed password |
| `password_changed` | boolean | Has user changed default password |
| `total_login` | integer | Login count |
| `uuid` | string | UUID |
| `email_verified_at` | timestamp | Email verification |
| `remember_token` | string | Remember me token |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `roles`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Role name |
| `slug` | string | URL-safe identifier |
| `description` | text | Role description |
| `created_at` / `updated_at` | timestamps | |

#### `permissions`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Permission name |
| `slug` | string | URL-safe identifier |
| `group` | string | Grouping label |
| `created_at` / `updated_at` | timestamps | |

#### `responsible_offices`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `responsible_office` | string | Office name |
| `office_status` | string | Active/inactive |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

---

### Pivot Tables

| Table | Connects | Extra Columns |
|-------|----------|---------------|
| `role_user` | roles ↔ users | — |
| `role_permission` | roles ↔ permissions | — |
| `role_office` | roles ↔ responsible_offices | — |
| `office_user` | responsible_offices ↔ users | `role_in_office` |
| `office_task` | process_tasks ↔ responsible_offices | `status`, `remarks`, `assigned_at` |

---

### Reference Data Tables

| Table | Purpose | Key Columns |
|-------|---------|-------------|
| `statuses` | Engagement status types | `name`, `description`, `color` |
| `technologies` | Technology types (Solar, Wind, etc.) | `name`, `description` |
| `ventures` | Venture types (JV, BOO, etc.) | `name`, `description` |
| `nodes` | System nodes | *(legacy)* |

---

### Document / File Tables

#### `file_uploads`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `uuid` | string | Unique file identifier |
| `name` | string | Stored filename |
| `original_name` | string | Original filename |
| `size` | decimal | File size (MB) |
| `path` | string | Storage path |
| `ext` | string | File extension |
| `mime_type` | string | MIME type |
| `folder` | string | Logical folder |
| `model_id` | bigint | Related entity ID |
| `modal_code` / `model_code` | string | Reference codes |
| `type` | string | File type category |
| `description` | text | Description |
| `uploaded_by` | FK → users | Uploader |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `document_categories`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Category name |
| `description` | text | Description |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `document_folders`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `name` | string | Folder name |
| `parent_id` | FK → self | Parent folder (null = root) |
| `created_by` | FK → users | Creator |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

#### `documents`
| Column | Type | Notes |
|--------|------|-------|
| `id` | bigint PK | |
| `folder_id` | FK → document_folders | Parent folder |
| `category_id` | FK → document_categories | Category |
| `client_id` | FK → independent_producers | Linked IPP |
| `file_name` | string | Stored filename |
| `original_name` | string | Original filename |
| `file_path` | string | Storage path |
| `file_type` | string | File type |
| `file_extension` | string | Extension |
| `mime_type` | string | MIME type |
| `file_size` | decimal | Size |
| `description` | text | Description |
| `uploaded_by` | FK → users | Uploader |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp | Soft delete |

---

### Other System Tables

| Table | Purpose |
|-------|---------|
| `password_resets` | Laravel password reset tokens |
| `failed_jobs` | Laravel failed queue jobs |
| `personal_access_tokens` | Sanctum API tokens |
| `media` | Spatie Media Library (configured, lightly used) |
| `comments` | Legacy comments table |
| `modules` | Standalone modules (non-process) |
| `module_tasks` | Standalone module tasks |
| `independent_producer_lists` | Legacy / secondary IPP listing |

---

## Migration History

| # | Migration | Table Created/Modified |
|---|-----------|----------------------|
| 1 | `2014_10_12_000000` | `users` |
| 2 | `2014_10_12_100000` | `password_resets` |
| 3 | `2019_08_19_000000` | `failed_jobs` |
| 4 | `2019_12_14_000001` | `personal_access_tokens` |
| 5 | `2023_03_15_185215` | `independent_producers` |
| 6 | `2023_03_16_093724` | `file_uploads` |
| 7 | `2023_04_13_160503` | `nodes` |
| 8 | `2023_04_13_160758` | `independent_producer_lists` |
| 9 | `2023_04_13_162052` | `provinces` |
| 10 | `2023_04_13_162138` | `districts` |
| 11 | `2023_04_14_074850` | `connection_points` |
| 12 | `2023_04_19_081947` | `comments` |
| 13 | `2023_06_14_112340` | `statuses` |
| 14 | `2023_08_29_074311` | `technologies` |
| 15 | `2023_08_29_081438` | `ventures` |
| 16 | `2026_03_18_105352` | `media` |
| 17 | `2026_03_18_113916` | `modules` |
| 18 | `2026_03_18_142541` | `module_tasks` |
| 19 | `2026_03_18_171812` | `responsible_offices` |
| 20 | `2026_03_19_000001` | `roles`, `permissions`, `role_user`, `role_permission` |
| 21 | `2026_03_19_000002` | `users` (add `avatar`) |
| 22 | `2026_03_20_000001` | `file_uploads` (improvements) |
| 23 | `2026_03_20_100001` | `document_categories` |
| 24 | `2026_03_20_100002` | `document_folders` |
| 25 | `2026_03_20_100003` | `documents` |
| 26 | `2026_03_20_161816` | `client_details` (clients) |
| 27 | `2026_03_20_200001` | `processes` |
| 28 | `2026_03_20_200002` | `process_modules` |
| 29 | `2026_03_20_200003` | `process_tasks` |
| 30 | `2026_03_20_200004` | `office_task` (pivot) |
| 31 | `2026_03_20_300001` | `office_user` (pivot) |
| 32 | `2026_03_20_400001` | `role_office` (pivot) |
| 33 | `2026_03_21_100001` | `client_process` |
| 34 | `2026_03_21_100002` | `client_task_progress` |
| 35 | `2026_03_21_120001` | `client_task_comments` |
| 36 | `2026_03_21_120002` | `client_task_files` |

---

*Last updated: March 2026*
