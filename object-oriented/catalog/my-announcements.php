<?php require "pages/header.php"; ?>
<?php checkUserPermissionToPage(); ?>

<section class="card">
	<h1>My Announcements</h1>
	<?php
	$announcements = $database->getAnnouncementsTable();
	$list = $announcements->getAll(getUserSession(), $database);
	?>
	<a href="announcement.php" class="btn btn-success">Create Announcement</a>

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
							<img class="thumb" src="<?php echo ANNOUNCEMENT_PICTURES_DIR ."/"; echo (isset($announcement['url'])) ? $announcement['url'] : 'default.svg'; ?>">
						</td>
						<td>
							<a href="announcement-view.php?id=<?php echo $announcement['id']; ?>"><?php echo $announcement["title"]; ?></a>
						</td>
						<td><?php echo number_format($announcement["price"]); ?></td>
						<td>
							<a href="announcement.php?id=<?php echo $announcement['id']; ?>" class="btn btn-default">Edit</a>
							<a href="delete-announcement.php?id=<?php echo $announcement['id']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-warning">
			You don't have any announcements yet. <a href="announcement.php">Create your first</a>.
		</div>
	<?php endif; ?>
</section>

<?php require "pages/footer.php"; ?>