<?php $title = "Sorteios da MegaSena" ?>
<?php require "template-header.php" ?>

<?php

$db = $conn->test;
$megasena = $db->megasena;
$docs = $megasena->find();
?>

<h1>Sorteios da MegaSena</h1>
<h4>Quantidade: <?= $megasena->count() ?></h4>

<a class="btn btn-primary" href="create.php">Novo Sorteio</a>

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
				<a class="btn btn-info" href="view.php?<?= $doc["_id"] ?>">View</a>
				<a class="btn btn-warning" href="edit.php?<?= $doc["_id"] ?>">Edit</a>
				<a class="btn btn-danger" href="delete.php?<?= $doc["_id"] ?>">Delete</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php require "template-footer.php" ?>