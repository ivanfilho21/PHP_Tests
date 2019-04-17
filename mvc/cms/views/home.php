<div class="banner">
	<?php if (! empty($this->siteConfig["home_banner"])) : ?>
	<div class="banner-img" style="background-image: url('<?php echo BASE_URL ."assets/img/banner/" .$this->siteConfig["home_banner"]; ?>')">
	</div>
	<?php endif; ?>

	<?php if (! empty($this->siteConfig["home_welcome"])) : ?>	
	<div class="home-welcome">
		<p><?php echo $this->siteConfig["home_welcome"]; ?></p>
	</div>
	<?php endif; ?>
</div>

<h1>Home</h1>

<!-- Reviews -->
<div class="recent-posts">
	...
</div>

<!-- Call to action -->
<div class="home-cta">
	...
</div>

<style>
	.home-cta {
		text-align: center;
		margin-top: 1em;
		margin-bottom: 1em;
	}
</style>