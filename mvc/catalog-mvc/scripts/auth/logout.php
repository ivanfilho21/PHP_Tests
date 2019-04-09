<?php
unsetUserSession();
?>
<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
<script>
	var baseUrl = document.getElementById("data").getAttribute("data-base-url");
	window.location.href = baseUrl;
</script>
<?php
#header("Location: " .BASE_URL);
exit();