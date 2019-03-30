<?php require "pages/header.php"; ?>
<?php require "index-script.php"; ?>
	<section class="card">
		<h1>We now have <?php echo $totalAnnouncements; ?>  advertisement<?php echo ($totalAnnouncements > 1) ? "s" : ""; ?></h1>
		<h3>And <?php echo $totalUsers; ?> registered user<?php echo ($totalUsers > 1) ? "s" : ""; ?></h3>
	</section>

	<section class="card">
		<h3>Advanced Search</h3>

		<form method="GET">
			<label>By Category</label>
			<ul class="ul">
				<?php foreach ($categories->getAll() as $category) : ?>
				<li>
					<input type="checkbox" name="filter[category][]" id="category<?php echo $category['id']; ?>"> <label class="checkbox-label" for="category<?php echo $category['id']; ?>"><?php echo $category['name']; ?></label>
				</li>
				<?php endforeach; ?>
			</ul>
			
			<input type="submit" name="search" value="Search" class="btn btn-default">
		</form>
	</section>

	<section class="card">
		<h3>Newest Announcements</h3>
		<table class="table table-stripped">
			<tbody>
				<?php foreach ($announcements->getLatest($database, $currentPage, $maxPerPage) as $a) : ?>
				<tr>
					<td>
						<img class="thumb" src="<?php echo ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($a['url'])) ? $a['url'] : 'default.svg'; ?>" alt="Announcement Picture" border="0">
					</td>

					<td>
						<p><a href="announcement-view.php?id=<?php echo $a['id']; ?>"><?php echo $a["title"]; ?></a></p>
						<p><?php echo $a["categoryName"]; ?></p>
					</td>

					<td>
						<p>US$ <?php echo $a["price"]; ?></p>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="pagination">
			<?php for ($i = 1; $i <= $maxPages; $i++) : ?>
			<a <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?> href="index.php?p=<?php echo ($i); ?>"><?php echo ($i); ?></a>
			<?php endfor; ?>
		</div>
		
	</section>

<?php require "pages/footer.php"; ?>