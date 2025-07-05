# MMS Design CRM Development Guidelines

## ✅ Protocols for Reliable Development

### 1. File-Aware Edits Only (June 2025)

Before suggesting any code changes, the assistant **must**:

* 🔍 Inspect the uploaded file (if available)
* ✅ Confirm presence of existing `use`, `namespace`, or class declarations
* 🧪 Simulate Laravel behavior to identify conflicts
* ⛔ Avoid duplicate statements or breaking changes

**Example:**
Do **not** suggest `use Illuminate\Support\Facades\Route;` if it's already present in `routes/web.php`.

---

### 2. Deployment Safety

* All setup commands (e.g., `composer install`, `php artisan migrate`) must check current environment state before running.
* Any instructions affecting `.env`, file paths, or services (MySQL, Apache) must note the local XAMPP defaults.

---

### 3. Naming Conventions

* File names should follow lowercase-with-hyphens if in `/public` or `/resources`, and StudlyCase for PHP class files.
* Avoid overlapping names (e.g., `DashboardController.php` and `Dashboard.blade.php` both being "default") unless explicitly intentional.

---

### 4. Routes & Redirects

* Always check `routes/web.php` before modifying a route or suggesting changes.
* Any redirection logic (like to `/admin`) should include context of existing middleware, auth, or route groups.

---

### 5. Project File Hygiene

* Prefer batch updates via `prep_files_FINAL.bat`
* Duplicates are tracked in `DUPLICATE_REPORT.txt`, and must be resolved before commit
* Keep `master_version_v10.txt` aligned with final folder layout and modules

---

### 6. Laravel Package Awareness

* Always confirm that traits (like `HasApiTokens`) are covered by installed packages (e.g., `laravel/sanctum`)
* Never assume default Laravel scaffolding; always refer to actual implementation (e.g., Laravel Breeze, Filament)

---

More sections can be added based on team input or lessons during deployment.

> Maintained by: MMS Design CRM Designer (MyGPT)
> Last updated: 2025-06-15
