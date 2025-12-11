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

		<style>
  /* เปลี่ยน separator จาก / เป็น > */
  .breadcrumbs ul li + li:before {
    content: ">";
    padding: 0 0.5rem;
    color: #9ca3af; /* สีเทา */
  }
</style>

	</head>
	<!-- drawer -->
	<body class="drawer bg-base-200 lg:drawer-open min-h-screen">
		<input id="my-drawer" type="checkbox" class="drawer-toggle" />
		<main class="drawer-content">
			<div class="grid grid-cols-12 grid-rows-[min-content] gap-y-12 p-4 lg:gap-x-12 lg:p-10">
				<!-- <header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<label for="my-drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
						<svg data-src="https://unpkg.com/heroicons/20/solid/bars-3.svg" class="h-5 w-5"></svg>
					</label>
					<div class="grow">
						<h1 class="lg:text-2xl lg:font-light">Settings</h1>
					</div>
					
					<button class="swap swap-rotate" data-toggle-theme="dark" data-act-class="swap-active">
						<svg class="swap-off h-6 w-6 fill-current"	xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
						</svg>
						<svg class="swap-on h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
						</svg>
					</button>

					
				</header> -->

				<header class="col-span-12 flex items-center gap-2 lg:gap-4">
  <label for="my-drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
    <svg data-src="https://unpkg.com/heroicons/20/solid/bars-3.svg" class="h-5 w-5"></svg>
  </label>
  <div class="grow">
    <h1 class="lg:text-2xl lg:font-light">Settings</h1>
    <!-- ✅ Breadcrumbs -->
  <div class="text-sm breadcrumbs p-4">
  <ul class="flex items-center space-x-2">
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Settings</a></li>
    <li><strong>Form Inputs</strong></li>
  </ul>
</div>

  </div>
  <button class="swap swap-rotate" data-toggle-theme="dark" data-act-class="swap-active">
    <!-- ... -->
  </button>
</header>


				<!-- <section class="stats stats-vertical xl:stats-horizontal bg-base-100 col-span-12 w-full shadow-xs">
					<div class="stat">
						<div class="stat-title">Name</div>
						<div class="stat-value">Lenovo</div>
						<div class="stat-desc">21% more than last month</div>
					</div>

				
				</section> -->
				

			
				

				

				

				<header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<div class="grow">
						<h1 class="font-light lg:text-xl">Forms and inputs</h1>
					</div>
				</header>

				<section class="col-span-12 xl:col-span-4">
					<fieldset class="fieldset">
						<label class="label">Product name</label>
						<input type="text" placeholder="Type here" class="input w-full" />
					</fieldset>
					<fieldset class="fieldset">
						<label class="label">Category</label>
						<select class="select w-full">
							<option disabled selected>Pick</option>
							<option>T-shirts</option>
							<option>Dresses</option>
							<option>Hats</option>
							<option>Accessories</option>
						</select>
					</fieldset>
					<fieldset class="fieldset">
						<label class="label">Size (cm)</label>
						<div class="flex items-center gap-2">
							<input type="text" placeholder="Width" class="input w-1/2" />
							×
							<input type="text" placeholder="Height" class="input w-1/2" />
						</div>
					</fieldset>
					<hr class="border-base-content/5 my-6 border-t-2" />
					<fieldset class="fieldset">
						<div class="label justify-start gap-2">
							<svg
								data-src="https://unpkg.com/heroicons/20/solid/eye.svg"
								class="text-base-content/30 h-4 w-4"></svg>
							<span class="label-text text-base-content/50 text-xs font-bold">
								Choose product visibility
							</span>
						</div>
					</fieldset>
					<fieldset class="fieldset">
						<label class="flex cursor-pointer justify-between py-2">
							<span class="label">Visible only for managers</span>
							<input name="visibility" type="radio" class="radio radio-sm" checked />
						</label>
						<label class="flex cursor-pointer justify-between py-2">
							<span class="label">Visible for all users</span>
							<input name="visibility" type="radio" class="radio radio-sm" checked />
						</label>
					</fieldset>
				</section>

				<!-- <section class="card bg-base-100 col-span-12 shadow-xs xl:col-span-5">
					<div class="card-body pb-0">
						<h2 class="card-title">32,800</h2>
						<p>From 84 countries</p>
					</div>
					<svg
						data-src="https://unpkg.com/@svg-maps/world@1.0.1/world.svg"
						class="fill-base-content/80 m-4" />
				</section> -->

				<!-- <section class="card bg-base-100 col-span-12 shadow-xs xl:col-span-3">
					<div class="text-base-content/60 p-6 pb-0 text-center text-xs font-bold">
						Recent events
					</div>
					<ul class="menu w-full">
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?6" />
									</div>
								</div>
								<span class="text-xs">
									<b>New User</b>
									<br />
									2 minutes ago
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?7" />
									</div>
								</div>
								<span class="text-xs">
									<b>New product added</b>
									<br />
									1 hour ago
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?8" />
									</div>
								</div>
								<span class="text-xs">
									<b>Database update</b>
									<br />
									1 hour ago
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?9" />
									</div>
								</div>
								<span class="text-xs">
									<b>Newsletter sent</b>
									<br />
									2 hour ago
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?10" />
									</div>
								</div>
								<span class="text-xs">
									<b>New User</b>
									<br />
									2 hours ago
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?11" />
									</div>
								</div>
								<span class="text-xs">
									<b>New product added</b>
									<br />
									yesterday
								</span>
							</a>
						</li>
						<li>
							<a class="gap-4">
								<div class="avatar">
									<div class="w-6 rounded-full">
										<img src="https://picsum.photos/80/80?12" />
									</div>
								</div>
								<span class="text-xs">
									<b>New product added</b>
									<br />
									yesterday
								</span>
							</a>
						</li>
					</ul>
				</section> -->

				<!-- <header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<div class="grow">
						<h1 class="font-light lg:text-2xl">Form sections</h1>
					</div>
				</header> -->

				<section class="col-span-12 xl:col-span-4">
					<label class="label">
						<span class="label-text">Product management</span>
					</label>
					<ul class="flex flex-col gap-4 p-1">
						<li class="flex items-start gap-4">
							<img
								class="rounded-field h-14 w-14 shrink-0"
								width="56"
								height="56"
								src="https://picsum.photos/80/80?id=1"
								alt="Product" />
							<div class="flex grow flex-col gap-1">
								<div class="text-sm">Portable fidget spinner</div>
								<div class="text-base-content/50 text-xs">Space Gray</div>
								<div class="text-base-content/50 font-mono text-xs">$299</div>
							</div>
							<div class="join bg-base-100 justify-self-end">
								<button class="btn btn-ghost join-item btn-xs">–</button>
								<input class="input join-item input-ghost input-xs w-10 text-center" value="1" />
								<button class="btn btn-ghost join-item btn-xs">+</button>
							</div>
						</li>
						<li class="flex items-start gap-4">
							<img
								class="rounded-field h-14 w-14 shrink-0"
								width="56"
								height="56"
								src="https://picsum.photos/80/80?id=2"
								alt="Product" />
							<div class="flex grow flex-col gap-1">
								<div class="text-sm">Wooden VR holder</div>
								<div class="text-base-content/50 text-xs">Casual Red</div>
								<div class="text-base-content/50 font-mono text-xs">$199</div>
							</div>
							<div class="join bg-base-100 justify-self-end">
								<button class="btn btn-ghost join-item btn-xs">–</button>
								<input class="input join-item input-ghost input-xs w-10 text-center" value="1" />
								<button class="btn btn-ghost join-item btn-xs">+</button>
							</div>
						</li>
						<li class="flex items-start gap-4">
							<img
								class="rounded-field h-14 w-14 shrink-0"
								width="56"
								height="56"
								src="https://picsum.photos/80/80?id=3"
								alt="Product" />
							<div class="flex grow flex-col gap-1">
								<div class="text-sm">Portable keychain</div>
								<div class="text-base-content/50 text-xs">Normal Yellow</div>
								<div class="text-base-content/50 font-mono text-xs">$299</div>
							</div>
							<div class="join bg-base-100 justify-self-end">
								<button class="btn btn-ghost join-item btn-xs">–</button>
								<input class="input join-item input-ghost input-xs w-10 text-center" value="1" />
								<button class="btn btn-ghost join-item btn-xs">+</button>
							</div>
						</li>
					</ul>
				</section>

				<section class="col-span-12 xl:col-span-4">
					<fieldset class="fieldset">
						<label class="label">Product name</label>
						<input type="text" placeholder="Type here" class="input w-full" />
					</fieldset>
					<fieldset class="fieldset">
						<label class="label">Category</label>
						<select class="select w-full">
							<option disabled selected>Pick</option>
							<option>T-shirts</option>
							<option>Dresses</option>
							<option>Hats</option>
							<option>Accessories</option>
						</select>
					</fieldset>

					<fieldset class="fieldset">
						<label class="flex cursor-pointer justify-between py-2">
							<span class="label">Public</span>
							<input type="checkbox" class="toggle toggle-sm" checked />
						</label>
					</fieldset>
					<fieldset class="fieldset">
						<label class="flex cursor-pointer justify-between py-2">
							<span class="label">Featured product</span>
							<input type="checkbox" class="toggle toggle-sm" checked />
						</label>
					</fieldset>
				</section>

				<section class="col-span-12 xl:col-span-4">
					<fieldset class="fieldset">
						<label class="label">Size (cm)</label>
						<div class="flex items-center gap-2">
							<input type="text" placeholder="Width" class="input w-1/2" />
							×
							<input type="text" placeholder="Height" class="input w-1/2" />
						</div>
					</fieldset>
					<fieldset class="fieldset">
						<div class="text-base-content/70 py-4 text-xs">
							Set a audience range for this product.
							<br />
							This is optional
						</div>
						<input type="range" min="0" max="100" value="25" class="range range-xs" step="25" />
						<div class="flex w-full justify-between px-2 py-2 text-xs">
							<span>0</span>
							<span>25</span>
							<span>50</span>
							<span>75</span>
							<span>100</span>
						</div>
					</fieldset>
					<fieldset class="fieldset">
						<div class="flex gap-4 py-4">
							<button class="btn btn-outline">Save draft</button>
							<button class="btn btn-primary grow">Save and publish</button>
						</div>
					</fieldset>
				</section>

				<!-- <header class="col-span-12 flex items-center gap-2 lg:gap-4">
					<div class="grow">
						<h1 class="font-light lg:text-2xl">Payment information</h1>
					</div>
				</header> -->

				<section class="card bg-base-100 col-span-12 xl:col-span-5">
					<form class="card-body" action="">
						<div class="alert alert-success">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								class="h-6 w-6 shrink-0 stroke-current"
								fill="none"
								viewBox="0 0 24 24">
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
							<span>Your payment was successful</span>
						</div>
						<fieldset class="fieldset">
							<label class="label">
								<span class="label-text">Card Number</span>
							</label>
							<input
								type="text"
								class="input w-full font-mono"
								pattern="\d{16}"
								title="16 digits card number"
								minlength="16"
								maxlength="16"
								required />
						</fieldset>
						<div class="grid grid-cols-2 gap-2">
							<fieldset class="fieldset">
								<label class="label">
									<span class="label-text">CVV</span>
								</label>
								<input
									type="text"
									placeholder="XXX"
									pattern="\d{3,4}"
									title="3 or 4 digits CVV number"
									minlength="3"
									maxlength="4"
									required
									class="input text-center font-mono" />
							</fieldset>
							<fieldset class="fieldset">
								<label class="label">
									<span class="label-text">Expiration date</span>
								</label>
								<div class="input grid grid-cols-2 gap-2">
									<input
										placeholder="MM"
										type="text"
										pattern="\d{2}"
										title="2 digits month number"
										minlength="2"
										maxlength="2"
										class="text-center font-mono"
										required />
									<input
										placeholder="YY"
										type="text"
										pattern="\d{2}"
										title="2 digits year number"
										minlength="2"
										maxlength="2"
										class="text-center font-mono"
										required />
								</div>
							</fieldset>
						</div>
						<fieldset class="fieldset">
							<label class="label">
								<span class="label-text">Name</span>
							</label>
							<input type="text" class="input w-full" />
						</fieldset>
						<fieldset class="fieldset">
							<label class="flex cursor-pointer gap-4">
								<input type="checkbox" class="checkbox checkbox-sm" checked />
								<span class="label-text">Save my card information for future payments</span>
							</label>
							<label class="flex cursor-pointer gap-4">
								<input required type="checkbox" class="checkbox checkbox-sm" checked />
								<span class="label-text">Accept terms of use and privac policy</span>
							</label>
						</fieldset>
						<fieldset class="fieldset">
							<div class="flex items-end py-4">
								<button class="btn btn-primary grow">Confirm Payment</button>
							</div>
						</fieldset>
					</form>
				</section>

			</div>
		</main>

	<?php require 'aside.php'; ?>	
	</body>
</html>
