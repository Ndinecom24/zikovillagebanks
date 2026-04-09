# 15 — Deployment & Environment Setup

> Server requirements, installation steps, Oracle/MySQL configuration, and development environment setup.

---

## System Requirements

| Requirement | Version |
|------------|---------|
| PHP | 8.0+ |
| Composer | 2.x |
| Node.js | 16+ |
| NPM | 8+ |
| Oracle Client | — |
| MySQL (fallback) | 8.x |

### Required PHP Extensions

<!-- TODO: List required PHP extensions (oci8, pdo_mysql, mbstring, etc.) -->

---

## Development Setup (Laragon)

<!-- TODO: Step-by-step Laragon setup guide:
  1. Clone repository
  2. Composer install
  3. NPM install & build
  4. Copy .env.example
  5. Configure database
  6. Run migrations
  7. Seed data
  8. Start server
-->

---

## Database Setup

### Oracle Configuration

<!-- TODO: Document Oracle TNS, connection strings, oci8 setup -->

### MySQL Configuration

<!-- TODO: Document MySQL fallback setup -->

---

## Production Deployment

<!-- TODO: Document production deployment steps, server config, optimisation commands -->

```bash
# Production optimisation
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Scheduled Tasks

<!-- TODO: Document any cron/scheduled tasks in app/Console/Kernel.php -->

---

*Last updated: April 2026*
