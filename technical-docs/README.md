# Chilolezo — Village Banking Application · Technical Documentation

> **Chilolezo** is a Village Banking (VSLA) management system built with Laravel 9, Livewire 2, and AdminLTE 3.
> This folder contains **current, authoritative** technical documentation for the platform.

---

## Documentation Index

| #  | Document | Description | Priority |
|----|----------|-------------|----------|
| 01 | [System Architecture](./01-system-architecture.md) | Tech stack, high-level architecture, directory layout, environment setup | 🔴 High |
| 02 | [Authentication & Authorisation](./02-authentication-and-authorisation.md) | Auth flow, RBAC, roles, permissions, middleware chain, session management | 🔴 High |
| 03 | [Database Schema](./03-database-schema.md) | All tables, columns, relationships, pivot tables, migration catalogue | 🔴 High |
| 04 | [Livewire Components](./04-livewire-components.md) | Component inventory, naming conventions, lifecycle, data flow patterns | 🔴 High |
| 05 | [Routes & Navigation](./05-routes-and-navigation.md) | Complete route map, middleware assignments, sidebar/menu structure | 🟡 Medium |
| 06 | [Models & Relationships](./06-models-and-relationships.md) | Eloquent models, fillable fields, relationships, scopes, traits, accessors | 🟡 Medium |
| 07 | [Village Banking Operations](./07-village-banking-operations.md) | Circles, shares, insurance, shareout calculations, rules & bylaws | 🔴 High |
| 08 | [Loan Management](./08-loan-management.md) | Loan eligibility, application flow, forced loans, repayments, interest | 🔴 High |
| 09 | [Subscription & Licensing](./09-subscription-and-licensing.md) | Subscription plans, license enforcement middleware, renewal flow, emails | 🟡 Medium |
| 10 | [Configuration Reference](./10-configuration-reference.md) | All config files, environment variables, feature flags | 🟡 Medium |
| 11 | [Services & Business Logic](./11-services-and-business-logic.md) | Service classes, helper functions, domain logic layer | 🟡 Medium |
| 12 | [Mail & Notifications](./12-mail-and-notifications.md) | Mailable classes, notification channels, templates, triggers | 🟢 Low |
| 13 | [Security Guide](./13-security-guide.md) | CSRF, XSS prevention, single session, input validation, password rules | 🟡 Medium |
| 14 | [Testing Strategy](./14-testing-strategy.md) | Test structure, writing guidelines, factories, coverage targets | 🟡 Medium |
| 15 | [Deployment & Environment Setup](./15-deployment-and-environment-setup.md) | Server requirements, installation steps, Oracle/MySQL config, Laragon setup | 🟢 Low |
| 16 | [API Reference](./16-api-reference.md) | API routes (if any), request/response formats, authentication | 🟢 Low |
| 17 | [Troubleshooting & FAQ](./17-troubleshooting-and-faq.md) | Common issues, debugging tips, known quirks | 🟢 Low |
| 18 | [Changelog](./18-changelog.md) | Version history, feature additions, breaking changes | 🟢 Low |

---

## Quick Reference

| Attribute | Value |
|-----------|-------|
| **Application** | Chilolezo — Village Banking System |
| **Framework** | Laravel 9.x + Livewire 2.x |
| **Database** | Oracle (primary) / MySQL (fallback) |
| **UI** | AdminLTE 3 + Bootstrap 4 |
| **Server** | Laragon (Windows, development) |
| **Roles** | Super Admin, Chairperson, Secretary, Treasurer, Committee Member, Member |
| **Permission Groups** | 15 groups, 40+ permissions |

---

## How to Use These Docs

1. **New developer?** Start with [01 — System Architecture](./01-system-architecture.md), then [02 — Auth](./02-authentication-and-authorisation.md).
2. **Working on a feature?** Jump to the relevant domain doc (07, 08, or 09).
3. **Debugging?** Check [17 — Troubleshooting](./17-troubleshooting-and-faq.md).
4. **Deploying?** See [15 — Deployment](./15-deployment-and-environment-setup.md).

---

## Documentation Standards

- Use **Markdown** for all docs.
- Include **code examples** where applicable.
- Keep docs **in sync with code** — update during PR review.
- Use Mermaid diagrams for flows and relationships.
- Date-stamp each document's last update.

---

*Last updated: April 2026*
