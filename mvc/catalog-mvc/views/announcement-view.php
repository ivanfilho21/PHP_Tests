<section class="card">
	<div class="center">
		<h1><?php echo $title; ?></h1>

		<img class="img" src="<?php echo ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($firstPictureUrl)) ? $firstPictureUrl : 'default.svg'; ?>" alt="Announcement Picture" border="0">

		<h2>U$$ <?php echo $price;?></h2>

		<p>
			<?php echo $description; ?>
		</p>
	</div>
</section>