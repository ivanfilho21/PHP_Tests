<?php
require "database.php";

if (isset($_POST["search-pokemon"])) {
	$search = $_POST["search-pokemon"];

	$sql = "SELECT * FROM `pokemon` WHERE `name` LIKE '%" .$search ."%'";
	$res = $pdo->query($sql);
	
	if ($res->rowCount() == 1) {
		$poke[] = $res->fetch();
	} elseif ($res->rowCount() > 1) {
		$poke = $res->fetchAll();
	} else {

	}

	// if (isset($poke)) var_dump($poke);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Resultado da Busca</title>
</head>
<body>
	<?php if (isset($poke)) : ?>
		<table>
			<thead>
				<tr>
					<th>Nº</th>
					<th>Name</th>
					<th>Evolution</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($poke as $p) : ?>
					<tr>
						<td><?php echo $p["id"]; ?></td>
						<td><?php echo $p["name"]; ?></td>
						<td><?php echo $p["evolves_from_id"]; ?></td>
						<td><?php echo $p["description"]; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<h1>No Pokémon was found.</h1>
		<a href="index.php">Go back</a>
	<?php endif; ?>
</body>
</html>