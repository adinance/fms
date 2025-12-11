import { defineConfig } from "vite"
import { exec } from "child_process"

export default defineConfig({
	server: {
		open: true, // Open browser on server start
		watch: {
			// Custom handling for file changes
			ignored: ["**/node_modules/**"],
		},
	},
	plugins: [
		{
			name: "html-change-watcher",
			handleHotUpdate({ file, server }) {
				// Only run the script if HTML files are changed
				if (file.endsWith(".html")) {
					console.log(`HTML file changed: ${file}`)

					// Run your npm script
					exec("npm run build", (error, stdout, stderr) => {
						if (error) {
							console.error(`Error running npm script: ${error}`)
							return
						}

						console.log(`npm run build output: ${stdout}`)

						// Force reload all clients after the command completes
						server.ws.send({
							type: "full-reload",
							path: "*",
						})
					})
				}

				// Return null to let Vite handle the HMR as usual
				return null
			},
		},
	],
	// Make sure it serves HTML files correctly
	appType: "mpa", // Multi-page application mode
})
