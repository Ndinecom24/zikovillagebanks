# 14 — Testing Strategy

> Test structure, writing guidelines, factories, fixtures, and coverage targets.

---

## Current State

> ⚠️ The project currently has only default Laravel example tests. This document defines the target testing strategy.

---

## Test Structure

```
tests/
├── Unit/               # Isolated unit tests (services, models, helpers)
├── Feature/            # HTTP/Livewire integration tests
├── TestCase.php        # Base test class
└── CreatesApplication.php
```

---

## Recommended Test Categories

### Unit Tests

<!-- TODO: Define what should be unit tested:
  - Service methods (LoanEligibilityService, ForcedLoanService, etc.)
  - Model accessors and mutators
  - Helper functions
  - Validation rules (StrongPassword)
-->

### Feature Tests

<!-- TODO: Define what should be feature tested:
  - Livewire component rendering
  - CRUD operations through components
  - Middleware behaviour
  - Auth flows
-->

### Livewire Component Tests

<!-- TODO: Define Livewire-specific testing patterns:
  - Livewire::test() usage
  - Property assertion
  - Event emission testing
  - Validation testing
-->

---

## Factories

<!-- TODO: Define model factories needed for testing -->

---

## Coverage Targets

| Category | Target |
|----------|--------|
| Services | 90%+ |
| Models | 80%+ |
| Livewire Components | 70%+ |
| Middleware | 90%+ |
| **Overall** | **75%+** |

---

## Running Tests

```bash
# All tests
php artisan test

# With coverage
php artisan test --coverage

# Specific test file
php artisan test tests/Unit/Services/LoanEligibilityServiceTest.php
```

---

*Last updated: April 2026*
