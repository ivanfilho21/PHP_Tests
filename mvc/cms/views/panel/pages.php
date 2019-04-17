<div class="container">
	<!-- <?php #$this->loadCrudTable("Pages", "pages", $pages, $columns); ?> -->
	<h1>Your Pages</h1>

	<div class="preview-pages">
		<a class="page-preview" href="<?php echo BASE_URL; ?>panel/create/pages" style="display: flex; flex-direction: column; align-items: center; justify-content: center;"><i class="fas fa-plus" style="font-size: 1.5em;"></i></a>
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