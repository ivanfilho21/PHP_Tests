<?php $title = "Sorteios da MegaSena" ?>
<?php require "template-header.php" ?>

<?php $docs = DB::find("megasena", array(), "Concurso", 0, 13) ?>

<h1>Sorteios da MegaSena</h1>

<a class="btn btn-primary" href="sorteio.php">Novo Sorteio</a>

<table class="table table-light table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>#</th>
			<th>Acumulou</th>
			<th>Data</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($docs as $doc): ?>
		<?php if (empty($doc["Concurso"])) continue ?>
		<tr>
			<td><?= substr($doc["_id"], -9) ?></td>
			<td><?= $doc["Concurso"] ?></td>
			<td><?= mb_strtolower($doc["Acumulado"]) ?></td>
			<td><?= $doc["Data Sorteio"] ?></td>

			<td>
				<a class="btn btn-info" href="view.php?id=<?= $doc["_id"] ?>">View</a>
				<a class="btn btn-warning" href="sorteio.php?id=<?= $doc["_id"] ?>">Edit</a>
				<a class="btn btn-danger" href="delete.php?id=<?= $doc["_id"] ?>">Delete</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php require "template-footer.php" ?>