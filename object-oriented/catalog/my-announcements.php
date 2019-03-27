<?php require "pages/header.php"; ?>

<section class="card">
	<h1>My Announcements</h1>
	<?php
	$announcements = $database->getAnnouncementsTable();
	$list = $announcements->getUserAnnouncements(getUserSession())
	?>
	<a href="create-announcement.php" class="btn btn-default">Create Announcement</a>

	<?php if (count($list) > 0) : ?>
		<table class="table table-stripped">
			<thead>
				<tr>
					<th>Picture</th>
					<th>Title</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $announcement) : ?>
					<tr>
						<td><img src="assets/images/announcements/<?php echo $announcement['url']; ?>"></td>
						<td><?php echo $announcement->getTitle(); ?></td>
						<td><?php echo number_format($announcement->getPrice()); ?></td>
						<td></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-warning">
			You don't have any announcements yet. <a href="create-announcement.php">Create your first</a>.
		</div>
	<?php endif; ?>
</section>

<?php require "pages/footer.php"; ?>