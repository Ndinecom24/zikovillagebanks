# 02 — Authentication & Authorisation

> Auth flow, role-based access control, permissions, middleware chain, and session management.

---

## Authentication

### Login Flow

<!-- TODO: Document login process, password reset, email verification -->

### Password Policy

<!-- TODO: Document StrongPassword rule and requirements -->

### Single Session Enforcement

<!-- TODO: Document SingleSession middleware behaviour -->

---

## Role-Based Access Control (RBAC)

### Roles

| Role | Slug | Description |
|------|------|-------------|
| Super Admin | `super-admin` | Full system access, manages village banks |
| Chairperson | `chairperson` | Village bank leader, approves loans |
| Secretary | `secretary` | Records, minutes, member management |
| Treasurer | `treasurer` | Financial operations, shares, loans |
| Committee Member | `committee-member` | Voting, limited management |
| Member | `member` | Basic participation, own shares/loans |

### Permission Groups

<!-- TODO: List all 15 permission groups with their individual permissions -->

### Role → Permission Matrix

<!-- TODO: Create a matrix showing which roles have which permissions -->

---

## Middleware Stack

| Middleware | Class | Purpose |
|-----------|-------|---------|
| `auth` | `Authenticate` | Verifies user is logged in |
| `check.license` | `CheckLicense` | Validates active subscription/license |
| `check.permission` | `CheckPermission` | RBAC permission gate |
| `check.role` | `CheckRole` | RBAC role gate |
| `village.bank` | `EnsureVillageBankSelected` | Requires active village bank context |
| `single.session` | `SingleSession` | Prevents concurrent logins |

### Middleware Execution Order

<!-- TODO: Document the order middleware is applied and route group assignments -->

---

## Session Management

<!-- TODO: Document session driver, lifetime, village bank context storage -->

---

*Last updated: April 2026*
