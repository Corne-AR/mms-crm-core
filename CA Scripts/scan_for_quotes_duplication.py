import os

# Path to your migration folder
migration_path = r'C:\xampp\htdocs\mms-crm-core\database\migrations'

# Look for files mentioning 'create table quotes'
print("🔍 Checking for duplicate 'quotes' table definitions...\n")

for filename in os.listdir(migration_path):
    if filename.endswith('.php'):
        file_path = os.path.join(migration_path, filename)
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read().lower()
            if 'create table' in content and '`quotes`' in content:
                print(f"⚠️ Possible duplicate found in: {filename}")
