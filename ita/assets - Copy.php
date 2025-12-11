<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>IT Asset Manangement</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="output.css" rel="stylesheet" />
		<script	type="module" src="https://cdn.jsdelivr.net/npm/@weblogin/trendchart-elements@1.1.0/dist/index.js/+esm"	async></script>
		<script	src="https://cdn.jsdelivr.net/npm/external-svg-loader@1.6.10/svg-loader.min.js"	async></script>
		<script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

		<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
		<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

		 <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      plugins: [daisyui],
    }
  </script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.css" rel="stylesheet" /> -->

  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->

  <!-- <link rel="stylesheet"        href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />

  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->

		<!-- <script defer async src="https://media.ethicalads.io/media/client/ethicalads.min.js" onload="window.dtAds()" onerror="window.dtAds()"></script> -->

		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/columncontrol/1.1.0/css/columnControl.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.6/css/responsive.dataTables.min.css">
		<script src="https://cdn.datatables.net/columncontrol/1.1.0/js/dataTables.columnControl.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/3.0.6/js/dataTables.responsive.min.js"></script> -->

  <!-- <link rel="stylesheet"        href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />

  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->

		<!-- <script defer async src="https://media.ethicalads.io/media/client/ethicalads.min.js" onload="window.dtAds()" onerror="window.dtAds()"></script> -->

		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/columncontrol/1.1.0/css/columnControl.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.6/css/responsive.dataTables.min.css">
		<script src="https://cdn.datatables.net/columncontrol/1.1.0/js/dataTables.columnControl.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/3.0.6/js/dataTables.responsive.min.js"></script> -->

		<!-- <link href="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.css" rel="stylesheet" integrity="sha384-pmGS6IIcXhAVIhcnh9X/mxffzZNHbuxboycGuQQoP3pAbb0SwlSUUHn2v22bOenI" crossorigin="anonymous"> -->
 
<script src="https://cdn.datatables.net/v/dt/dt-2.3.4/datatables.min.js" integrity="sha384-X2pTSfom8FUa+vGQ+DgTCSyBZYkC1RliOduHa0X96D060s7Q//fnOh3LcazRNHyo" crossorigin="anonymous"></script>


		

		<style id="theme_style_custom_css">
			@import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css';
			@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap');

			html, body{ 
				font-family: "Quicksand", "LINE Seed Sans TH", sans-serif;
				/* font-size:19px !important; */
				font-weight:200;
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
						<input type="text"	placeholder="Search" class="input input-sm rounded-full max-sm:w-24" />
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


				<div class="fixed bottom-4 right-4">
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

				<section class="card bg-base-100 col-span-12 overflow-hidden shadow-xs xl:col-span-6">
					<div class="card-body grow-0">
						<h2 class="card-title">
							<a class="link-hover link">All</a>
						</h2>
					</div>
					<!-- <div class="overflow-x-auto"> -->
						<div class="overflow-x-auto">
						<!-- <table class="table-zebra table">
							<thead>
								<tr>
									<th>NAME</th>
									<th>DATE</th>
									<th>
										STATUS
									</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td>Cy Ganderton</td>
									<td>Feb 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-up-right.svg"
											class="text-success inline-block h-5 w-5"></svg>
										180 USD
									</td>
								</tr>
								<tr>
									<td>Hart Hagerty</td>
									<td>Sep 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-up-right.svg"
											class="text-success inline-block h-5 w-5"></svg>
										250 USD
									</td>
								</tr>
								<tr>
									<td>Jim Hagerty</td>
									<td>Sep 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-up-right.svg"
											class="text-success inline-block h-5 w-5"></svg>
										250 USD
									</td>
								</tr>
								<tr>
									<td>Hart Hagerty</td>
									<td>Sep 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-down-right.svg"
											class="text-error inline-block h-5 w-5"></svg>
										250 USD
									</td>
								</tr>
								<tr>
									<td>Hart Hagerty</td>
									<td>Sep 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-down-right.svg"
											class="text-error inline-block h-5 w-5"></svg>
										250 USD
									</td>
								</tr>
								<tr>
									<td>Brice Swyre</td>
									<td>Jul 2nd</td>
									<td>
										<svg
											data-src="https://unpkg.com/heroicons/20/solid/arrow-up-right.svg"
											class="text-success inline-block h-5 w-5"></svg>
										320 USD
									</td>
								</tr>
							</tbody>
						</table> -->

						<!-- <table id="example" class="table-zebra table display">
	<thead>
		<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Office</th>
			<th>Age</th>
			<th>Start date</th>
			<th>Salary</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tiger Nixon</td>
			<td>System Architect</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>2011-04-25</td>
			<td>$320,800</td>
		</tr>
		<tr>
			<td>Garrett Winters</td>
			<td>Accountant</td>
			<td>Tokyo</td>
			<td>63</td>
			<td>2011-07-25</td>
			<td>$170,750</td>
		</tr>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Office</th>
			<th>Age</th>
			<th>Start date</th>
			<th>Salary</th>
		</tr>
	</tfoot>
</table> -->

<table id="example" class="table-zebra table display" style="width:100%">
      <thead>
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

		</section>
				

			</div>
		</main>

	<?php require 'aside.php'; ?>	

	 <script>
    $(document).ready(function () {
      $('#example').DataTable({
        "order": [[1, "asc"]] // default sort by Age ascending
      });
    });
  </script>
	</body>
</html>
