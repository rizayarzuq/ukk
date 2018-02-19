<!DOCTYPE html>
<html>
<head>
	<title>Data booking pesawat</title>
</head>
<body>
	<h1>Data booking pesawat </h1>
	<table border="1">
		<tr>
			<th>no</th>
			<th>ruteid</th>
			<th>waktu</th>
			<th>dari</th>
			<th>ke </th>
			<th>harga</th>
		</tr>
		<?php foreach($user as $u){ ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->ruteid ?></td>
			<td><?php echo $u->depart_at ?></td>
			<td><?php echo $u->rute_from ?></td>
			<td><?php echo $u->rute_to ?></td>
			<td><?php echo $u->price ?></td>
			<td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>