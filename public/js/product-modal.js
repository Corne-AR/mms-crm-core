document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productPickerModal');
    const productList = document.getElementById('productList');
    const searchInput = document.getElementById('productSearchInput');

    if (!modal || !productList || !searchInput) return;

    // Fetch products from backend
    fetch('/products/json')
        .then(response => response.json())
        .then(data => {
            window.fullProductData = data;
            renderProductList(data);
        });

    // Filter on search
    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        const filtered = {};

        for (const [category, products] of Object.entries(window.fullProductData || {})) {
            const matches = products.filter(p => {
                return (
                    p.name.toLowerCase().includes(term) ||
                    p.description.toLowerCase().includes(term)
                );
            });
            if (matches.length) filtered[category] = matches;
        }

        renderProductList(filtered);
    });

    function renderProductList(data) {
        productList.innerHTML = '';

        for (const [category, products] of Object.entries(data)) {
            const col = document.createElement('div');
            col.classList.add('col-12', 'mb-3');

            const title = document.createElement('h6');
            title.className = 'text-muted border-bottom pb-1 mb-2';
            title.textContent = category;
            col.appendChild(title);

            const row = document.createElement('div');
            row.className = 'row g-2';

            products.forEach(product => {
                const item = document.createElement('div');
                item.className = 'col-md-4';
                item.innerHTML = `
                    <div class="card h-100 shadow-sm border-success">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="card-title">${product.name}</h6>
                                <p class="card-text small">${product.description || ''}</p>
                            </div>
                            <button class="btn btn-sm btn-success mt-2" onclick="addProductToQuote(${product.id}, '${product.name.replace(/'/g, "\'")}', ${product.price || 0})">Add</button>
                        </div>
                    </div>
                `;
                row.appendChild(item);
            });

            col.appendChild(row);
            productList.appendChild(col);
        }
    }
});

function addProductToQuote(id, name, price) {
    const table = document.getElementById('quoteItemsTable');
    if (!table) return;

    const tbody = table.querySelector('tbody');
    const row = document.createElement('tr');
    const rowCount = tbody.children.length;

    row.innerHTML = `
        <td>
            <input type="hidden" name="items[${rowCount}][product_id]" value="${id}">
            <input type="text" class="form-control" name="items[${rowCount}][name]" value="${name}" readonly>
        </td>
        <td><input type="number" class="form-control" name="items[${rowCount}][quantity]" value="1" min="1" onchange="updateLineTotal(this)"></td>
        <td><input type="number" class="form-control" name="items[${rowCount}][unit_price]" value="${price.toFixed(2)}" step="0.01" onchange="updateLineTotal(this)"></td>
        <td><input type="number" class="form-control" name="items[${rowCount}][discount]" value="0" step="0.01" onchange="updateLineTotal(this)"></td>
        <td><input type="number" class="form-control" name="items[${rowCount}][vat]" value="0" step="0.01" onchange="updateLineTotal(this)"></td>
        <td><input type="number" class="form-control" name="items[${rowCount}][line_total]" value="${price.toFixed(2)}" step="0.01" readonly></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove();">×</button></td>
    `;

    tbody.appendChild(row);
    const modal = bootstrap.Modal.getInstance(document.getElementById('productPickerModal'));
    if (modal) modal.hide();
}

function updateLineTotal(input) {
    const row = input.closest('tr');
    const qty = parseFloat(row.querySelector('[name*="[quantity]"]').value) || 0;
    const price = parseFloat(row.querySelector('[name*="[unit_price]"]').value) || 0;
    const discount = parseFloat(row.querySelector('[name*="[discount]"]').value) || 0;
    const vat = parseFloat(row.querySelector('[name*="[vat]"]').value) || 0;

    const subtotal = qty * price - discount;
    const total = subtotal + vat;

    row.querySelector('[name*="[line_total]"]').value = total.toFixed(2);
}

