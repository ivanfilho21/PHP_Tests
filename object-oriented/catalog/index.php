<?php require "pages/header.php"; ?>
<?php $announcements = $database->getAnnouncementsTable(); ?>
<?php $users = $database->getUsersTable(); ?>
<?php $totalAnnouncements = count($announcements->getAll()); ?>
<?php $totalUsers = count($users->getAll()); ?>

	<section class="card">
		<h1>We now have <?php echo $totalAnnouncements; ?>  advertisement<?php echo ($totalAnnouncements > 1) ? "s" : ""; ?></h1>
		<h3>And <?php echo $totalUsers; ?> registered user<?php echo ($totalUsers > 1) ? "s" : ""; ?></h3>
	</section>

	<section class="card">
		<h3>Advanced Search</h3>
	</section>

	<section class="card">
		<h3>Newest Announcements</h3>
		<?php foreach ($announcements->getLatest($database, 5) as $a) : ?>
			<table>
				<tbody>
					<tr>
						<td>
							<?php echo $a["categoryName"]; ?>
						</td>
						<td>
							<img class="thumb" src="<?php echo ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($a['url'])) ? $a['url'] : 'default.svg'; ?>">
						</td>
						<td>
							<?php echo $a["title"]; ?>
						</td>
						<td>
							<?php echo $a["price"]; ?>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endforeach; ?>
	</section>

<?php require "pages/footer.php"; ?>