<?php

require "../vendor/autoload.php";
use MongoDB\Client as MongoDB;

$conn = new MongoDB("mongodb://localhost:27017");

$db = $conn->test;
$megasena = $db->megasena;
$docs = $megasena->find();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Teste com MongoDB</title>
	<style>
		body {
			background: #333;
			color: #eee;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		thead {
			background: #555;
		}

		th {
			padding: 0.5rem 0;
		}

		td {
			padding: 0.5rem 0;
			text-align: center;
			background-color: #666;
		}
	</style>
</head>
<body>
	<h1>Teste PHP e MongoDB</h1>

	<h4>Database: <?= $megasena->getDatabaseName() ?></h4>
	<h4>Collection: <?= $megasena->getCollectionName() ?></h4>
	<h4>Nº of Docs: <?= $megasena->count() ?></h4>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>#</th>
				<th>Acumulou</th>
				<th>Data</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($docs as $doc): ?>
			<?php if (empty($doc["Concurso"])) continue ?>
			<tr>
				<td><?= substr($doc["_id"], -9) ?></td>
				<td><?= $doc["Concurso"] ?></td>
				<td><?= $doc["Acumulado"] ?></td>
				<td><?= $doc["Data Sorteio"] ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>