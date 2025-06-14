import os
import re

# 1️⃣ CONFIG — paths
MODELS_PATH = 'app/Models'
CONTROLLERS_PATH = 'app/Http/Controllers'
SEEDERS_PATH = 'database/seeders'

# 2️⃣ Scan Models folder
models = []
for filename in os.listdir(MODELS_PATH):
    if filename.endswith('.php'):
        model_name = filename.replace('.php', '')
        models.append(model_name)

print(f"\n✅ Models found ({len(models)}): {models}\n")

# 3️⃣ Function to scan PHP files for App\Models\Xxx references
def scan_file_for_model_usage(file_path):
    used_models = set()
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
        # Matches App\Models\Xxx or \App\Models\Xxx
        matches = re.findall(r'(?:\\?App\\Models\\)(\w+)', content)
        for match in matches:
            used_models.add(match)
    return used_models

# 4️⃣ Function to scan for use statements
def scan_file_for_use_statements(file_path):
    uses = set()
    with open(file_path, 'r', encoding='utf-8') as f:
        for line in f:
            match = re.match(r'use\s+App\\Models\\(\w+);', line.strip())
            if match:
                uses.add(match.group(1))
    return uses

# 5️⃣ Check folder (controllers or seeders)
def check_folder(folder):
    print(f"\n=== Checking folder: {folder} ===")
    for root, dirs, files in os.walk(folder):
        for file in files:
            if file.endswith('.php'):
                file_path = os.path.join(root, file)
                used_models = scan_file_for_model_usage(file_path)
                use_statements = scan_file_for_use_statements(file_path)

                if used_models:
                    print(f"\n🔍 File: {file_path}")
                    for model in used_models:
                        model_exists = model in models
                        has_use = model in use_statements

                        status = []
                        if model_exists:
                            status.append("✔️ Model exists")
                        else:
                            status.append("❌ Model missing")

                        if has_use:
                            status.append("✔️ Correct use statement")
                        else:
                            status.append("❌ Missing use statement")

                        print(f"  - Model used: {model} → {' | '.join(status)}")

# 6️⃣ Run checks
check_folder(CONTROLLERS_PATH)
check_folder(SEEDERS_PATH)

print("\n✅ PHASE 1 CHECK COMPLETE 🚀\n")
