<section class="newest-announcements">
	<table class="table table-stripped">
		<tbody>
			<?php foreach ($results as $a) : ?>
			<tr>
				<td>
					<img class="announcement-thumb" src="<?php echo BASE_URL .ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($a['url'])) ? $a['url'] : 'default.svg'; ?>" alt="Announcement Picture" border="0">
				</td>

				<td>
					<p><a href="<?php echo BASE_URL; ?>announcements/view/<?php echo $a['id']; ?>" class="announcement-title"><?php echo $a["title"]; ?></a></p>
					<p class="announcement-category"><?php #echo $a["categoryName"]; ?></p>
				</td>

				<td>
					<p class="announcement-price">US$ <?php echo $a["price"]; ?></p>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

</section>