# ======================================================================================
# 📜 build_master_v4.py
#
# This script generates a master version snapshot of the MMS CRM project.
# It scans selected folders (Models, Controllers, Seeders, Routes), extracts the contents
# of each .php file, and outputs them to a single text file: master_version_vX.txt
#
# ✅ You can run this script directly in PowerShell: python build_master_v4.py
#
# The script automatically increments version number (v1, v2, v3, ...) — no manual edits.
#
# ======================================================================================

import os
import glob
import re

# === CONFIGURATION ===

# Root of project:
BASE_DIR = r"C:\xampp\htdocs\mms-crm-core"

# Output filename prefix:
OUTPUT_PREFIX = "master_version_v"

# Output will be written here:
OUTPUT_FOLDER = BASE_DIR

# Folders to include in snapshot (relative to BASE_DIR):
FOLDERS = [
    "Lovable Resources",
    "app",
    "app\Filament",
    "app\Filament\Resources",
    "app\Filament\Resources\CustomerResource",
    "app\Filament\Resources\CustomerResource\Pages",
    "app\Filament\Resources\UserResource",
    "app\Filament\Resources\UserResource\Pages",
    "app\Helpers",
    "app\Http",
    "app\Http\Controllers",
    "app\Mail",
    "app\Models",
    "app\Providers",
    "app\Providers\Filament",
    "bootstrap",
    "bootstrap\cache",
    "config",
    "database",
    "database\factories",
    "database\migrations",
    "database\schema",
    "database\seeders",
    "public",
    "public\css",
    "public\css\filament",
    "public\css\filament\filament",
    "public\css\filament\forms",
    "public\css\filament\support",
    "public\js",
    "public\js\filament",
    "public\js\filament\filament",
    "public\js\filament\forms",
    "public\js\filament\forms\components",
    "public\js\filament\notifications",
    "public\js\filament\support",
    "public\js\filament\tables",
    "public\js\filament\tables\components",
    "public\js\filament\widgets",
    "public\js\filament\widgets\components",
    "public\js\filament\widgets\components\stats-overview",
    "public\js\filament\widgets\components\stats-overview\stat",
    "resources",
    "resources\css",
    "resources\js",
    "resources\views",
    "resources\views\customers",
    "resources\views\dashboards",
    "resources\views\dealers",
    "resources\views\emails",
    "resources\views\emails\invoices",
    "resources\views\emails\quotes",
    "resources\views\invoices",
    "resources\views\layouts",
    "resources\views\partials",
    "resources\views\quotes",
    "routes",
    "storage",
    "storage\app",
    "storage\app\private",
    "storage\app\private\livewire-tmp",
    "storage\app\public",
    "storage\app\public\logos"
]

# === DETECT CURRENT VERSION FILES ===

existing_files = glob.glob(os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}*.txt"))

# Extract version numbers:
version_numbers = []
for file in existing_files:
    match = re.search(rf"{OUTPUT_PREFIX}(\d+)\.txt", os.path.basename(file))
    if match:
        version_numbers.append(int(match.group(1)))

# Compute next version:
next_version = max(version_numbers, default=0) + 1
output_file = os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}{next_version}.txt")

# === BUILD MASTER FILE ===

with open(output_file, "w", encoding="utf-8") as out_f:
    for folder in FOLDERS:
        folder_path = os.path.join(BASE_DIR, folder)
        if not os.path.isdir(folder_path):
            continue

        out_f.write(f"\n\n===== FOLDER: {folder} =====\n\n")

        for root, dirs, files in os.walk(folder_path):
            for file in files:
                if file.endswith(".php"):
                    file_path = os.path.join(root, file)
                    rel_path = os.path.relpath(file_path, BASE_DIR)

                    out_f.write(f"\n--- FILE: {rel_path} ---\n")
                    try:
                        with open(file_path, "r", encoding="utf-8") as f:
                            out_f.write(f.read())
                            out_f.write("\n")
                    except Exception as e:
                        out_f.write(f"[ERROR READING FILE: {e}]\n")

print(f"\n✅ MASTER VERSION GENERATED: {os.path.basename(output_file)}\n")
