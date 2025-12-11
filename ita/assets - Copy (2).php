<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>IT Assets Manangement</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="output.css" rel="stylesheet" />
		<script	type="module" src="https://cdn.jsdelivr.net/npm/@weblogin/trendchart-elements@1.1.0/dist/index.js/+esm"	async></script>
		<script	src="https://cdn.jsdelivr.net/npm/external-svg-loader@1.6.10/svg-loader.min.js"	async></script>
		<script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

		<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
		<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


		<link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" integrity="sha384-pmGS6IIcXhAVIhcnh9X/mxffzZNHbuxboycGuQQoP3pAbb0SwlSUUHn2v22bOenI" crossorigin="anonymous">
		<!-- <link href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.css" rel="stylesheet" integrity="sha384-pmGS6IIcXhAVIhcnh9X/mxffzZNHbuxboycGuQQoP3pAbb0SwlSUUHn2v22bOenI" crossorigin="anonymous"> -->

		<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js" integrity="sha384-X2pTSfom8FUa+vGQ+DgTCSyBZYkC1RliOduHa0X96D060s7Q//fnOh3LcazRNHyo" crossorigin="anonymous"></script>

		<style id="theme_style_custom_css">
			@import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css';
			@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap');

			html, body{
				font-family: "Quicksand", "LINE Seed Sans TH", sans-serif;
				/* font-size:19px !important; */
				font-weight:200;
			}

			/* จัด layout ของ DataTables wrapper */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dt-buttons {
  display: flex;
  align-items: center;
  margin: 0 0.5rem;
}

/* ทำให้ทุกอันอยู่แถวเดียวกัน */
.dataTables_wrapper .top {
  display: flex;
  justify-content: space-between; /* เว้นซ้ายขวา */
  flex-wrap: wrap; /* ถ้าหน้าจอเล็กจะลงบรรทัดใหม่ */
  gap: 0.5rem;
}

		</style>

		<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->

<!-- DataTables CSS -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css"> -->

<!-- Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

<!-- DataTables JS -->
<!-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script> -->

<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>



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
							<path
								d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
						</svg>

					</div>

					<button class="fab-main-action btn btn-circle btn-lg ">

						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
							<path
								d="M6 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6ZM15.75 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3H18a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-2.25ZM6 12.75a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3v-2.25a3 3 0 0 0-3-3H6ZM17.625 13.5a.75.75 0 0 0-1.5 0v2.625H13.5a.75.75 0 0 0 0 1.5h2.625v2.625a.75.75 0 0 0 1.5 0v-2.625h2.625a.75.75 0 0 0 0-1.5h-2.625V13.5Z" />
						</svg>

					</button>

					<button class="btn btn-circle btn-lg btn-primary">

						<svg aria-label="New" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
							class="size-6">
							<path
								d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
						</svg>

					</button>

					<button class="btn btn-circle btn-lg btn-warning">

						<svg aria-label="New post" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
							class="size-6">
							<path fill-rule="evenodd"
								d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z"
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

						<table id="example" class="table-zebra table display" >
							<thead >
								<tr>
									<th>Name</th>
									<th>Age</th>
									<th>Salary</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>61</td>
									<td>320800</td>
								</tr>
								<tr>
									<td>Garrett Winters</td>
									<td>63</td>
									<td>170750</td>
								</tr>
								<tr>
									<td>Ashton Cox</td>
									<td>66</td>
									<td>86000</td>
								</tr>
								<tr>
									<td>Jennifer Acosta</td>
									<td>43</td>
									<td>75650</td>
								</tr>
								<?php for ($i = 0; $i < 100; $i++) {?>
								<tr>
									<td>Brenden Wagner</td>
									<td>28</td>
									<td>206850</td>
								</tr>
								<?php }?>
							</tbody>

							<tfoot>
<tr>
									<th>Name</th>
									<th>Age</th>
									<th>Salary</th>
								</tr>
</tfoot>
						</table>
					</div>

		</section>


			</div>
		</main>

	<?php require 'aside.php'; ?>


  <script>
    $(document).ready(function () {
      $('#example').DataTable({

	// 	ajax: 'https://jsonplaceholder.typicode.com/posts',
    // columns: [
    //   { data: 'userId' },
    //   { data: 'id' },
    //   { data: 'title' },
    //   { data: 'body' }
    // ],
// 	 data: [
//     { name: "Tiger Nixon", age: "System Architect", salary: "Edinburgh" },
//     { name: "Garrett Winters", age: "Accountant", salary: "Tokyo" }
//   ],
//   columns: [
//     { data: "name" },
//     { data: "age" },
//     { data: "salary" }
//   ],
//  dom: '<"dt-toolbar"lfB>rtip', 
//   dom: '<"top"lfB>rt<"bottom"ip>', 
  dom: '<"dt-header d-flex justify-between items-center gap-2"l f B>rt<"bottom"ip>',
//    dom: 'Blfrtip', // B = Buttons, l = length menu, f = filter (search), r = processing, t = table, i = info, p = pagination
    buttons: [
        {
            extend: 'copy',
            className: 'btn btn-sm btn-primary rounded-full m-1'
        },
        {
            extend: 'csv',
            className: 'btn btn-sm btn-secondary rounded-full m-1'
        },
        {
            extend: 'excel',
            className: 'btn btn-sm btn-accent rounded-full m-1'
        },
        {
            extend: 'pdf',
            className: 'btn btn-sm btn-info rounded-full m-1'
        },
        {
            extend: 'print',
            className: 'btn btn-sm btn-success rounded-full m-1'
        }
    ],
		 pageLength: 50,   // จำนวนแถวเริ่มต้น
         lengthMenu: [10, 50, 100, -1], // dropdown เลือกจำนวนแถว
        // order: [[1, "asc"]],
       

        // language: {
        //   search: "_INPUT_",
        //   searchPlaceholder: "🔍 "
        // }

	// 	language: {
    //     lengthMenu: "_MENU_ entries per page"  // _MENU_ จะถูกแทนด้วย select
    // },

		initComplete: function () {
			this.api()
				.columns()
				.every(function () {
					let column = this;
					let title = column.footer().textContent;

					// Create input element
					let input = document.createElement('input');
					input.placeholder = '🔍 ' + title;

					input.className = "input input-sm rounded-full max-sm:w-24 text-center";
					column.footer().replaceChildren(input);

					// Event listener for user input
					input.addEventListener('keyup', () => {
						if (column.search() !== this.value) {
							column.search(input.value).draw();
						}
					});
				});
    		},

			
			

      });

	  $('div.dt-search').removeClass('dt-search');

	  $('label[for="dt-search-0"]').remove();

	
	  $('#dt-search-0').attr('class', 'input input-sm rounded-full max-sm:w-24');
	  $('#dt-search-0').attr('placeholder', '🔍');

	  $('label[for="dt-length-0"]').remove();
	  $('#dt-length-0').attr('class', 'select input-sm rounded-full max-sm:w-24 px-10 py-2');
	//   $('#dt-length-0').attr('class', 'select');



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
