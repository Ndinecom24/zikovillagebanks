# 01 — System Architecture

> High-level architecture, tech stack, directory layout, and environment setup for the Chilolezo Village Banking application.

---

## Tech Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| Backend Framework | Laravel | 9.x |
| Reactive UI | Livewire | 2.x |
| Frontend Theme | AdminLTE | 3.x |
| CSS Framework | Bootstrap | 4.x |
| Database (primary) | Oracle | — |
| Database (fallback) | MySQL | 8.x |
| Dev Server | Laragon | Windows |
| Package Manager | Composer / NPM | — |
| Spreadsheet Import | Maatwebsite Excel | — |
| Image Processing | Intervention Image | — |

---

## Architecture Overview

```
┌─────────────────────────────────────────────────┐
│                   Browser                       │
│         (AdminLTE 3 + Bootstrap 4)              │
└──────────────────┬──────────────────────────────┘
                   │  HTTP / WebSocket (Livewire)
┌──────────────────▼──────────────────────────────┐
│              Laravel 9 Application              │
│  ┌───────────┐  ┌──────────┐  ┌──────────────┐  │
│  │ Middleware │→ │ Livewire │→ │   Services   │  │
│  │  Chain     │  │Components│  │ (Business    │  │
│  │           │  │          │  │  Logic)      │  │
│  └───────────┘  └──────────┘  └──────┬───────┘  │
│                                      │          │
│  ┌───────────┐  ┌──────────┐  ┌──────▼───────┐  │
│  │  Models   │← │  Scopes  │← │ Eloquent ORM │  │
│  └───────────┘  └──────────┘  └──────┬───────┘  │
└──────────────────────────────────────┼──────────┘
                                       │
                   ┌───────────────────▼──────────┐
                   │    Oracle / MySQL Database    │
                   └──────────────────────────────┘
```

---

## Directory Structure

<!-- TODO: Document the full directory tree with descriptions of each folder's purpose -->

---

## Environment Setup

<!-- TODO: Document .env variables, database config, required PHP extensions -->

---

## Request Lifecycle

<!-- TODO: Document the flow from HTTP request through middleware → Livewire → response -->

---

## Key Design Decisions

<!-- TODO: Document why Livewire over traditional controllers, Oracle vs MySQL, etc. -->

---

*Last updated: April 2026*
