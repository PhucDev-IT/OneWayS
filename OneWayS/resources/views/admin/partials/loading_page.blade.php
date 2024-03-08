<div id="container_loading">
	<svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
		<defs>
			<linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
				<stop offset="0%" stop-color="hsl(313,90%,55%)" />
				<stop offset="100%" stop-color="hsl(223,90%,55%)" />
			</linearGradient>
			<linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
				<stop offset="0%" stop-color="hsl(313,90%,55%)" />
				<stop offset="100%" stop-color="hsl(223,90%,55%)" />
			</linearGradient>
		</defs>
		<circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
		<line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
	</svg>
</div>

<style>
	#container_loading {
		background-color: #ffffff;
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.pl {
		display: block;
		width: 6.25em;
		height: 6.25em;
	}

	.pl__ring,
	.pl__ball {
		animation: ring 2s ease-out infinite;
	}

	.pl__ball {
		animation-name: ball;
	}

	/* Dark theme  */
	@media (prefers-color-scheme: dark) {
		:root {
			--bg: hsl(var(--hue), 10%, 10%);
			--fg: hsl(var(--hue), 10%, 90%);
		}
	}

	/* Animation */
	@keyframes ring {
		from {
			stroke-dasharray: 0 257 0 0 1 0 0 258;
		}

		25% {
			stroke-dasharray: 0 0 0 0 257 0 258 0;
		}

		50%,
		to {
			stroke-dasharray: 0 0 0 0 0 515 0 0;
		}
	}

	@keyframes ball {

		from,
		50% {
			animation-timing-function: ease-in;
			stroke-dashoffset: 1;
		}

		64% {
			animation-timing-function: ease-in;
			stroke-dashoffset: -109;
		}

		78% {
			animation-timing-function: ease-in;
			stroke-dashoffset: -145;
		}

		92% {
			animation-timing-function: ease-in;
			stroke-dashoffset: -157;
		}

		57%,
		71%,
		85%,
		99%,
		to {
			animation-timing-function: ease-out;
			stroke-dashoffset: -163;
		}
	}
</style>

<script>
	function hiddenLoadingPage() {
		// Ẩn container_loading bằng jQuery
		$('#container_loading').hide();
	}

	function showLoadingPage(){
		$('#container_loading').show();
	}
</script>