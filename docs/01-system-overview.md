# 01 — System Overview

## 1. Introduction

The **Independent Power Producers (IPP) Management System** is an internal web application built for ZESCO Limited. It tracks IPP engagements from initial application through to commissioning, manages client onboarding processes, assigns tasks to responsible offices, and provides reporting dashboards.

---

## 2. Technology Stack

| Layer | Technology | Version / Notes |
|-------|-----------|----------------|
| **Backend Framework** | Laravel | 9.x |
| **Reactive UI** | Livewire | 2.x (full-page + nested components) |
| **Database (Primary)** | Oracle | via `yajra/laravel-oci8` — two connections: `oracle` (main) and `oracle_isd` (external staff lookup) |
| **Database (Fallback)** | MySQL | Standard Laravel driver |
| **Frontend CSS** | AdminLTE 3 + Bootstrap 4 | With custom ZESCO `z-*` component classes |
| **JavaScript** | jQuery | AdminLTE dependency; minimal custom JS |
| **Icons** | Font Awesome 5 | Free tier |
| **Charts** | ECharts | Used in Reports dashboard |
| **Excel Import** | Maatwebsite/Excel | Bulk IPP import via `ProducersImport` |
| **Image Processing** | Intervention/Image | Avatar handling |
| **Media Library** | Spatie Media Library | Configured but lightly used |
| **Server Environment** | Laragon | Windows local development |
| **Package Manager** | Composer (PHP) / npm (assets) | `composer.json`, `package.json` |

---

## 3. Architecture Pattern

```
┌──────────────────────────────────────────────────┐
│                    Browser                        │
│  AdminLTE 3 + Bootstrap 4 + ZESCO z-* CSS        │
└──────────────────┬───────────────────────────────┘
                   │  HTTP (Livewire AJAX / page loads)
┌──────────────────▼───────────────────────────────┐
│              Laravel 9 Application                │
│                                                   │
│  routes/web.php ──► Livewire Full-Page Components │
│                     (app/Http/Livewire/**)         │
│                          │                        │
│                     Eloquent Models               │
│                     (app/Models/**)                │
│                          │                        │
│                  Query Builder / ORM              │
└──────────────────┬───────────────────────────────┘
                   │
┌──────────────────▼───────────────────────────────┐
│          Oracle Database (Primary)                │
│          MySQL (fallback/dev)                     │
└──────────────────────────────────────────────────┘
```

### Key Architectural Decisions

- **No traditional Controllers for pages** — all page rendering uses Livewire full-page components registered directly in `routes/web.php`.
- **Two conventional Controllers exist:**
  - `UserController` — staff search (PHRIS Oracle lookup) + password change.
  - `Auth\*` — Laravel's built-in authentication controllers.
- **Custom middleware** — `CheckRole` and `CheckPermission` for RBAC.
- **Oracle-specific SQL** throughout (e.g. `TO_NUMBER(... DEFAULT 0 ON CONVERSION ERROR)`, `ROWNUM`).

---

## 4. Directory Structure

```
├── app/
│   ├── Console/Kernel.php              # Scheduled commands
│   ├── Exceptions/Handler.php          # Error handling
│   ├── Helpers/helper.php              # Custom env() override
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                   # Laravel auth scaffolding
│   │   │   ├── Controller.php          # Base controller
│   │   │   └── UserController.php      # Staff search + password change
│   │   ├── Kernel.php                  # HTTP middleware pipeline
│   │   ├── Livewire/                   # ★ ALL page components (19 modules)
│   │   │   ├── Clients/                #   Client management + task tracking
│   │   │   ├── ConnectionPoints/       #   Substation management
│   │   │   ├── Dashboard/              #   Home dashboard
│   │   │   ├── Districts/              #   District CRUD
│   │   │   ├── Documents/              #   Document manager (folders + categories)
│   │   │   ├── Files/                  #   Flat file manager
│   │   │   ├── Modules/                #   Standalone module/task builder
│   │   │   ├── Office/                 #   Responsible office management
│   │   │   ├── Permissions/            #   Permission CRUD
│   │   │   ├── Producers/              #   IPP producer management
│   │   │   ├── Provinces/              #   Province + nested district/substation
│   │   │   ├── Reports/                #   Reporting dashboard
│   │   │   ├── Roles/                  #   Role CRUD + permission assignment
│   │   │   ├── Statuses/               #   Engagement status CRUD
│   │   │   ├── TaskManager/            #   Process/module/task definition
│   │   │   ├── Technologies/           #   Technology type CRUD
│   │   │   ├── UserManagement/         #   User CRUD + profile
│   │   │   ├── Users/                  #   User-role assignment
│   │   │   └── Ventures/               #   Venture type CRUD
│   │   └── Middleware/
│   │       ├── CheckPermission.php     # Custom permission gate
│   │       └── CheckRole.php           # Custom role gate
│   ├── Imports/ProducersImport.php     # Excel bulk import
│   ├── Models/                         # 29+ Eloquent models
│   ├── Providers/                      # Service providers
│   ├── Rules/                          # Custom validation rules
│   ├── Services/                       # Service classes
│   └── Traits/                         # HasRolesAndPermissions trait
│
├── config/
│   ├── oracle.php                      # Oracle DB connections
│   ├── livewire.php                    # Livewire configuration
│   └── ...                             # Standard Laravel configs
│
├── database/
│   ├── migrations/                     # 36 migration files (2014–2026)
│   ├── seeders/                        # Database seeders
│   └── factories/                      # Model factories
│
├── public/
│   ├── css/zesco-components.css        # ★ Custom ZESCO design system
│   ├── dashboard/                      # AdminLTE assets
│   ├── echarts/                        # Chart library
│   └── storage/ → ../storage/app/public  # Symlinked uploads
│
├── resources/
│   ├── views/
│   │   ├── layouts/                    # Master layouts (auth, main, livewire)
│   │   │   ├── main/sidebar.blade.php  # Sidebar navigation
│   │   │   └── master-livewire.blade.php # Main layout wrapper
│   │   └── livewire/                   # Blade views per module
│   └── lang/                           # Localisation
│
├── routes/
│   ├── web.php                         # All web routes (34 routes)
│   └── api.php                         # API routes (minimal)
│
└── storage/
    └── app/public/                     # Uploaded files
        └── client-task-files/          # Task attachment uploads
```

---

## 5. Environment Setup

### Prerequisites

- PHP 8.0+ with OCI8 extension (for Oracle)
- Composer 2.x
- Node.js 16+ / npm (for asset compilation)
- Oracle Instant Client (if connecting to Oracle)
- Laragon (recommended) or any LAMP/WAMP stack

### Installation

```bash
# 1. Clone repository
git clone https://github.com/ZESCOISD/Independent-Power-Producers-Management-System.git
cd Independent-Power-Producers-Management-System

# 2. Install PHP dependencies
composer install

# 3. Install frontend dependencies
npm install && npm run dev

# 4. Copy environment file
cp .env.example .env
php artisan key:generate

# 5. Configure database in .env
#    DB_CONNECTION=oracle
#    DB_HOST=...
#    DB_PORT=1521
#    DB_DATABASE=...

# 6. Run migrations
php artisan migrate

# 7. Create storage symlink
php artisan storage:link

# 8. Start server
php artisan serve
# Or use Laragon's built-in Apache/Nginx
```

### Key `.env` Variables

| Variable | Purpose |
|----------|---------|
| `DB_CONNECTION` | `oracle` or `mysql` |
| `DB_HOST` / `DB_PORT` / `DB_DATABASE` | Primary database |
| `DB_USERNAME` / `DB_PASSWORD` | Database credentials |
| `ORACLE_ISD_*` | Secondary Oracle connection for PHRIS staff lookup |
| `APP_NAME` | Application display name |
| `FILESYSTEM_DISK` | Default storage disk (`public`) |

---

## 6. Authentication & Authorisation

| Mechanism | Implementation |
|-----------|---------------|
| **Authentication** | Laravel's built-in `Auth::routes()` — login, register, password reset |
| **Password Change** | Custom flow via `UserController@changePassword` with `password_changed` flag |
| **Role-Based Access** | Custom `Role` model with `HasRolesAndPermissions` trait on `User` |
| **Permission Check** | `CheckPermission` middleware — checks `role_permission` pivot |
| **Role Check** | `CheckRole` middleware — checks `role_user` pivot |
| **Pivot Tables** | `role_user`, `role_permission`, `role_office` |

---

## 7. Custom Design System

The application uses a custom CSS design system (`public/css/zesco-components.css`) layered on top of AdminLTE 3. Key class prefixes:

| Prefix | Purpose | Examples |
|--------|---------|---------|
| `z-card` | Card styling | Rounded corners, subtle shadows |
| `z-badge` | Status badges | Colour-coded status indicators |
| `z-table` | Table styling | Compact, bordered, hover states |
| `z-filter-select` | Filter dropdowns | Styled select elements |
| `z-search` | Search inputs | With icon integration |
| `z-action` | Action buttons | Consistent button styling |
| `z-page-header` | Page headers | Gradient background with breadcrumbs |
| `z-count` | Count badges | Small circular count indicators |

**CSS Variables:**
- `--z-green` — ZESCO primary green
- `--z-green-dark` — Darker green variant
- `--z-gold` — ZESCO gold accent

---

*Last updated: March 2026*
