<?php require "pages/header.php"; ?>
<?php require "index-advanced-search.php"; ?>
<?php require "index-script.php"; ?>
	<section class="card" style="display: none;">
		<h1>We now have <?php echo $totalAnnouncements; ?>  advertisement<?php echo ($totalAnnouncements > 1) ? "s" : ""; ?></h1>
		<h3>And <?php echo $totalUsers; ?> registered user<?php echo ($totalUsers > 1) ? "s" : ""; ?></h3>
	</section>

	<div class="index-wrapper">
		<section class="advanced-search">
			<h3>Advanced Search</h3>

			<form method="GET">
				<label>By Category</label>
				<select name="filter[category][]">
				<?php $categoryList = $categories->getAll(); ?>
				<?php foreach ($categoryList as $key => $category) : ?>
					<option value="<?php echo $category['id']; ?>" <?php echo ($filter["category"] == $category["id"]) ? "checked" : ""; ?>>
						<?php echo $category['name']; ?>
					</option>
				<?php endforeach; ?>
				</select>
				<ul class="ul">
					<?php foreach ($categories->getAll() as $key => $category) : ?>
					<li>
						
					</li>
					<?php endforeach; ?>
				</ul>

				<label>By Price</label>
				<ul class="ul">
					<li>
						<input type="radio" name="filter[price-range]" id="range-min" value="1" <?php echo (isset($filter["price-range"]) && $filter["price-range"] == 1) ? "checked" : ""; ?>> <label for="range-min" class="label-option">Minimum</label>
					</li>
					<li>
						<input type="radio" name="filter[price-range]" id="range-max" value="2" <?php echo (isset($filter["price-range"]) && $filter["price-range"] == 2) ? "checked" : ""; ?>> <label for="range-max" class="label-option">Maximum</label>
					</li>
				</ul>
				<input type="text" name="filter[price]" placeholder="Price" value="<?php echo (isset($filter["price"])) ? $filter["price"] : ""; ?>">

				<label>By Condition</label>
				<ul class="ul">
					<li>
						<input type="radio" name="filter[condition]" id="condition-new" value="1" <?php echo (isset($filter["condition"]) && $filter["condition"] == 1) ? "checked" : ""; ?>> <label for="condition-new" class="label-option">New</label>
					</li>
					<li>
						<input type="radio" name="filter[condition]" id="condition-used" value="2" <?php echo (isset($filter["condition"]) && $filter["condition"] == 2) ? "checked" : ""; ?>> <label for="condition-used" class="label-option">Used</label>
					</li>
				</ul>

				<input type="submit" name="advanced-search" value="Search" class="btn btn-default">
			</form>
		</section>

		<section class="newest-announcements">
			<h3>Newest Announcements</h3>
			<table class="table table-stripped">
				<tbody>
					<?php foreach ($announcements->getLatest($database, $currentPage, $maxPerPage, $filter) as $a) : ?>
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
	</div>

<?php require "pages/footer.php"; ?>