<div class="container">
	<!-- <?php #$this->loadCrudTable("Pages", "pages", $pages, $columns); ?> -->
	<h1>Your Pages</h1>

	<div class="preview-pages">
	<?php foreach ($pages as $p) : ?>
		<a class="page-preview" href="<?php echo BASE_URL .$p['url']; ?>" target="_blank">
			<div>
				<h1 class="page-title"><?php echo $p["title"]; ?></h1>
				<span class="page-body">
					<?php echo htmlspecialchars_decode($p["body"]); ?>
				</span>
			</div>
		</a>
	<?php endforeach; ?>
	</div>
</div>