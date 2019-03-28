<?php require "pages/header.php"; ?>

<section class="card">
	<h1>My Announcements</h1>
	<?php
	$announcements = $database->getAnnouncementsTable();
	$list = $announcements->getUserAnnouncements($database, getUserSession())
	?>
	<a href="create-announcement.php" class="btn btn-default">Create Announcement</a>

	<?php if (count($list) > 0) : ?>
		<table class="table table-stripped table-center">
			<thead>
				<tr>
					<th>Picture</th>
					<th>Title</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php #var_dump($list); ?>
				<?php foreach ($list as $announcement) : ?>
					<tr>
						<td><img src="assets/images/announcements/<?php echo $announcement['url']; ?>"></td>
						<td><?php echo $announcement["title"]; ?></td>
						<td><?php echo number_format($announcement["price"]); ?></td>
						<td>
							<a href="#">Edit</a>
							<a href="#">Delete</a>
							<a href="#">Copy</a>
						</td>
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