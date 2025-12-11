<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Asset Tracker</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <style>
    body { background-color: #f8f9fa; }
    .fab {
      position: fixed; bottom: 30px; right: 30px;
      background-color: #0d6efd; color: white; border: none;
      border-radius: 50%; width: 60px; height: 60px; font-size: 30px;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2); cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .fab:hover { background-color: #0b5ed7; }
    .breadcrumb { margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Asset Tracker</li>
      </ol>
    </nav>

    <div class="card">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Asset List</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped">
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
          <tbody id="asset-table">
            <tr>
              <td>1</td>
              <td>Printer HP LaserJet</td>
              <td>Electronics</td>
              <td>Office 1</td>
              <td>Good</td>
              <td>2024-10-15</td>
              <td>
                <button class="btn btn-sm btn-warning btn-edit"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Projector Epson</td>
              <td>Electronics</td>
              <td>Meeting Room</td>
              <td>Fair</td>
              <td>2024-08-22</td>
              <td>
                <button class="btn btn-sm btn-warning btn-edit"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <button class="fab" data-bs-toggle="modal" data-bs-target="#addAssetModal">
    <i class="bi bi-plus"></i>
  </button>

  <!-- Modal Add / Edit -->
  <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addAssetForm">
          <div class="modal-header">
            <h5 class="modal-title" id="addAssetModalLabel">Add New Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" id="editingRowIndex" value="-1">
              <div class="mb-3">
                <label for="assetName" class="form-label">Asset Name</label>
                <input type="text" class="form-control" id="assetName" required>
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" required>
              </div>
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" required>
              </div>
              <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select id="condition" class="form-select" required>
                  <option value="">Select Condition</option>
                  <option value="Good">Good</option>
                  <option value="Fair">Fair</option>
                  <option value="Poor">Poor</option>
                </select>
              </div>

              <!-- date input (we use flatpickr to force YYYY-MM-DD display) -->
              <div class="mb-3">
                <label for="datePurchased" class="form-label">Date Purchased</label>
                <input type="text" class="form-control" id="datePurchased" placeholder="YYYY-MM-DD" required autocomplete="off">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="saveAssetBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap + Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    // Initialize flatpickr with forced format YYYY-MM-DD for both display and value
    flatpickr("#datePurchased", {
      dateFormat: "Y-m-d",      // value format and displayed format
      altInput: false,
      allowInput: false,
      // optionally set maxDate or minDate if needed
    });

    const addModalEl = document.getElementById('addAssetModal');
    const addModal = new bootstrap.Modal(addModalEl);

    // Helper: refresh row numbers
    function refreshRowNumbers() {
      const tbody = document.getElementById('asset-table');
      Array.from(tbody.rows).forEach((r, i) => { r.cells[0].textContent = i + 1; });
    }

    // Submit (Add / Save)
    document.getElementById('addAssetForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const assetName = document.getElementById('assetName').value.trim();
      const category = document.getElementById('category').value.trim();
      const location = document.getElementById('location').value.trim();
      const condition = document.getElementById('condition').value;
      const dateValue = document.getElementById('datePurchased').value; // flatpickr gives YYYY-MM-DD

      // ensure dateValue is in YYYY-MM-DD (flatpickr configured to that)
      const formattedDate = dateValue; // already Y-m-d

      const editingIndex = parseInt(document.getElementById('editingRowIndex').value, 10);

      const tbody = document.getElementById('asset-table');

      if (!assetName) return;

      if (editingIndex >= 0 && editingIndex < tbody.rows.length) {
        // Update existing row
        const row = tbody.rows[editingIndex];
        row.cells[1].textContent = assetName;
        row.cells[2].textContent = category;
        row.cells[3].textContent = location;
        row.cells[4].textContent = condition;
        row.cells[5].textContent = formattedDate;
      } else {
        // Insert new row
        const row = tbody.insertRow();
        const rowCount = tbody.rows.length;
        row.innerHTML = `
          <td>${rowCount}</td>
          <td>${escapeHtml(assetName)}</td>
          <td>${escapeHtml(category)}</td>
          <td>${escapeHtml(location)}</td>
          <td>${escapeHtml(condition)}</td>
          <td>${escapeHtml(formattedDate)}</td>
          <td>
            <button class="btn btn-sm btn-warning btn-edit"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-sm btn-danger btn-delete"><i class="bi bi-trash"></i></button>
          </td>
        `;
      }

      document.getElementById('addAssetForm').reset();
      document.getElementById('editingRowIndex').value = -1;
      addModal.hide();
      refreshRowNumbers();
    });

    // Delegate click events for Edit and Delete buttons
    document.getElementById('asset-table').addEventListener('click', function(e) {
      const btn = e.target.closest('button');
      if (!btn) return;

      const row = btn.closest('tr');
      const tbody = document.getElementById('asset-table');
      const rowIndex = Array.from(tbody.rows).indexOf(row);

      if (btn.classList.contains('btn-edit')) {
        // populate form and open modal for editing
        document.getElementById('editingRowIndex').value = rowIndex;
        document.getElementById('assetName').value = row.cells[1].textContent;
        document.getElementById('category').value = row.cells[2].textContent;
        document.getElementById('location').value = row.cells[3].textContent;
        document.getElementById('condition').value = row.cells[4].textContent;
        // set flatpickr value (YYYY-MM-DD)
        const dateStr = row.cells[5].textContent.trim();
        // set value via flatpickr API to ensure consistent formatting
        flatpickr("#datePurchased").setDate(dateStr, true, "Y-m-d");

        addModal.show();
      }

      if (btn.classList.contains('btn-delete')) {
        if (confirm('Delete this asset?')) {
          row.remove();
          refreshRowNumbers();
        }
      }
    });

    // When opening modal via FAB, ensure it's in "add" state
    document.querySelector('.fab').addEventListener('click', function() {
      document.getElementById('addAssetForm').reset();
      document.getElementById('editingRowIndex').value = -1;
      // clear flatpickr
      flatpickr("#datePurchased").clear();
      addModal.show();
    });

    // Basic HTML escape to avoid simple injection when inserting rows
    function escapeHtml(text) {
      return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }
  </script>
</body>
</html>
