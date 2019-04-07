<?php require "pages/header.php"; ?>
<?php require "index-filter.php"; ?>
<?php require "index-script.php"; ?>
	<section class="card" style="display: none;">
		<h1>We now have <?php echo $totalAnnouncements; ?>  advertisement<?php echo ($totalAnnouncements > 1) ? "s" : ""; ?></h1>
		<h3>And <?php echo $totalUsers; ?> registered user<?php echo ($totalUsers > 1) ? "s" : ""; ?></h3>
	</section>

	<div class="index-wrapper">
		<section class="advanced-search">
			<h3>Filter</h3>

			<form method="GET">
				<label>By Category</label>

				<!-- <input type="hidden" name="p" value="<?php echo $currentPage; ?>"> -->

				<select name="filter[category]">
					<option value="0">All</option>
				<?php $categoryList = $categories->getAll(); ?>
				<?php foreach ($categoryList as $key => $category) : ?>
					<option value="<?php echo $category['id']; ?>" <?php echo ($filter["category"] == $category["id"]) ? "selected" : ""; ?>>
						<?php echo $category['name']; ?>
					</option>
				<?php endforeach; ?>
				</select>

				<!-- <label>By Price</label>

				<select name="filter[price-range]">
					<option value="0">Any</option>
					<option value="1" <?php echo (isset($filter["price-range"]) && $filter["price-range"] == 1) ? "selected" : ""; ?>>Minimum</option>
					<option value="2" <?php echo (isset($filter["price-range"]) && $filter["price-range"] == 2) ? "selected" : ""; ?>>Maximum</option>
				</select>

				<input type="text" name="filter[price]" placeholder="Price" value="<?php echo (isset($filter["price"])) ? $filter["price"] : ""; ?>"> -->

				<label>By Condition</label>
				<select name="filter[condition]">
					<option value="0">Any</option>
					<option value="1" <?php echo (isset($filter["condition"]) && $filter["condition"] == 1) ? "selected" : ""; ?>>New</option>
					<option value="2" <?php echo (isset($filter["condition"]) && $filter["condition"] == 2) ? "selected" : ""; ?>>Used</option>
				</select>

				<input type="submit" name="filter-submit" value="Filter" class="btn btn-default">
			</form>
		</section>

		<section class="newest-announcements">
			<h3>Newest Announcements</h3>
			<table class="table table-stripped">
				<tbody>
					<?php foreach ($latestAnnouncements as $a) : ?>
					<tr>
						<td>
							<img class="announcement-thumb" src="<?php echo ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($a['url'])) ? $a['url'] : 'default.svg'; ?>" alt="Announcement Picture" border="0">
						</td>

						<td>
							<p><a href="announcement-view.php?id=<?php echo $a['id']; ?>" class="announcement-title"><?php echo $a["title"]; ?></a></p>
							<p class="announcement-category"><?php echo $a["categoryName"]; ?></p>
						</td>

						<td>
							<p class="announcement-price">US$ <?php echo $a["price"]; ?></p>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="pagination">
				<?php for ($i = 1; $i <= $maxPages; $i++) : ?>
				<a <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?> href="index.php?<?php
				$get = $_GET;
				$get['p'] = $i;
				echo http_build_query($get);
				?>"><?php echo ($i); ?></a>
				<?php endfor; ?>
			</div>
			
		</section>
	</div>

<?php require "pages/footer.php"; ?>