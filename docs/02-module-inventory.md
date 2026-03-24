# 02 — Module Inventory

> Complete catalogue of every Livewire module, its components, and their CRUD capabilities.

---

## Module Summary Matrix

| # | Module | List | Show | Create | Edit | Delete | Other |
|---|--------|:----:|:----:|:------:|:----:|:------:|-------|
| 1 | Clients | ✅ | ✅ | ✅ | — | — | Process assignment, task tracking |
| 2 | Task Action Centre | ✅ | ✅ | — | — | — | Status updates, comments, file uploads |
| 3 | Producers (IPP) | ✅ | ✅ | ✅ | ✅ | — | File upload, Excel import |
| 4 | Task Manager (Processes) | ✅ | ✅ | ✅ | ✅ | ✅ | Module/task nesting, office assignment |
| 5 | Modules | ✅ | ✅ | ✅ | — | — | Task management within module |
| 6 | Offices | ✅ | ✅ | ✅ | ✅ | ✅ | User assignment, task overview |
| 7 | Roles | ✅ | ✅ | ✅ | ✅ | ✅ | Permission assignment, office linking |
| 8 | Permissions | ✅ | — | ✅ | ✅ | ✅ | Group-based organisation |
| 9 | User Management | ✅ | ✅ | ✅ | ✅ | ✅ | Avatar upload, password reset, PHRIS search |
| 10 | User Roles | ✅ | — | — | — | — | Role assignment manager |
| 11 | Provinces | ✅ | ✅ | ✅ | ✅ | ✅ | Nested district/substation CRUD |
| 12 | Districts | ✅ | — | ✅ | ✅ | ✅ | Detail modal with substations |
| 13 | Connection Points | ✅ | — | ✅ | ✅ | ✅ | Province/district filters |
| 14 | Technologies | ✅ | — | ✅ | ✅ | ✅ | Detail modal |
| 15 | Ventures | ✅ | — | ✅ | ✅ | ✅ | — |
| 16 | Statuses | ✅ | — | ✅ | ✅ | ✅ | Engagement status types |
| 17 | Documents | ✅ | — | ✅ | ✅ | ✅ | Folder/category hierarchy |
| 18 | Files | ✅ | — | ✅ | — | ✅ | Type/extension filters, detail modal |
| 19 | Reports | — | — | — | — | — | Dashboard with 3 tabs (overview, table, charts) |
| 20 | Dashboard | — | — | — | — | — | Home page, search, password prompt |

---

## Detailed Module Breakdown

---

### 1. Clients

**Purpose:** Manage client companies and their onboarding/engagement processes.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Client List** | `Clients.php` | `/clients` | Paginated list, search, filters, quick view |
| **Client Create** | `ClientCreate.php` | `/clients/create` | Multi-field form (company info, contact, address), document upload rows |
| **Client Show** | `ClientShow.php` | `/clients/show/{id}` | Full detail, document list, process assignment modal, task tracking with status updates, task detail modal with comments/files counts |

**Key Features:**
- Assign predefined processes to clients (creates `ClientProcess` + `ClientTaskProgress` rows)
- Track task progress per module with status toggles (pending → in_progress → completed → skipped)
- Inline remarks per task
- Task detail modal with office/user visibility + link to full Task Action page

**Files:**
- `app/Http/Livewire/Clients/Clients.php`
- `app/Http/Livewire/Clients/ClientCreate.php`
- `app/Http/Livewire/Clients/ClientShow.php`
- `resources/views/livewire/clients/clients.blade.php`
- `resources/views/livewire/clients/client-create.blade.php`
- `resources/views/livewire/clients/client-show.blade.php`

---

### 2. Task Action Centre

**Purpose:** Global task management — view and action all client tasks across processes, modules, and clients.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Task List** | `ClientTaskList.php` | `/client-tasks` | 7 filters (search, status, client, process, module, office, priority), stats cards, smart ordering |
| **Task Action** | `ClientTaskAction.php` | `/client-tasks/{id}` | Status updates, remarks, comments (add/edit/delete), file uploads (multi-file), download, delete, sibling tasks, process progress |

**Key Features:**
- Stats header: total / pending / in-progress / completed counts
- Comment thread per task (with user avatars, timestamps, edit/delete for own comments)
- File attachments per task (multi-upload modal, file type icons, download, delete)
- Auto-syncs parent `ClientProcess` status when all tasks complete
- Sibling task navigation (other tasks in same module)

**Files:**
- `app/Http/Livewire/Clients/ClientTaskList.php`
- `app/Http/Livewire/Clients/ClientTaskAction.php`
- `resources/views/livewire/clients/client-task-list.blade.php`
- `resources/views/livewire/clients/client-task-action.blade.php`

---

### 3. Producers (IPP)

**Purpose:** Core IPP engagement registry — the primary data entity of the system.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Producer List** | `ProducerList.php` | `/independent-producer/index` | Paginated list, multi-field search, file upload, create modal |
| **Producer Show** | `ProducerShow.php` | `/independent-producer/show/{id}` | Full detail view, inline editing, file upload |

**Key Features:**
- 30+ fields per IPP (system ref, technology, capacity, location, contacts, venture type, etc.)
- Province/district/connection-point geographic linking
- Status tracking (engagement status)
- Excel bulk import via `ProducersImport`
- File attachments

**Files:**
- `app/Http/Livewire/Producers/ProducerList.php`
- `app/Http/Livewire/Producers/ProducerShow.php`
- `resources/views/livewire/producers/producer-list.blade.php`
- `resources/views/livewire/producers/producer-show.blade.php`
- `app/Imports/ProducersImport.php`

---

### 4. Task Manager (Processes)

**Purpose:** Define reusable process templates with modules and tasks that can be assigned to clients.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Process List** | `ProcessList.php` | `/task-manager` | List, create, edit, delete processes; status filter |
| **Process Show** | `ProcessShow.php` | `/task-manager/process/{id}` | Full detail with nested module CRUD, task CRUD, office pre-assignment, task detail modal with user visibility |

**Key Features:**
- Three-level hierarchy: **Process → Module → Task**
- Tasks have priority, due date, description, creator
- Pre-assign responsible offices to tasks (via `office_task` pivot)
- Offices show their personnel (via `office_user` pivot)
- "Pre-assignment" labelling to clarify these are template definitions

**Files:**
- `app/Http/Livewire/TaskManager/ProcessList.php`
- `app/Http/Livewire/TaskManager/ProcessShow.php`
- `resources/views/livewire/task-manager/process-list.blade.php`
- `resources/views/livewire/task-manager/process-show.blade.php`

---

### 5. Modules (Standalone)

**Purpose:** Manage standalone modules and their tasks (separate from process-based modules).

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Module List** | `ModuleList.php` | `/module/index` | List all modules, create new |
| **Module Show** | `ModuleShow.php` | `/module/show/{id}` | Detail view, task creation/management, office assignment |

**Files:**
- `app/Http/Livewire/Modules/ModuleList.php`
- `app/Http/Livewire/Modules/ModuleShow.php`
- `resources/views/livewire/modules/module-list.blade.php`
- `resources/views/livewire/modules/module-show.blade.php`

---

### 6. Offices (Responsible Offices)

**Purpose:** Manage organisational units that are responsible for tasks.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Office List** | `OfficeList.php` | `/office/index` | List, create, edit, delete offices; search |
| **Office Show** | `OfficeShow.php` | `/office/show/{id}` | Detail view, attach/detach users (with role\_in\_office), task list with status filter |
| **Responsible Office** | `ResponsibleOffice.php` | *(internal)* | Legacy create form |

**Key Features:**
- Users belong to offices with a specific `role_in_office` (via pivot)
- Offices are assigned to tasks (via `office_task` pivot)
- Offices can be linked to roles (via `role_office` pivot)
- Office show displays all tasks assigned to that office with their statuses

**Files:**
- `app/Http/Livewire/Office/OfficeList.php`
- `app/Http/Livewire/Office/OfficeShow.php`
- `app/Http/Livewire/Office/ResponsibleOffice.php`
- `resources/views/livewire/office/office-list.blade.php`
- `resources/views/livewire/office/office-show.blade.php`

---

### 7. Roles

**Purpose:** RBAC role management with permission and office assignment.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Role List** | `RoleList.php` | `/roles` | List, create, edit, delete roles |
| **Role Show** | `RoleShow.php` | `/roles/show/{id}` | Tabs: permissions, offices, users; attach/detach modals |

**Key Features:**
- Roles have `name`, `slug`, `description`
- Many-to-many with permissions, users, and offices
- Tab-based detail view

**Files:**
- `app/Http/Livewire/Roles/RoleList.php`
- `app/Http/Livewire/Roles/RoleShow.php`
- `resources/views/livewire/roles/role-list.blade.php`
- `resources/views/livewire/roles/role-show.blade.php`

---

### 8. Permissions

**Purpose:** Manage granular permissions that are assigned to roles.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Permission List** | `PermissionList.php` | `/permissions` | List, create, edit, delete; group dropdown |

**Files:**
- `app/Http/Livewire/Permissions/PermissionList.php`
- `resources/views/livewire/permissions/permission-list.blade.php`

---

### 9. User Management

**Purpose:** Manage system users, profiles, avatars, and passwords.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **User List** | `UserList.php` | `/users/index` | Paginated list, create via PHRIS staff search, delete |
| **User Show** | `UserShow.php` | `/users/show/{id}` | Profile view, avatar upload, inline editing, password reset, role tab |

**Key Features:**
- Staff search integrates with PHRIS Oracle database (`oracle_isd` connection)
- Avatar upload via Livewire's `WithFileUploads`
- Password change tracking (`password_changed` flag)
- Displays user's roles and offices

**Files:**
- `app/Http/Livewire/UserManagement/UserList.php`
- `app/Http/Livewire/UserManagement/UserShow.php`
- `resources/views/livewire/user-management/user-list.blade.php`
- `resources/views/livewire/user-management/user-show.blade.php`

---

### 10. User Roles

**Purpose:** Quick role assignment interface for bulk managing user-role relationships.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **User Role Manager** | `UserRoleManager.php` | `/user-roles` | Assign/remove roles to users via modal |

**Files:**
- `app/Http/Livewire/Users/UserRoleManager.php`
- `resources/views/livewire/users/user-role-manager.blade.php`

---

### 11. Provinces

**Purpose:** Geographic hierarchy — provinces containing districts containing substations.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Province List** | `ProvinceList.php` | `/province/index` | List, create, edit, delete; search & sort |
| **Province Show** | `ProvinceShow.php` | `/province/show/{id}/{district?}` | Province detail with nested district CRUD and substation CRUD |

**Key Features:**
- Three-level nesting: Province → District → Connection Point (Substation)
- Optional district deep-link via URL parameter
- Inline CRUD at each level

**Files:**
- `app/Http/Livewire/Provinces/ProvinceList.php`
- `app/Http/Livewire/Provinces/ProvinceShow.php`
- `resources/views/livewire/provinces/province-list.blade.php`
- `resources/views/livewire/provinces/province-show.blade.php`

---

### 12. Districts

**Purpose:** District management with substation visibility.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **District List** | `DistrictList.php` | `/districts` | List, create, edit, delete; detail modal showing substations & IPP count |

**Files:**
- `app/Http/Livewire/Districts/DistrictList.php`
- `resources/views/livewire/districts/district-list.blade.php`

---

### 13. Connection Points (Substations)

**Purpose:** Manage electrical substations with technical specifications.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Connection Point List** | `ConnectionPointList.php` | `/connection-points` | List, create, edit, delete; province/district filters |

**Key Fields:** Substation name, voltage level, layout, firm capacity, installed capacity, substation capacity, coordinates, status.

**Files:**
- `app/Http/Livewire/ConnectionPoints/ConnectionPointList.php`
- `resources/views/livewire/connection-points/connection-point-list.blade.php`

---

### 14. Technologies

**Purpose:** Reference data for IPP technology types (Solar, Wind, Hydro, etc.).

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Technology List** | `TechnologyList.php` | `/technology` | List, create, edit, delete; detail modal showing linked IPPs |

**Files:**
- `app/Http/Livewire/Technologies/TechnologyList.php`
- `resources/views/livewire/technologies/technology-list.blade.php`

---

### 15. Ventures

**Purpose:** Reference data for venture types (JV, Build-Own-Operate, etc.).

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Venture List** | `VentureList.php` | `/ventures` | List, create, edit, delete |

**Files:**
- `app/Http/Livewire/Ventures/VentureList.php`
- `resources/views/livewire/ventures/venture-list.blade.php`

---

### 16. Statuses

**Purpose:** Reference data for IPP engagement statuses.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Status List** | `StatusList.php` | `/status/index` | List, create, edit, delete |

**Files:**
- `app/Http/Livewire/Statuses/StatusList.php`
- `resources/views/livewire/statuses/status-list.blade.php`

---

### 17. Documents

**Purpose:** Hierarchical document management with folders and categories.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Document Manager** | `DocumentManager.php` | `/documents` | Folder tree, category filter, upload, inline CRUD, preview |

**Key Features:**
- Recursive folder hierarchy (`DocumentFolder` self-referencing)
- Category tagging (`DocumentCategory`)
- File preview for supported types (images, PDFs)
- Client/IPP linking

**Files:**
- `app/Http/Livewire/Documents/DocumentManager.php`
- `resources/views/livewire/documents/document-manager.blade.php`

---

### 18. Files

**Purpose:** Flat file listing and management (non-hierarchical).

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **File Manager** | `FileManager.php` | `/files` | File list, type/extension filters, upload to IPP, detail modal, delete |

**Files:**
- `app/Http/Livewire/Files/FileManager.php`
- `resources/views/livewire/files/file-manager.blade.php`

---

### 19. Reports

**Purpose:** Analytics dashboard with overview stats, data table, and charts.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Reports Dashboard** | `ReportsDashboard.php` | `/reports` | Three tabs: overview, table, charts; multi-filter (province, district, technology, venture, status, date range) |

**Key Features:**
- Uses ECharts for pie/bar/line visualisations
- Filters apply across all three tabs
- Direct link from sidebar for "Graphical Reports" → charts tab

**Files:**
- `app/Http/Livewire/Reports/ReportsDashboard.php`
- `resources/views/livewire/reports/reports-dashboard.blade.php`

---

### 20. Dashboard (Home)

**Purpose:** Landing page after login.

| Component | File | Route | Capabilities |
|-----------|------|-------|-------------|
| **Dashboard** | `Dashboard.php` | `/` or `/home` | Search, technology filter, password change prompt |

**Files:**
- `app/Http/Livewire/Dashboard/Dashboard.php`
- `resources/views/livewire/dashboard/dashboard.blade.php`

---

## Component Count Summary

| Category | Count |
|----------|-------|
| Livewire module folders | 19 |
| Livewire component classes | 30 |
| Blade view files | ~30 |
| Total routes | 34 |

---

*Last updated: March 2026*
