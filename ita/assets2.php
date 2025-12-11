<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>IT Assets Manangement</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="output.css" rel="stylesheet" />

		<!-- Template -->
		<script	type="module" src="https://cdn.jsdelivr.net/npm/@weblogin/trendchart-elements@1.1.0/dist/index.js/+esm"	async></script>
		<script	src="https://cdn.jsdelivr.net/npm/external-svg-loader@1.6.10/svg-loader.min.js"	async></script>
		<script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

		<!-- Tailwind + DaisyUI -->
		<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
		<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

		<!-- jQuery + DataTables -->
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css"> -->
		<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" integrity="sha384-pmGS6IIcXhAVIhcnh9X/mxffzZNHbuxboycGuQQoP3pAbb0SwlSUUHn2v22bOenI" crossorigin="anonymous">
		<!-- <link href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.css" rel="stylesheet" integrity="sha384-pmGS6IIcXhAVIhcnh9X/mxffzZNHbuxboycGuQQoP3pAbb0SwlSUUHn2v22bOenI" crossorigin="anonymous"> -->
		<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js" integrity="sha384-X2pTSfom8FUa+vGQ+DgTCSyBZYkC1RliOduHa0X96D060s7Q//fnOh3LcazRNHyo" crossorigin="anonymous"></script>
		<!-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script> -->
		
		


		<!-- Buttons CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


		<!-- Buttons JS -->
		<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

		<!-- Dependencies -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
		


		<!-- Font -->
		<style id="theme_style_custom_css">
			/* @import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css'; */
			/* @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap'); */
			
			@import 'assets/fonts/LINESeedSansTH.css';
			@import url('assets/fonts/Quicksand.css');

			html, body{
				font-family: "Quicksand", "LINE Seed Sans TH", sans-serif;
				/* font-size:19px !important; */
				font-weight:200;
			}
		

		</style>


		 <style>
   
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* h1 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaecef;
        }
         */
        /* Header controls styling */
        .dt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
            /* background: #f8f9fa; */
            /* padding: 15px; */
            /* border-radius: 8px; */
        }
        
        .dt-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .dt-left {
            display: flex;
            align-items: center;
        }
        
        .dt-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .dt-length {
            order: 1; /* Show entries on left */
        }
        
        .dt-search {
            order: 2; /* Search in right group */
        }
        
        .dt-buttons {
            order: 3; /* Buttons in right group */
            display: flex;
            gap: 8px;
        }
        
        /* Search input styling */
        /* .dataTables_filter input {
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
        } */
        
        /* Button styling */
        /* .btn {
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
        
        .w-32 {
            width: 8rem; 
        }
        
        .rounded-full {
            border-radius: 50rem;
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
         */
        /* Page length styling */
        .dataTables_length {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .dataTables_length label {
            margin: 0;
            font-weight: 500;
            color: #4a5568;
        }
        
        .dataTables_length select {
            padding: 6px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            color: #333;
        }
        
        /* Table styling */
        /* table.dataTable {
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
        } */
        
          /* Footer styling - aligned entries and pagination */
        .dataTables_wrapper .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 10px 0;
        }
        
        .dataTables_info {
			padding-top: 25px;
				padding-bottom: 25px;
            color: #6c757d;
            font-size: 0.9rem;
            order: 1;
        }
        
        .dataTables_paginate {
            order: 2;
            display: flex;
            margin-top: 0;
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
            
            .dt-left, .dt-right {
                width: 100%;
                justify-content: space-between;
            }
            
            .dataTables_filter input {
                width: 100%;
            }
            
            .dt-buttons {
                justify-content: center;
                width: 100%;
            }
            
            .dataTables_paginate {
                justify-content: center;
            }

			.footer {
                flex-direction: column;
                gap: 10px;
				padding-top: 25px;
				padding-bottom: 25px;
            }
            
            .dataTables_length {
                justify-content: space-between;
            }
        }
    </style>



	</head>
	<!-- drawer -->
	<body class="drawer bg-base-200 lg:drawer-open min-h-screen">
		<input id="my-drawer" type="checkbox" class="drawer-toggle" />
		<main class="drawer-content">
			<div class="grid grid-cols-12 grid-rows-[min-content] gap-y-12 p-4 lg:gap-x-12 lg:p-10">
				<header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<label for="my-drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
						<svg data-src="https://unpkg.com/heroicons/20/solid/bars-3.svg" class="h-5 w-5"></svg>
					</label>
					<div class="grow">
						<h1 class="lg:text-2xl lg:font-light">Assets</h1>
					</div>
					<div>

					<button class="btn w-32 rounded-full">Button</button>
						<!-- <select class="select">
  <option disabled selected>Pick a color</option>
  <option>Crimson</option>
  <option>Amber</option>
  <option>Velvet</option>
</select> -->
						<!-- <input type="text"	placeholder="Search" class="input input-sm rounded-full max-sm:w-24" /> -->
					</div>
					<button class="swap swap-rotate" data-toggle-theme="dark" data-act-class="swap-active">
						<svg class="swap-off h-6 w-6 fill-current"	xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
						</svg>
						<svg class="swap-on h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
						</svg>
					</button>

				</header>


				<div class="fixed bottom-4 right-4 z-50">
				<div class="fab fab-flower">
					<div tabindex="0" role="button" class=" fab-main-action btn btn-circle btn-lg btn-primary">
						<svg aria-label="New" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
							class="size-6">
							<path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
						</svg>

					</div>

					<button class="fab-main-action btn btn-circle btn-lg ">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
							<path d="M6 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6ZM15.75 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3H18a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-2.25ZM6 12.75a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3v-2.25a3 3 0 0 0-3-3H6ZM17.625 13.5a.75.75 0 0 0-1.5 0v2.625H13.5a.75.75 0 0 0 0 1.5h2.625v2.625a.75.75 0 0 0 1.5 0v-2.625h2.625a.75.75 0 0 0 0-1.5h-2.625V13.5Z" />
						</svg>
					</button>

					<button class="btn btn-circle btn-lg btn-primary">

						<svg aria-label="New" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
							class="size-6">
							<path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
						</svg>

					</button>

					<button class="btn btn-circle btn-lg btn-warning">

						<svg aria-label="New post" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
							class="size-6">
							<path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z"
								clip-rule="evenodd" />
						</svg>
					</button>

					<button class="btn btn-circle btn-lg btn-error">

						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
							<path fill-rule="evenodd"
								d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
								clip-rule="evenodd" />
						</svg>

					</button>

				</div>
			</div>


						<!-- <button class="btn btn-primary rounded-full px-16">Create</button> -->

				<section class="card bg-base-100 col-span-12 overflow-hidden shadow-xs xl:col-span-12">
					<div class="card-body grow-0">
						<h2 class="card-title">
							<a class="link-hover link">All</a>
						</h2>
					</div>
						<div class="overflow-x-auto" style="padding-left: 25px; padding-right:25px; width:100%">

						<table id="example" class="table-zebra table display" style="width:100%"></table>
					</div>

				</section>


			</div>
		</main>

	<?php require 'aside.php'; ?>

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
				{ "name": "Angelica Ramos", "office": "London", "start_date": "2009-10-09", "salary": "$1,200,000" },
                { "name": "Ashton Cox", "office": "San Francisco", "start_date": "2009-01-12", "salary": "$86,000" },
                { "name": "Bradley Greer", "office": "London", "start_date": "2012-10-13", "salary": "$132,000" },
                { "name": "Brenden Wagner", "office": "San Francisco", "start_date": "2011-06-07", "salary": "$206,850" },
                { "name": "Brielle Williamson", "office": "New York", "start_date": "2012-12-02", "salary": "$372,000" },
                { "name": "Bruno Nash", "office": "London", "start_date": "2011-05-03", "salary": "$163,500" },
                { "name": "Caesar Vance", "office": "New York", "start_date": "2011-12-12", "salary": "$106,450" },
                { "name": "Cara Stevens", "office": "New York", "start_date": "2011-12-06", "salary": "$145,600" },
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
			  dom: '<"dt-header"<"dt-controls"<"dt-left"l><"dt-right"<"dt-search"f><"dt-buttons"B>>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
            // dom: '<"dt-header"<"dt-controls"<"dt-length"l><"dt-search"f><"dt-buttons"B>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
//    dom: '<"dt-header"<"dt-controls"<"dt-left"l><"dt-right"<"dt-search"f><"dt-buttons"B>>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
            // dom: '<"dt-header"<"dt-controls"<"dt-search"f><"dt-buttons"B><"dt-length"l>>>rt<"footer"<"dataTables_info"i><"dataTables_paginate"p>>',
            buttons: [
                // { 
                //     extend: 'copy', 
                //     className: 'btn-outline', 
                //     text: 'Copy' 
                // },
                { 
                    extend: 'csv',  
                    className: '', 
                    text: 'Export' 
                }
				// ,
                // { 
                //     extend: 'pdf',  
                //     className: 'btn-info', 
                //     text: 'PDF' 
                // }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍"
                // lengthMenu: "Show _MENU_ entries"

            },
            
            initComplete: function() {

                
                // Update the length menu text
                $('.dataTables_length label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
                
                $('.dataTables_length label').prepend('Show ');
                $('.dataTables_length label').append(' entries');
                // Add custom class to the search input
                // $('.dataTables_filter input').addClass('input input-sm input-bordered rounded-full');
				$('.dt-button.buttons-csv.buttons-html5').removeClass('dt-button buttons-csv buttons-html5').addClass('btn btn-sm w-18 rounded-full ');
				// $('.dt-button.buttons-pdf.buttons-html5').removeClass('dt-button buttons-pdf buttons-html5').addClass('btn btn-sm w-18 rounded-full');
				// $('.dt-button.buttons-copy.buttons-html5').removeClass('dt-button buttons-copy buttons-html5').addClass('btn btn-sm w-18 rounded-full');

				$('.dt-paging-button').removeClass('dt-paging-button').addClass('btn btn-sm w-10 rounded-full ');
				$('.footer').css('display', 'flex').css('justify-content', 'space-between').css('align-items', 'center');
				
            }
        });

		$('div.dt-search').removeClass('dt-search');
	
	  	$('#dt-search-0').attr('class', 'input input-sm rounded-full max-sm:w-24');

	  $('label[for="dt-length-0"]').remove();

	  	$('#dt-length-0').attr('class', 'select input-sm rounded-full max-sm:w-24 px-10 py-2');
    });
    </script>

  <style>

	thead th {
    text-align: center !important;
	 text-transform: uppercase;
}
	tfoot input {
        width: 100%;
        padding: 1rem;
        box-sizing: border-box;

    }


	</style>

    <!-- <style>
    .dataTables_filter input {
      @apply input input-bordered input-sm;
    }
    .dataTables_length select {
      @apply select select-bordered select-sm;
    }
    .dataTables_paginate a {
      @apply btn btn-xs mx-1;
    }
  </style> -->
	</body>
</html>
