<section class="card">
	<div class="center">
		<h1><?php echo $title; ?></h1>

		<?php if (count($pictures) > 0) : ?>
		<p>Pictures: <?php echo count($pictures); ?></p>

		<div id="slider" class="slider">
			<div id="slider-frame" class="slider-frame">
				
				<?php foreach($pictures as $picture) : ?>
					<div class="slide">
						<img src="<?php echo BASE_URL .ANNOUNCEMENT_PICTURES_DIR ."/" .$picture["url"]; ?>" alt="Announcement Picture">
					</div>
				<?php endforeach; ?>
				
			</div>
		</div>
		<div>
			<button class="slider-btn" id="left-btn" onclick="previousSlide()"><i class="fas fa-chevron-left"></i></button>
			<button class="slider-btn" id="right-btn" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></button>
		</div>
		<?php endif; ?>

		<h2>U$$ <?php echo $price;?></h2>

		<p>
			<?php echo $description; ?>
		</p>
		<script src="<?php echo BASE_URL; ?>assets/js/gallery.js"></script>
	</div>
</section>