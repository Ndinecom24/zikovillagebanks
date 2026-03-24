# IPP Management System — Technical Documentation

> **Independent Power Producers (IPP) Management System**
> Internal ZESCO tool for managing Independent Power Producer engagements, client processes, task tracking, and organisational data.

---

## Documentation Index

| # | Document | Description |
|---|----------|-------------|
| 1 | [System Overview](./01-system-overview.md) | Architecture, tech stack, directory layout, environment setup |
| 2 | [Module Inventory](./02-module-inventory.md) | Every module with its components (list, show, create, edit, delete) |
| 3 | [Database Schema](./03-database-schema.md) | All tables, columns, relationships, pivot tables, migrations |
| 4 | [Routes & Navigation](./04-routes-and-navigation.md) | Complete route map, middleware, sidebar structure |
| 5 | [Models & Relationships](./05-models-and-relationships.md) | Eloquent models, fillable fields, relationships, accessors |

---

## Quick Reference

- **Framework:** Laravel 9.x + Livewire 2.x
- **Database:** Oracle (primary) / MySQL (fallback)
- **UI:** AdminLTE 3 + Bootstrap 4 + Custom ZESCO design system (`z-*` CSS classes)
- **Server:** Laragon (Windows)
- **Total Livewire Modules:** 19 folders, 30 components
- **Total Models:** 29+
- **Total Migrations:** 36
- **Total Routes:** 34 (32 GET + 2 POST)

---

*Last updated: March 2026*
