<h1><?php echo $name; ?></h1>

<a href="<?php echo BASE_URL .$url .'/'; ?>create">Add a <?php echo substr($name, 0, -1); ?></a>

<table class="table stripped-table">
	<thead>
		<tr>
			<?php foreach ($columns as $col) : ?>
				<th><?php echo ucfirst($col->getName()); ?></th>
			<?php endforeach; ?>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($list as $obj) : ?>
			<tr>
				<?php foreach ($columns as $col) : ?>
					<td><?php echo $obj[$col->getName()]; ?></td>
				<?php endforeach; ?>

				<td>
					<a href="<?php echo BASE_URL .$url .'/'; ?>edit/<?php echo $obj['id']; ?>">Edit</a>
					<a href="<?php echo BASE_URL .$url .'/'; ?>delete/<?php echo $obj['id']; ?>">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>