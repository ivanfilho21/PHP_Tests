<section class="card">
	<div class="center">
		<h1><?php echo $title; ?></h1>

		<div class="gallery">
			<div class="buttons">
				<div class="gallery-btn left" style="float: left;"></div>
				<div class="gallery-btn right" style="float: right;"></div>
			</div>
			<div class="gallery-frame">
			<?php foreach($pictures as $picture) : ?>
				<img src="<?php echo BASE_URL .ANNOUNCEMENT_PICTURES_DIR .$picture["url"]; ?>" alt="Announcement Picture">
			<?php endforeach; ?>
			</div>
		</div>

		<br><br>

		<img class="img" src="<?php echo BASE_URL .ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($pictures[0])) ? $pictures[0]["url"] : 'default.svg'; ?>" alt="Announcement Picture" border="0">

		<h2>U$$ <?php echo $price;?></h2>

		<p>
			<?php echo $description; ?>
		</p>
	</div>
</section>