# ======================================================================================
# 📜 build_master_v4.py (updated)
#
# This script generates a single master snapshot of the MMS CRM project,
# including all .php, .json files and the .env file.
#
# It scans selected folders and root files, then outputs them to a single
# text file: master_version_vX.txt (auto-incremented).
#
# Usage: python build_master_v4.py
# ======================================================================================

import os
import glob
import re

# === CONFIGURATION ===

# Root of project (raw string to avoid unicode escapes)
BASE_DIR = r"C:/xampp/htdocs/mms-crm-core"

# Output filename prefix:
OUTPUT_PREFIX = "master_version_v"

# Where to write output:
OUTPUT_FOLDER = BASE_DIR

# Folders to include in snapshot (using forward slashes to avoid escape issues):
FOLDERS = [
    "app",
    "app/Filament",
    "app/Filament/Resources",
    "app/Filament/Resources/CustomerResource",
    "app/Filament/Resources/CustomerResource/Pages",
    "app/Filament/Resources/UserResource",
    "app/Filament/Resources/UserResource/Pages",
    "app/Helpers",
    "app/Http",
    "app/Http/Controllers",
    "app/Mail",
    "app/Models",
    "app/Providers",
    "app/Providers/Filament",
    "bootstrap",
    "bootstrap/cache",
    "config",
    "database",
    "database/factories",
    "database/migrations",
    "database/schema",
    "database/seeders",
    "public",
    "public/css",
    "public/js",
    "public/js/filament",
    "resources",
    "resources/css",
    "resources/js",
    "resources/views",
    "resources/views/emails",
    "resources/views/layouts",
    "resources/views/partials",
    "routes",
    "storage",
]

# Root-level files to include:
ROOT_FILES = [
    ".env",
    "composer.json",
    "package.json",
    "phpstan.neon"
]

# === DETECT CURRENT VERSION FILES ===
existing_files = glob.glob(os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}*.txt"))
version_numbers = []
for file in existing_files:
    m = re.search(rf"{OUTPUT_PREFIX}(\d+)\.txt", os.path.basename(file))
    if m:
        version_numbers.append(int(m.group(1)))
next_version = max(version_numbers, default=0) + 1
output_file = os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}{next_version}.txt")

# === BUILD MASTER FILE ===
with open(output_file, "w", encoding="utf-8") as out_f:
    # Include root files
    out_f.write("===== ROOT FILES =====\n\n")
    for fname in ROOT_FILES:
        path = os.path.join(BASE_DIR, fname)
        if os.path.isfile(path):
            out_f.write(f"--- FILE: {fname} ---\n")
            try:
                with open(path, "r", encoding="utf-8") as f:
                    out_f.write(f.read())
                    out_f.write("\n\n")
            except Exception as e:
                out_f.write(f"[ERROR READING {fname}: {e}]\n\n")

    # Scan folders
    for folder in FOLDERS:
        folder_path = os.path.join(BASE_DIR, folder)
        if not os.path.isdir(folder_path):
            continue
        out_f.write(f"===== FOLDER: {folder} =====\n\n")
        for root, dirs, files in os.walk(folder_path):
            for file in sorted(files):
                # Include .php, .json and .env
                if file.endswith(('.php', '.json')) or file == '.env':
                    file_path = os.path.join(root, file)
                    rel_path = os.path.relpath(file_path, BASE_DIR)
                    out_f.write(f"--- FILE: {rel_path} ---\n")
                    try:
                        with open(file_path, "r", encoding="utf-8") as f:
                            out_f.write(f.read())
                            out_f.write("\n\n")
                    except Exception as e:
                        out_f.write(f"[ERROR READING {rel_path}: {e}]\n\n")

print(f"\n✅ MASTER VERSION GENERATED: {os.path.basename(output_file)}\n")
