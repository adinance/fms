<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Asset Tracker</title>

  <!-- Tailwind + DaisyUI -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">

  <!-- Flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .fab {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      border-radius: 9999px;
      font-size: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #2563eb;
      color: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      cursor: pointer;
      transition: background-color 0.3s ease;
      z-index: 50;
    }
    .fab:hover { background-color: #1e40af; }
  </style>
</head>
<body class="bg-base-200 min-h-screen">

  <div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Asset List</h2>
    <div class="overflow-x-auto bg-base-100 shadow rounded-lg">
      <table class="table table-zebra w-full" id="asset-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Asset Name</th>
            <th>Category</th>
            <th>Location</th>
            <th>Condition</th>
            <th>Date Purchased</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Printer HP LaserJet</td>
            <td>Electronics</td>
            <td>Office 1</td>
            <td>Good</td>
            <td>2024-10-15</td>
            <td>
              <button class="btn btn-warning btn-xs btn-edit"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-error btn-xs btn-delete"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Floating Add Button -->
  <button class="fab" onclick="openAddModal()">+</button>

  <!-- Modal (แบบ checkbox) -->
  <input type="checkbox" id="asset_modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-md">
      <h3 class="font-bold text-lg mb-3" id="modalTitle">Add New Asset</h3>
      <form id="addAssetForm" class="space-y-3">
        <input type="hidden" id="editingRowIndex" value="-1">

        <div>
          <label class="label"><span class="label-text">Asset Name</span></label>
          <input type="text" id="assetName" class="input input-bordered w-full" required>
        </div>

        <div>
          <label class="label"><span class="label-text">Category</span></label>
          <input type="text" id="category" class="input input-bordered w-full" required>
        </div>

        <div>
          <label class="label"><span class="label-text">Location</span></label>
          <input type="text" id="location" class="input input-bordered w-full" required>
        </div>

        <div>
          <label class="label"><span class="label-text">Condition</span></label>
          <select id="condition" class="select select-bordered w-full" required>
            <option value="">Select Condition</option>
            <option>Good</option>
            <option>Fair</option>
            <option>Poor</option>
          </select>
        </div>

        <div>
          <label class="label"><span class="label-text">Date Purchased</span></label>
          <input type="text" id="datePurchased" class="input input-bordered w-full" placeholder="YYYY-MM-DD" required autocomplete="off">
        </div>

        <div class="modal-action">
          <label for="asset_modal" class="btn">Cancel</label>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modalCheckbox = document.getElementById('asset_modal');
    const datePicker = flatpickr("#datePurchased", { dateFormat: "Y-m-d" });

    const assetNameEl = document.getElementById('assetName');
    const categoryEl = document.getElementById('category');
    const locationEl = document.getElementById('location');
    const conditionEl = document.getElementById('condition');
    const editingRowIndex = document.getElementById('editingRowIndex');

    function openAddModal() {
      document.getElementById('modalTitle').textContent = 'Add New Asset';
      document.getElementById('addAssetForm').reset();
      editingRowIndex.value = -1;
      datePicker.clear();
      modalCheckbox.checked = true;
    }

    function refreshRowNumbers() {
      const tbody = document.getElementById('asset-table').querySelector('tbody');
      Array.from(tbody.rows).forEach((r, i) => r.cells[0].textContent = i + 1);
    }

    document.getElementById('addAssetForm').addEventListener('submit', e => {
      e.preventDefault();
      const tbody = document.getElementById('asset-table').querySelector('tbody');
      const assetName = assetNameEl.value.trim();
      const category = categoryEl.value.trim();
      const location = locationEl.value.trim();
      const condition = conditionEl.value;
      const dateValue = datePicker.input.value;
      const idx = parseInt(editingRowIndex.value, 10);

      if (idx >= 0 && idx < tbody.rows.length) {
        const row = tbody.rows[idx];
        row.cells[1].textContent = assetName;
        row.cells[2].textContent = category;
        row.cells[3].textContent = location;
        row.cells[4].textContent = condition;
        row.cells[5].textContent = dateValue;
      } else {
        const row = tbody.insertRow();
        const c = tbody.rows.length;
        row.innerHTML = `
          <td>${c}</td>
          <td>${assetName}</td>
          <td>${category}</td>
          <td>${location}</td>
          <td>${condition}</td>
          <td>${dateValue}</td>
          <td>
            <button class="btn btn-warning btn-xs btn-edit"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-error btn-xs btn-delete"><i class="bi bi-trash"></i></button>
          </td>`;
      }
      e.target.reset();
      datePicker.clear();
      modalCheckbox.checked = false;
      refreshRowNumbers();
    });

    document.getElementById('asset-table').addEventListener('click', e => {
      const btn = e.target.closest('button');
      if (!btn) return;
      const row = btn.closest('tr');
      const tbody = row.parentNode;
      const rowIndex = Array.from(tbody.rows).indexOf(row);

      if (btn.classList.contains('btn-edit')) {
        document.getElementById('modalTitle').textContent = 'Edit Asset';
        editingRowIndex.value = rowIndex;
        assetNameEl.value = row.cells[1].textContent;
        categoryEl.value = row.cells[2].textContent;
        locationEl.value = row.cells[3].textContent;
        conditionEl.value = row.cells[4].textContent;
        datePicker.setDate(row.cells[5].textContent, true, "Y-m-d");
        modalCheckbox.checked = true;
      }

      if (btn.classList.contains('btn-delete')) {
        if (confirm('Delete this asset?')) {
          row.remove();
          refreshRowNumbers();
        }
      }
    });
  </script>
</body>
</html>
