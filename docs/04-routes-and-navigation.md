# 04 — Routes & Navigation

> Complete route map, middleware configuration, and sidebar structure.

---

## Route Overview

All application routes are defined in `routes/web.php`. Every page route uses a **Livewire full-page component** registered directly (no controllers). Only two traditional controller routes exist (staff search + password change).

**Authentication:** All routes are wrapped in `auth` middleware — users must be logged in.

---

## Complete Route Table

### Authentication Routes (Laravel Built-in)

| Method | URI | Name | Handler |
|--------|-----|------|---------|
| GET | `/login` | `login` | `Auth\LoginController` |
| POST | `/login` | — | `Auth\LoginController` |
| POST | `/logout` | `logout` | `Auth\LoginController` |
| GET | `/register` | `register` | `Auth\RegisterController` |
| POST | `/register` | — | `Auth\RegisterController` |
| GET | `/password/reset` | `password.request` | `Auth\ForgotPasswordController` |
| POST | `/password/email` | `password.email` | `Auth\ForgotPasswordController` |
| GET | `/password/reset/{token}` | `password.reset` | `Auth\ResetPasswordController` |
| POST | `/password/reset` | `password.update` | `Auth\ResetPasswordController` |
| GET | `/password/confirm` | `password.confirm` | `Auth\ConfirmPasswordController` |
| POST | `/password/confirm` | — | `Auth\ConfirmPasswordController` |

### Application Routes (auth middleware)

| # | Method | URI | Route Name | Component / Controller | Module |
|---|--------|-----|-----------|----------------------|--------|
| 1 | GET | `/` | *(none)* | `Dashboard\Dashboard` | Dashboard |
| 2 | GET | `/home` | `home` | `Dashboard\Dashboard` | Dashboard |
| 3 | GET | `/independent-producer/index` | `independent-producer.index` | `Producers\ProducerList` | Producers |
| 4 | GET | `/independent-producer/show/{id}` | `independent-producer.show` | `Producers\ProducerShow` | Producers |
| 5 | GET | `/users/index` | `user.index` | `UserManagement\UserList` | User Management |
| 6 | GET | `/users/show/{id}` | `user.show` | `UserManagement\UserShow` | User Management |
| 7 | POST | `/search` | `user.search` | `UserController@getStaffDetails` | User Management |
| 8 | POST | `/change` | `user.change.password` | `UserController@changePassword` | User Management |
| 9 | GET | `/reports` | `reports.index` | `Reports\ReportsDashboard` | Reports |
| 10 | GET | `/province/index` | `province.index` | `Provinces\ProvinceList` | Provinces |
| 11 | GET | `/province/show/{id}/{district?}` | `province.show` | `Provinces\ProvinceShow` | Provinces |
| 12 | GET | `/districts` | `district.index` | `Districts\DistrictList` | Districts |
| 13 | GET | `/connection-points` | `connection-point.index` | `ConnectionPoints\ConnectionPointList` | Connection Points |
| 14 | GET | `/status/index` | `status.index` | `Statuses\StatusList` | Statuses |
| 15 | GET | `/graphical-reports` | `graphical.reports` | *Redirect → /reports?activeTab=charts* | Reports |
| 16 | GET | `/technology` | `technology.index` | `Technologies\TechnologyList` | Technologies |
| 17 | GET | `/ventures` | `venture.index` | `Ventures\VentureList` | Ventures |
| 18 | GET | `/files` | `files.index` | `Files\FileManager` | Files |
| 19 | GET | `/documents` | `documents.index` | `Documents\DocumentManager` | Documents |
| 20 | GET | `/task-manager` | `task-manager.index` | `TaskManager\ProcessList` | Task Manager |
| 21 | GET | `/task-manager/process/{id}` | `task-manager.show` | `TaskManager\ProcessShow` | Task Manager |
| 22 | GET | `/module/index` | `module.index` | `Modules\ModuleList` | Modules |
| 23 | GET | `/module/show/{id}` | `module.show` | `Modules\ModuleShow` | Modules |
| 24 | GET | `/office/index` | `office.index` | `Office\OfficeList` | Offices |
| 25 | GET | `/office/show/{id}` | `office.show` | `Office\OfficeShow` | Offices |
| 26 | GET | `/roles` | `roles.index` | `Roles\RoleList` | Roles |
| 27 | GET | `/roles/show/{id}` | `roles.show` | `Roles\RoleShow` | Roles |
| 28 | GET | `/permissions` | `permissions.index` | `Permissions\PermissionList` | Permissions |
| 29 | GET | `/user-roles` | `user-roles.index` | `Users\UserRoleManager` | User Roles |
| 30 | GET | `/clients` | `clients.index` | `Clients\Clients` | Clients |
| 31 | GET | `/clients/create` | `clients.create` | `Clients\ClientCreate` | Clients |
| 32 | GET | `/clients/show/{id}` | `clients.show` | `Clients\ClientShow` | Clients |
| 33 | GET | `/client-tasks` | `client-tasks.index` | `Clients\ClientTaskList` | Task Action Centre |
| 34 | GET | `/client-tasks/{id}` | `client-tasks.show` | `Clients\ClientTaskAction` | Task Action Centre |

---

## Middleware Stack

### Global Middleware (HTTP Kernel)

| Middleware | Purpose |
|-----------|---------|
| `TrustProxies` | Trusted proxy headers |
| `PreventRequestsDuringMaintenance` | Maintenance mode |
| `TrimStrings` | Trim input whitespace |
| `EncryptCookies` | Cookie encryption |
| `VerifyCsrfToken` | CSRF protection |

### Route Middleware

| Key | Class | Purpose |
|-----|-------|---------|
| `auth` | `Authenticate` | Require authenticated user |
| `guest` | `RedirectIfAuthenticated` | Redirect logged-in users |
| `role` | `CheckRole` | Check user has specific role |
| `permission` | `CheckPermission` | Check user has specific permission |

### Usage Pattern

```php
// All app routes wrapped in auth
Route::middleware('auth')->group(function () {
    Route::get('/clients', Clients::class)->name('clients.index');
    // ...
});

// Permission-gated routes (example)
Route::middleware(['auth', 'permission:manage-users'])->group(function () {
    Route::get('/users/index', UserList::class)->name('user.index');
});
```

---

## Sidebar Navigation Structure

The sidebar is defined in `resources/views/layouts/main/sidebar.blade.php` using AdminLTE 3 treeview pattern.

### Navigation Tree

```
📊 Dashboard                    → /home
│
├── IPP MANAGEMENT
│   ├── 📋 IPP Producers        → /independent-producer/index
│   ├── 👥 Clients              → /clients
│   └── 📋 Task Action Centre   → /client-tasks
│
├── TASK MANAGEMENT
│   ├── ⚙️ Processes            → /task-manager
│   └── 📦 Modules              → /module/index
│
├── ORGANISATION
│   ├── 🏢 Offices              → /office/index
│   ├── 🔑 Roles                → /roles
│   ├── 🛡️ Permissions          → /permissions
│   └── 👤 User Roles           → /user-roles
│
├── REFERENCE DATA
│   ├── 📊 Reports              → /reports
│   ├── 📈 Graphical Reports    → /graphical-reports
│   ├── 🗺️ Provinces            → /province/index
│   ├── 🏘️ Districts            → /districts
│   ├── ⚡ Connection Points    → /connection-points
│   ├── 🔧 Technologies         → /technology
│   ├── 🏭 Ventures             → /ventures
│   └── 📌 Statuses             → /status/index
│
├── DOCUMENTS
│   ├── 📁 File Manager          → /files
│   └── 📄 Documents             → /documents
│
└── USER MANAGEMENT
    ├── 👥 Users                  → /users/index
    └── 📊 Reports                → /reports
```

### Active State Detection

Each sidebar item uses `request()->routeIs()` to highlight the active page:

```blade
<li class="nav-item">
    <a href="{{ route('clients.index') }}"
       class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>Clients</p>
    </a>
</li>
```

---

## Route Naming Conventions

| Pattern | Meaning | Example |
|---------|---------|---------|
| `{module}.index` | List page | `clients.index` |
| `{module}.show` | Detail page | `clients.show` |
| `{module}.create` | Create form | `clients.create` |
| `{module}.edit` | Edit form | *(rarely used — edits are inline)* |

> **Note:** Most modules handle create, edit, and delete via Livewire modals within the list or show page rather than separate routes. This keeps the route count low while providing full CRUD functionality.

---

*Last updated: March 2026*
