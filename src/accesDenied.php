<?php if(isset($_GET['forbidden'])): ?>
<script>
	window.onload = function() {
		alert("Acces refusé. Votre role ne correspond pas !")

		const url = new URL(window.location);
		url.searchParams.delete('forbidden');
		window.history.replaceState({}, document.title, url.pathname + url.search);
	};
</script>
<?php endif; ?>
