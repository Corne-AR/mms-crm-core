@echo off
echo Running deployment.bat for MMS CRM (Laravel 12 + Filament 3)

REM Change to project directory
cd /d C:\xampp\htdocs\mms-crm-core

REM Composer install
echo Installing composer dependencies...
composer install

REM Run migrations and seed database
echo Running database migrations and seeders...
php artisan migrate:fresh --seed

REM Create Filament admin user (if first run)
echo Creating Filament admin user...
php artisan make:filament-user

REM Optionally start local dev server
echo Starting Laravel development server...
php artisan serve

pause
