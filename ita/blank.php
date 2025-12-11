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

		

				

				<section class="card bg-base-100 col-span-12 overflow-hidden shadow-xs xl:col-span-6">
					<div class="card-body grow-0">
						<h2 class="card-title">
							<a class="link-hover link">Transactions</a>
						</h2>
					</div>
					<div class="overflow-x-auto">
						<table class="table-zebra table">
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
						</table>
					</div>
				</section>

				<section class="card bg-primary text-primary-content col-span-12 shadow-xs xl:col-span-6">
					<div class="card-body pb-0">
						<h2 class="card-title">Create new</h2>
						<a class="link-hover link text-xs">+ Create new</a>
					</div>
					<tc-column
						class="h-full w-full p-4 pt-0 [--shape-color:var(--color-primary-content)]"
						values="[12,10,12,4,13,16,14,10,12,11,17,18,16,17,20,14,15,13,12,14]"
						min="0"
						shape-radius="4"
						shape-gap="4"></tc-column>
				</section>

				<header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<div class="grow">
						<h1 class="font-light lg:text-2xl">Forms and inputs</h1>
					</div>
				</header>
				

			</div>
		</main>

	<?php require 'aside.php'; ?>	
	</body>
</html>
