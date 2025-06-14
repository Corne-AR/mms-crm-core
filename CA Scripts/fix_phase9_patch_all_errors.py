import os
import re

print("\n🚀 PHASE 9 — PATCH ALL ERRORS")

base_dir = "app"

# === 1. REMOVE INVALID USE STATEMENTS ===
invalid_trait = r"use App\\Models\\Illuminate\\Database\\Eloquent\\Factories\\HasFactory;"

for root, _, files in os.walk(base_dir):
    for file in files:
        if file.endswith(".php"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()
            new_content = re.sub(invalid_trait + r"\s*", "", content)
            if new_content != content:
                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                print(f"✅ Removed invalid HasFactory use in: {file}")

# === 2. ADD RELATIONSHIP METHOD TO QUOTE.PHP ===
quote_path = os.path.join("app", "Models", "Quote.php")
if os.path.exists(quote_path):
    with open(quote_path, "r", encoding="utf-8") as f:
        content = f.read()
    if "function items(" not in content:
        match = re.search(r"class\s+Quote\s+extends\s+Model\s*{", content)
        if match:
            insert_at = match.end()
            relation_code = """

    public function items()
    {
        return \$this->hasMany(QuoteItem::class);
    }
"""
            content = content[:insert_at] + relation_code + content[insert_at:]
            with open(quote_path, "w", encoding="utf-8") as f:
                f.write(content)
            print("✅ Added items() relation to Quote.php")
    else:
        print("✔️  items() relation already in Quote.php")

# === 3. REMOVE SPAITE REFERENCES FROM PERMISSIONSCONTROLLER ===
perm_path = os.path.join("app", "Http", "Controllers", "PermissionsController.php")
if os.path.exists(perm_path):
    with open(perm_path, "r", encoding="utf-8") as f:
        content = f.read()
    if "Spatie" in content:
        content = re.sub(r"use\s+Spatie\\Permission\\Models\\Permission;\s*", "", content)
        content = re.sub(r"Permission::(orderBy|create)\(.*?\);", "// Removed Spatie code", content)
        with open(perm_path, "w", encoding="utf-8") as f:
            f.write(content)
        print("✅ Patched PermissionsController to remove Spatie references")
    else:
        print("✔️  No Spatie references in PermissionsController")

# === 4. FIX FILEUPLOAD SYNTAX ===
user_resource = os.path.join("app", "Filament", "Resources", "UserResource.php")
if os.path.exists(user_resource):
    with open(user_resource, "r", encoding="utf-8") as f:
        content = f.read()
    updated = re.sub(r"(imageResizeTargetWidth\()\s*300\s*(\))", r"\1'300'\2", content)
    if updated != content:
        with open(user_resource, "w", encoding="utf-8") as f:
            f.write(updated)
        print("✅ Patched imageResizeTargetWidth() call in UserResource.php")
    else:
        print("✔️  UserResource.php already correct")

print("\n🚀 PHASE 9 COMPLETE — Now rerun:\n    vendor\\bin\\phpstan analyse\n")
