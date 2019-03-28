<?php require "pages/header.php"; ?>

<section class="card">
	<h1>My Announcements</h1>
	<?php
	$announcements = $database->getAnnouncementsTable();
	$list = $announcements->getUserAnnouncements($database, getUserSession())
	?>
	<a href="create-announcement.php" class="btn btn-success">Create Announcement</a>

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
						<td>
							<img class="thumb" src="assets/images/announcements/<?php echo (isset($announcement['url'])) ? $announcement['url'] : 'default.svg'; ?>">
						</td>
						<td><?php echo $announcement["title"]; ?></td>
						<td><?php echo number_format($announcement["price"]); ?></td>
						<td>
							<a href="edit-announcement.php?id=<?php echo $announcement['id']; ?>" class="btn btn-default">Edit</a>
							<a href="#" class="btn btn-default">Copy</a>
							<a href="delete-announcement.php?id=<?php echo $announcement['id']; ?>" class="btn btn-danger">Delete</a>
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