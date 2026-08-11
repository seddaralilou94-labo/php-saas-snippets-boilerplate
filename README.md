# Lightweight PHP SaaS Starter Snippets (Multi-Tenant, Stripe, Auth)

A collection of framework-agnostic, production-ready **PHP 8** snippets designed to build and scale a SaaS application without heavy dependencies. Works with plain **PHP + PDO** (Laravel, Symfony, or Native PHP).

[![Gumroad](https://img.shields.io/badge/Get%20Full%20Pack-Gumroad-orange?style=for-the-badge&logo=gumroad)](https://loulou42.gumroad.com/l/irkra)

---

## What's Included in the Pack

| Snippet File | Feature / Purpose | Status |
|---|---|---|
| `01-multi-tenant-db-connection.php` | Auto-scoped multi-tenant database connection wrapper | Pro Pack |
| `02-tenant-rules-engine.php` | Per-tenant business rules & rate limits engine | Pro Pack |
| `03-stripe-webhook-handler.php` | Secure Stripe subscription lifecycle webhook handler | Pro Pack |
| `04-printable-view-helper.php` | Print-ready HTML helper (Invoices, Payslips, Contracts) | Pro Pack |
| `05-tenant-scoped-auth.php` | Session-based auth preventing cross-tenant data leaks | Pro Pack |
| `06-rate-limiter.php` | Database-backed API & Login rate limiter (No Redis needed) | Pro Pack |
| `07-csv-export.php` | UTF-8 compliant CSV exporter for Excel | Pro Pack |
| `08-env-config-loader.php` | Zero-dependency `.env` environment loader | Included Free |
| `09-audit-logger.php` | Compliance audit logger for tracking user actions | Pro Pack |
| `10-input-validator.php` | Lightweight fluent input & data validation | Included Free |

---

## Quick Start

### Requirements
* **PHP 8.0+**
* **PDO Extension** (MySQL / MariaDB / PostgreSQL)
* Optional: `stripe/stripe-php` via Composer (for Stripe webhooks)

### How to Use
Each file is completely self-contained. Copy and paste the class or function directly into your PHP codebase.

```php
// Example: Loading environment variables
require_once '08-env-config-loader.php';
$config = loadEnv(__DIR__ . '/.env');
require_once '08-env-config-loader.php';
$config = loadEnv(__DIR__ . '/.env');
