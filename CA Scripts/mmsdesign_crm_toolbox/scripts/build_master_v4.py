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
import ctypes

def main():
    # === CONFIGURATION ===

    BASE_DIR = r"C:/xampp/htdocs/mms-crm-core"
    OUTPUT_PREFIX = "master_version_v"
    OUTPUT_FOLDER = os.path.join(BASE_DIR, "docs")
    os.makedirs(OUTPUT_FOLDER, exist_ok=True)

    FOLDERS = [
        "app", "app/Filament", "app/Filament/Resources", "app/Filament/Resources/CustomerResource",
        "app/Filament/Resources/CustomerResource/Pages", "app/Filament/Resources/UserResource",
        "app/Filament/Resources/UserResource/Pages", "app/Helpers", "app/Http", "app/Http/Controllers",
        "app/Mail", "app/Models", "app/Providers", "app/Providers/Filament", "bootstrap", "bootstrap/cache",
        "config", "database", "database/factories", "database/migrations", "database/schema",
        "database/seeders", "docs", "Lovable Resources", "public", "public/css", "public/js", "public/js/filament", "resources",
        "resources/css", "resources/js", "resources/views", "resources/views/emails", "resources/views/layouts",
        "resources/views/partials", "routes", "storage"
    ]

    ROOT_FILES = [".env", "composer.json", "package.json", "phpstan.neon"]

    existing_files = glob.glob(os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}*.txt"))
    version_numbers = [int(m.group(1)) for file in existing_files if (m := re.search(rf"{OUTPUT_PREFIX}(\d+)\.txt", os.path.basename(file)))]
    next_version = max(version_numbers, default=0) + 1
    output_file = os.path.join(OUTPUT_FOLDER, f"{OUTPUT_PREFIX}{next_version}.txt")

    with open(output_file, "w", encoding="utf-8") as out_f:
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

        for folder in FOLDERS:
            folder_path = os.path.join(BASE_DIR, folder)
            if not os.path.isdir(folder_path):
                continue
            out_f.write(f"===== FOLDER: {folder} =====\n\n")
            for root, dirs, files in os.walk(folder_path):
                for file in sorted(files):
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

    ctypes.windll.user32.MessageBoxW(0, f"Master file created:\n{os.path.basename(output_file)}", "Build Complete", 0x40)

if __name__ == "__main__":
    main()
