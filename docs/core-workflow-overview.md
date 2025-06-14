# ✅ MMS Design CRM – Core Workflow Overview (Refined)

---

## 👥 User Roles

| Role         | Access Scope                              |
|--------------|--------------------------------------------|
| **Admin**     | Full access (all data, settings, users)    |
| **Key Dealer**| Own customers + sub-dealers                |
| **Sub-Dealer**| Own customers only                         |
| **Internal**  | Quote generation only                      |

---

## 🧭 Main Navigation Structure

1. **Dashboard**
2. **Customers**
3. **Dealers**
4. **Products / Kits**
5. **Quotes**
6. **Invoices**
7. **Purchase Orders**
8. **Stock**
9. **Users & Roles** *(Admin only)*
10. **Settings** *(Admin only)*

---

## 🏗️ Module Workflows

### 🏠 1. Dashboard
- Summary cards: quotes, invoices, stock alerts
- Charts: quotes by month, invoice statuses
- Activity feed/reminders
- Sidebar: icons (64x64px), user info at bottom

### 👥 2. Customers
- Table view with filter/search (restricted by dealer)
- Add/Edit form
- Customer details:
  - Fields: account_nr, company, billing/delivery addresses, VAT, vendor_nr, currency, tags, notes, maintenance date, blocked, active, local, language, dealer_id, category
  - Multiple contact persons per customer
- Contact Person:
  - Fields: name, surname, phone, email, full name, language, role (user, owner, admin, accountant)

### 🧑‍💼 3. Dealers & Suppliers
- Dealer list view (hierarchy + filters)
- Dealer profile:
  - Contact info, bank details, logo
  - Sub-dealer and customer assignments
- **Suppliers** *(Admin only)*:
  - Table view + filters
  - Add/Edit/View supplier

### 📦 4. Products & Kits
- Products table with filters (group, category, type, supplier)
- Fields: partnr, name, price (supplier & calculated), unit, discount, stolen, maintenance, bulk, script_id, notes, description
- Edit product inline or via form
- Stock quantity display
- **Kit Builder**:
  - Assemble products via checkbox
  - Save to `kits` table (id, name, items[], auto-calc total)

### 📑 5. Quotes
- List with filters (status, customer, date, tags)
- **Quote Builder**:
  - Select customer
  - Add items/kits with filters (supplier, group, type)
  - Edit or remove line items
  - Real-time totals & price re-calc
  - Lock when emailed
  - Use existing quote as template
  - Export to PDF + email

### 💵 6. Invoices
- List with filters (paid, unpaid, overdue)
- Generate from approved quote
- Export to PDF + email

### 📄 7. Purchase Orders
- List with filters (ordered, paid, unpaid)
- Generate from approved invoice
  - Group by supplier automatically
  - Use supplier prices from products
- Allow edit + auto-calc totals
- Export to PDF + email after approval

### 🏷️ 8. Stock
- Stock levels by product
- Alerts for low inventory
- Manual adjustments (future phase)

### 👤 9. Users & Roles (Admin Only)
- User list + role assignment
- Role-permission matrix

### ⚙️ 10. Settings (Admin Only)
- VAT % settings (multiple supported)
- Email templates
- Document builders (quote/invoice/PO)
- System preferences
- Script builder for dynamic pricing
- Customer category manager

---

## 🧩 UI Layout Types

| Page Type   | Layout Style                        |
|-------------|--------------------------------------|
| Dashboard   | Card grid + charts                  |
| Tables      | Filter/sort/search + row actions    |
| Details     | Tabbed panels or cards              |
| Forms       | Two-column responsive               |
| Modals      | Quick create/edit popups            |
| Side Panel  | Icons-only or icons + text          |