<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>DataTable Export Layout Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</head>
<body class="p-4">

  <table id="example" class="table table-striped table-bordered w-100"></table>

  <script>
  $(document).ready(function() {
    $('#example').DataTable({
      data: [
        { name: "Airi Satou", office: "Tokyo", start_date: "2008-11-28", salary: 162700 },
        { name: "Angelica Ramos", office: "London", start_date: "2009-10-09", salary: 1200000 },
        { name: "Ashton Cox", office: "San Francisco", start_date: "2009-01-12", salary: 86000 },
        { name: "Bradley Greer", office: "London", start_date: "2012-10-13", salary: 132000 },
        { name: "Brenden Wagner", office: "San Francisco", start_date: "2011-06-07", salary: 206850 },
        { name: "Brielle Williamson", office: "New York", start_date: "2012-12-02", salary: 372000 },
        { name: "Bruno Nash", office: "London", start_date: "2011-05-03", salary: 163500 },
        { name: "Caesar Vance", office: "New York", start_date: "2011-12-12", salary: 106450 },
        { name: "Cara Stevens", office: "New York", start_date: "2011-12-06", salary: 145600 },
        { name: "Cedric Kelly", office: "Edinburgh", start_date: "2012-03-29", salary: 433060 }
      ],
      columns: [
        { data: 'name', title: 'Name' },
        { data: 'office', title: 'Office' },
        { data: 'start_date', title: 'Start date' },
        { data: 'salary', title: 'Salary' }
      ],
      layout: {
        top1Start: {
          buttons: [
            { text: 'top1Start A', className: 'btn btn-outline-danger btn-sm' },
            { text: 'top1Start B', className: 'btn btn-outline-danger btn-sm' },
            { text: 'top1Start C', className: 'btn btn-outline-danger btn-sm' }
          ]
        },
        topEnd: {
          buttons: [
            { extend: 'copy', className: 'btn btn-outline-primary btn-sm', text: 'top A' },
            { extend: 'csv', className: 'btn btn-outline-primary btn-sm', text: 'top B' },
            { extend: 'pdf', className: 'btn btn-outline-primary btn-sm', text: 'top C' }
          ]
        },
        top2Start: ['pageLength'],
        top2End: ['search'],
        bottomStart: ['info'],
        bottomEnd: ['paging']
      }
    });
  });
  </script>

</body>
</html>
