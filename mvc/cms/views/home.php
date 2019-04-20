<div class="banner">
	<?php if (! empty($home["banner"])) : ?>
	<div class="banner-img" style="background-image: url('<?php echo BASE_URL ."assets/img/banner/" .$home["banner"]; ?>')">
	</div>
	<?php endif; ?>

	<?php if (! empty($home["welcome"])) : ?>	
	<div class="home-welcome">
		<p><?php echo $home["welcome"]; ?></p>
	</div>
	<?php endif; ?>
</div>

<span class="body">
	<?php echo htmlspecialchars_decode($home["body"]); ?>
</span>

<style>
	.body p {
		margin: 0.75em 0 0.5em 0;
	}
</style>