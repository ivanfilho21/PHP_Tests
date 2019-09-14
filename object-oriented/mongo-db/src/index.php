<?php $title = "Sorteios da MegaSena" ?>
<?php require "template-header.php" ?>

<?php
$page = ! empty($_GET["p"]) ? $_GET["p"] : 1;
$qtyPerPage = 25;
$size = DB::count("megasena");

$currentSkip = $page > 1 ? ($page - 1) * $qtyPerPage : 0;
$pageCounter = ($qtyPerPage > 0) ? ceil($size / $qtyPerPage) : 1;

$showLeft = 5; // Max of pages to the left
$showRight = 3; // Max of pages to the right

// echo "Page: " .$page .", skip: " .$currentSkip;
?>
<?php $docs = DB::find("megasena", array(), "Concurso", $currentSkip, $qtyPerPage) ?>

<h1>Sorteios da MegaSena</h1>

<a class="btn btn-primary" href="sorteio.php">Novo Sorteio</a>

<style>
	li {
		white-space: nowrap;
	}
</style>
<?php if ($pageCounter >= 1): ?>
<ul class="pagination float-right">
	<li class="page-item<?= ($page <= 1) ? " disabled" : "" ?>"><a href="?p=<?= ($page <= 1) ? $page : $page -1 ?>" class="page-link">❮ Anterior</a></li>

	<?php for ($i = 0; $i < $pageCounter; $i++): ?>
	<?php if ($i == $showLeft && ($i + 1) <= $pageCounter - $showRight): ?>
	<li class="page-item"><a class="page-link">...</a></li>
	<?php continue ?>
	<?php endif ?>
	<?php if ($i > $showLeft && $i < $pageCounter - $showRight): ?>
	<?php continue ?>
	<?php endif ?>
	<li class="page-item<?= $page == ($i+1) ? " active" : "" ?>"><a class="page-link" href="?p=<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
	<?php endfor ?>
	<li class="page-item<?= ($page >= $pageCounter) ? " disabled" : "" ?>"><a href="?p=<?= ($page >= $pageCounter) ? $page : $page +1 ?>" class="page-link">Próxima ❯</a></li>
</ul>
<?php endif ?>

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