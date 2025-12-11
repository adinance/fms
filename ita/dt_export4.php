<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable with Search Before Export</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            background-color: #f5f7fb;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaecef;
        }
        
        /* Header controls styling */
        .dt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        
        .dt-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .dt-search {
            order: 1; /* Search comes first */
        }
        
        .dt-buttons {
            order: 2; /* Buttons come after search */
            display: flex;
            gap: 8px;
        }
        
        .dt-length {
            order: 3; /* Page length comes last */
        }
        
        /* Search input styling */
        .dataTables_filter input {
            padding: 8px 15px;
            font-size: 14px;
            border: 1px solid #d1d5db;
            border-radius: 50rem;
            width: 250px;
            background: white;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .dataTables_filter input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }
        
        /* Button styling */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 6px;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
        
        .btn-outline {
            background-color: transparent;
        }
        
        .btn-primary {
            color: #4a90e2;
            border-color: #4a90e2;
        }
        
        .btn-outline.btn-primary:hover {
            color: white;
            background-color: #4a90e2;
            border-color: #4a90e2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(74, 144, 226, 0.3);
        }
        
        /* Page length styling */
        .dataTables_length select {
            padding: 6px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            color: #333;
        }
        
        /* Table styling */
        table.dataTable {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border-radius: 8px;
            overflow: hidden;
        }
        
        table.dataTable thead th {
            border-bottom: 2px solid #e2e8f0;
            background-color: #4a90e2;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        
        table.dataTable tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eaecef;
        }
        
        table.dataTable tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        table.dataTable tbody tr:hover {
            background-color: #e9f0f7;
        }
        
        /* Footer styling */
        .dataTables_info {
            color: #6c757d;
            padding: 15px 0;
            font-size: 0.9rem;
        }
        
        .dataTables_paginate {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
        }
        
        .dataTables_paginate .paginate_button {
            padding: 0.4rem 0.8rem;
            margin-left: 0.25rem;
            margin-right: 0.25rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #4a5568;
            cursor: pointer;
            background: white;
            transition: all 0.2s;
        }
        
        .dataTables_paginate .paginate_button:hover {
            background-color: #4a90e2;
            color: white;
            border-color: #4a90e2;
        }
        
        .dataTables_paginate .paginate_button.current {
            background-color: #4a90e2;
            color: white;
            border-color: #4a90e2;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dt-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .dt-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .dt-search, .dt-buttons, .dt-length {
                width: 100%;
            }
            
            .dataTables_filter input {
                width: 100%;
            }
            
            .dt-buttons {
                justify-content: center;
            }
            
            .dataTables_paginate {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Data Table</h1>
        <table id="example" class="display" style="width:100%"></table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    
    <!-- PDFMake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            data: [
                { "name": "Airi Satou", "office": "Tokyo", "start_date": "2008-11-28", "salary": "$162,700" },
                { "name": "Angelica Ramos", "office": "London", "start_date": "2009-10-09", "salary": "$1,200,000" },
                { "name": "Ashton Cox", "office": "San Francisco", "start_date": "2009-01-12", "salary": "$86,000" },
                { "name": "Bradley Greer", "office": "London", "start_date": "2012-10-13", "salary": "$132,000" },
                { "name": "Brenden Wagner", "office": "San Francisco", "start_date": "2011-06-07", "salary": "$206,850" },
                { "name": "Brielle Williamson", "office": "New York", "start_date": "2012-12-02", "salary": "$372,000" },
                { "name": "Bruno Nash", "office": "London", "start_date": "2011-05-03", "salary": "$163,500" },
                { "name": "Caesar Vance", "office": "New York", "start_date": "2011-12-12", "salary": "$106,450" },
                { "name": "Cara Stevens", "office": "New York", "start_date": "2011-12-06", "salary": "$145,600" },
                { "name": "Cedric Kelly", "office": "Edinburgh", "start_date": "2012-03-29", "salary": "$433,060" }
            ],
            columns: [
                { data: 'name', title: 'Name' },
                { data: 'office', title: 'Office' },
                { data: 'start_date', title: 'Start date' },
                { data: 'salary', title: 'Salary' }
            ],
            dom: '<"dt-header"<"dt-controls"<"dt-search"f><"dt-buttons"B><"dt-length"l>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
            buttons: [
                { 
                    extend: 'copy', 
                    className: 'btn btn-outline btn-primary btn-sm', 
                    text: 'Copy' 
                },
                { 
                    extend: 'csv',  
                    className: 'btn btn-outline btn-primary btn-sm', 
                    text: 'CSV' 
                },
                { 
                    extend: 'pdf',  
                    className: 'btn btn-outline btn-primary btn-sm', 
                    text: 'PDF' 
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search employees..."
            },
            initComplete: function() {
                // Add custom class to the search input
                $('.dataTables_filter input').addClass('input input-sm input-bordered rounded-full');
            }
        });
    });
    </script>
</body>
</html>