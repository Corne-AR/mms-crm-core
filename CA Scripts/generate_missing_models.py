import os

# List of missing models from Phase 1
missing_models = [
    "Dealer",
    "Invoice",
    "QuoteItem",
    "UserRole",
    "InvoiceItem",
    "SubDealerRegion"
]

# Base folder for models
models_folder = os.path.join("app", "Models")

# Ensure Models folder exists
if not os.path.exists(models_folder):
    os.makedirs(models_folder)
    print(f"✅ Created folder: {models_folder}")

# Model template — FIXED with escaped curly braces
model_template = '''<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {model_name} extends Model
{{
    use HasFactory;

    // TODO: Define table name if different, fill in relationships and fields
}}
'''

# Process each missing model
for model in missing_models:
    model_file = os.path.join(models_folder, f"{model}.php")
    if os.path.exists(model_file):
        print(f"⚠️  Model already exists: {model_file} — skipping.")
    else:
        with open(model_file, "w", encoding="utf-8") as f:
            f.write(model_template.format(model_name=model))
        print(f"✅ Created model: {model_file}")

print("\n🚀 PHASE 2 COMPLETE! Now run:")
print("    composer dump-autoload -o")
print("    vendor\\bin\\phpstan analyse")
