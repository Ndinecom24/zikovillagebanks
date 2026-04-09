# Ziko Village Banks

A comprehensive **Village Banking Management System** built with Laravel, enabling communities to manage savings groups, loans, share declarations, and financial operations digitally.

---

## Features

- **Village Bank Management** — Create and manage multiple village banks with configurable settings
- **Member Management** — Register members, manage roles (Chairperson, Secretary, Treasurer, Committee Member, Member), and track membership
- **Share Declarations** — Members declare and track monthly share contributions
- **Loan Management** — Loan requests, approvals, pairing, repayment tracking, and forced loans
- **Circles** — Organize members into circles within a village bank
- **Insurance / Social Fund** — Configurable insurance contributions per member
- **Polls & Voting** — Create polls for democratic decision-making within the bank
- **Rules Management** — Define and manage village bank rules with member acknowledgements
- **Phase & Month Management** — Track banking cycles with phases and monthly periods
- **Shareout Calculator** — Calculate and distribute end-of-cycle shareouts
- **Reports & Analytics** — Financial reports, membership reports, loan reports, and analytics dashboards
- **Subscription & Licensing** — Multi-tier subscription plans with license management
- **Role-Based Access Control** — Granular permissions system with role-based access
- **Activity Logging** — Track user actions across the system
- **Single Session Enforcement** — Prevent concurrent logins

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 9.x |
| Reactive UI | Livewire 2.x |
| Frontend Theme | AdminLTE 3 + Bootstrap 4 |
| Database | Oracle / MySQL |
| Dev Environment | Laragon (Windows) |
| Spreadsheet Import | Maatwebsite Excel |
| Image Processing | Intervention Image |

---

## Installation

### Prerequisites

- PHP 8.0+
- Composer
- Node.js & NPM
- MySQL 8.x or Oracle database
- Laragon (recommended for Windows) or any local server

### Setup

```bash
# Clone the repository
git clone https://github.com/Ndinecom24/zikovillagebanks.git
cd zikovillagebanks

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env, then run migrations
php artisan migrate

# Seed the database (roles, permissions, plans)
php artisan db:seed

# Compile assets
npm run dev

# Start the development server
php artisan serve
```

---

## Project Structure

```
app/
├── Http/Livewire/          # Livewire components (UI logic)
│   ├── VillageBanking/     # Core banking components (Circles, Loans, Members, etc.)
│   ├── VillageBanks/       # Village bank CRUD
│   ├── Subscription/       # Licensing & subscription management
│   ├── RoleBasedAccess/    # Roles & permissions management
│   ├── UserManagement/     # User profiles & role assignment
│   └── ActivityLogs/       # Activity log viewer
├── Models/
│   ├── VillageBanking/     # Core domain models (VillageBank, Loan, Member, etc.)
│   ├── Subscription/       # License, Plan, Payment models
│   └── RoleBasedAccess/    # Role & Permission models
├── Services/               # Business logic services
├── Middleware/              # CheckLicense, EnsureVillageBankSelected, SingleSession
└── Traits/                 # LogsActivity, ScopedToVillageBank
resources/views/
├── livewire/               # Blade templates for Livewire components
└── layouts/                # Application layout templates
routes/
└── web.php                 # Application routes
technical-docs/             # Detailed technical documentation
```

---

## Documentation

Comprehensive technical documentation is available in the [`technical-docs/`](technical-docs/) directory:

1. [System Architecture](technical-docs/01-system-architecture.md)
2. [Authentication & Authorisation](technical-docs/02-authentication-and-authorisation.md)
3. [Database Schema](technical-docs/03-database-schema.md)
4. [Livewire Components](technical-docs/04-livewire-components.md)
5. [Routes & Navigation](technical-docs/05-routes-and-navigation.md)
6. [Models & Relationships](technical-docs/06-models-and-relationships.md)
7. [Village Banking Operations](technical-docs/07-village-banking-operations.md)
8. [Loan Management](technical-docs/08-loan-management.md)
9. [Subscription & Licensing](technical-docs/09-subscription-and-licensing.md)
10. [Configuration Reference](technical-docs/10-configuration-reference.md)

---

## License

This project is proprietary software developed by **Ndinecom**.
