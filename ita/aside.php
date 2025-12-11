<aside class="drawer-side z-10">
			<label for="my-drawer" class="drawer-overlay"></label>
			<nav class="bg-base-100 flex min-h-screen w-72 flex-col gap-2 overflow-y-auto px-6 py-10">
				<div class="mx-4 flex items-center gap-1 font-black whitespace-nowrap">
					<svg width="32"	height="32"	viewBox="0 0 1024 1024" fill="none"	xmlns="http://www.w3.org/2000/svg">
						<rect x="256" y="670.72" width="512" height="256" rx="128" class="fill-base-content" />
						<circle cx="512" cy="353.28" r="256" class="fill-base-content" />
						<circle	cx="512"
							cy="353.28"
							r="261"
							stroke="black"
							stroke-opacity="0.2"
							stroke-width="10" />
						<circle cx="512" cy="353.28" r="114.688" class="fill-base-100" />
					</svg>
					IT Assets Management
				</div>
				<ul class="menu w-full">
					<li>
						<a class="menu-active">
							<svg data-src="https://unpkg.com/heroicons/20/solid/home.svg" class="h-5 w-5"></svg>
							Dashboard
						</a>
					</li>
					
					<li>
						<details>
							<summary>
								<svg
									data-src="https://unpkg.com/heroicons/20/solid/squares-2x2.svg"
									class="h-5 w-5"></svg>
								Assets
							</summary>
							<ul>
								<li><a href="assets.php">All Assets</a></li>
								<li><a>Computer</a></li>
								<li><a>Monitor</a></li>
								<li><a>Printer</a></li>
								<li><a>UPS</a></li>
								<li><a>Others</a></li>
							</ul>
						</details>
					</li>
					
					
					<li>
						<details>
							<summary>
								<svg data-src="https://unpkg.com/heroicons/20/solid/adjustments-vertical.svg" class="h-5 w-5"></svg>Settings
							</summary>
							<ul>
								<li><a>Type</a></li>
								<li><a>Brand</a></li>
							</ul>
						</details>
					</li>

					<li>
						<a>
							<svg data-src="https://unpkg.com/heroicons/20/solid/power.svg" class="h-5 w-5"></svg>
							Logout
						</a>
					</li>
				</ul>
			</nav>
		</aside>