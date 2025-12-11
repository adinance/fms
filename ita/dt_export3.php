<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable with Aligned Search</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    <style>
        /* Custom styling for alignment */
        .dataTables_wrapper {
            margin: 20px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .dt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .dt-buttons {
            display: flex;
            gap: 8px;
        }
        
        .dt-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .dataTables_filter {
            margin: 0 !important;
        }
        
        .dataTables_filter input {
            margin-left: 0 !important;
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 50rem;
            width: 200px;
        }
        
        .dataTables_length {
            margin: 0;
        }
        
        .dataTables_length select {
            padding: 4px 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        
        /* Button styling */
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, 
                        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.7875rem;
            border-radius: 0.2rem;
        }
        
        .btn-outline {
            background-color: transparent;
            background-image: none;
        }
        
        .btn-primary {
            color: #007bff;
            border-color: #007bff;
        }
        
        .btn-outline.btn-primary:hover {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        
        /* Table styling */
        table.dataTable {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        table.dataTable thead th {
            border-bottom: 2px solid #e2e8f0;
            background-color: #f8fafc;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        
        table.dataTable tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        table.dataTable tbody tr:hover {
            background-color: #f1f5f9;
        }
        
        /* Footer styling */
        .dataTables_info {
            color: #64748b;
            padding-top: 0.75rem;
        }
        
        .dataTables_paginate {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
        }
        
        .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.75rem;
            margin-left: 0.25rem;
            margin-right: 0.25rem;
            border: 1px solid #cbd5e0;
            border-radius: 0.25rem;
            color: #4a5568;
            cursor: pointer;
        }
        
        .dataTables_paginate .paginate_button:hover {
            background-color: #edf2f7;
            color: #2d3748;
        }
        
        .dataTables_paginate .paginate_button.current {
            background-color: #4299e1;
            color: white;
            border-color: #4299e1;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dt-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dt-controls {
                width: 100%;
                justify-content: space-between;
            }
            
            .dataTables_filter input {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Data</h1>
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
            dom: '<"dt-header"<"dt-controls"<"dt-buttons"B>l<"dataTables_filter"f>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
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
                searchPlaceholder: "Search records..."
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