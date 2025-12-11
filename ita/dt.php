<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>DataTable + DaisyUI Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Tailwind + DaisyUI -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" />

  <!-- jQuery + DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
</head>
<body class="bg-base-200">
  <div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">DataTable + DaisyUI</h2>

    <div class="overflow-x-auto">
      <table id="example" class="table table-zebra w-full">
        <thead class="bg-base-300 text-base-content">
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Tiger Nixon</td><td>61</td><td>320800</td></tr>
          <tr><td>Garrett Winters</td><td>63</td><td>170750</td></tr>
          <tr><td>Ashton Cox</td><td>66</td><td>86000</td></tr>
          <tr><td>Jennifer Acosta</td><td>43</td><td>75650</td></tr>
          <tr><td>Brenden Wagner</td><td>28</td><td>206850</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#example').DataTable({
        order: [[1, "asc"]],
        language: {
          search: "_INPUT_",
          searchPlaceholder: "🔍 "
        }
      });

      
    });
  </script>

  <!-- เพิ่ม CSS เสริมให้ DataTables กลมกลืนกับ DaisyUI -->
  <style>
    .dataTables_filter input {
      @apply input input-bordered input-sm;
    }
    .dataTables_length select {
      @apply select select-bordered select-sm;
    }
    .dataTables_paginate a {
      @apply btn btn-xs mx-1;
    }
  </style>
</body>
</html>
