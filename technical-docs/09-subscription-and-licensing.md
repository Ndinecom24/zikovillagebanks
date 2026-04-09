# 09 — Subscription & Licensing

> Subscription plans, license keys, enforcement middleware, renewal flow, and notification emails.

---

## Subscription Model

<!-- TODO: Document:
  - Subscription plans / tiers
  - Pricing
  - Feature limits per tier
  - Trial period
-->

---

## License Enforcement

<!-- TODO: Document:
  - CheckLicense middleware logic
  - LicenseEnforcement service
  - What happens when license expires
  - Grace period (if any)
-->

---

## Application Flow

```mermaid
sequenceDiagram
    %% TODO: Village bank application → review → approval/rejection → license issuance
```

---

## Payment Methods

<!-- TODO: Document UserPaymentMethod model and supported payment methods -->

---

## Email Notifications

| Mailable | Trigger | Recipient |
|----------|---------|-----------|
| `ApplicationReceived` | New village bank application submitted | Applicant |
| `ApplicationApproved` | Application approved by admin | Applicant |
| `ApplicationRejected` | Application rejected by admin | Applicant |
| `LicenseExpiringSoon` | License approaching expiry | Village bank admin |

<!-- TODO: Document email templates and customisation -->

---

## Renewal Process

<!-- TODO: Document license renewal workflow -->

---

*Last updated: April 2026*
