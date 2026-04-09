# 17 — Troubleshooting & FAQ

> Common issues, debugging tips, and known quirks.

---

## Common Issues

### Database Connection

<!-- TODO: Document common Oracle/MySQL connection problems and fixes -->

### Livewire

<!-- TODO: Document common Livewire issues:
  - Component not found
  - File upload size limits
  - Session expiry during long forms
-->

### Authentication

<!-- TODO: Document:
  - Login loop issues
  - Session/cookie problems
  - Single session conflicts
-->

### Permissions

<!-- TODO: Document:
  - Permission not working after seeding
  - Cache clearing for permission changes
-->

---

## Debugging Tips

<!-- TODO: Document:
  - How to enable debug mode
  - Laravel Telescope (if used)
  - Log file locations
  - Useful artisan commands for debugging
-->

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Check route list
php artisan route:list

# Tinker for quick debugging
php artisan tinker
```

---

## Known Quirks

<!-- TODO: Document any platform-specific issues or workarounds -->

---

## FAQ

<!-- TODO: Add frequently asked developer questions -->

---

*Last updated: April 2026*
