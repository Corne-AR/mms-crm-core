# MMS Design CRM — Roadmap & To-Do

## ✅ Phase 1: Core Infrastructure
- [x] Blade Layouts: light/dark mode, responsive
- [x] Navbar, Sidebar, Footer
- [x] Auth & Role Permissions (Gate)

## ✅ Phase 2: Core Modules
- [x] Customers Index
- [x] Dealers Index
- [x] Quote Builder UI
- [x] Quote Store Logic (static & dynamic)

## 🔄 Phase 3: Operational Features
- [ ] Invoices Create/Store
- [ ] Invoices PDF Preview & Download
- [ ] Quote to PDF & Email
- [ ] Dashboard KPI Statistics

## 🟡 Phase 4: Optional & Advanced
- [ ] Livewire Integration
- [ ] StockLevels CRUD
- [ ] Kit Assembly Management
- [ ] Notification System

---

Use `master_version_v12.txt` to track all files and updates.


---

### 📁 Files (from master_version_v12.txt)

===== ROOT FILES =====

--- FILE: .env ---
APP_NAME="MMS Design CRM"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost/mms-crm/public

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mms_crm
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your.smtp.host
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@email.com
MAIL_FROM_NAME="${APP_NAME}"

PDF_DRIVER=dompdf

--- FILE: composer.json ---
{
    "name": "mmsdesign/mms-crm",
    "description": "MMS CRM System - Dealer & Sub-Dealer Quoting & Invoicing",
    "type": "project",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "filament/filament": "^3.0",
        "barryvdh/laravel-dompdf": "^3.1"
    },
    "require-dev": {
        "fakerphp/faker": "^1.9.1",
        "phpunit/phpunit": "^10.0",
        "larastan/larastan": "^3.4"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Helpers/helpers.php"
        ]
    },
    "scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ]
    }
}


--- 
...

---

### 🎨 UI Branding Stylesheet
- File: `public/css/mms-brand.css`
- Purpose: Defines MMS Design CRM theme colors, buttons, navbars, tables, and layout polish
