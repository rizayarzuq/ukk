<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Show All Flight</title>
	<style type="text/css">
		td {
			padding: 10px 20px;
		}
		th {
			padding: 5px 10px;
		}
	</style>
</head>
<body>
	<center><h1>data booking tiket</h1></center>
	<table style="margin:20px auto;" border="1">
		<tr>
			<th>no</th>
			<th>rute id</th>
			<th>Waktu</th>
			<th>Dari</th>
			<th>Ke</th>
			<th>Harga</th>
			<th>Action</th>
		</tr>
		<?php 
		$no = 1;
		foreach($user as $u){ 
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->ruteid ?></td>
			<td><?php echo $u->depart_at ?></td>
			<td><?php echo $u->rute_from ?></td>
			<td><?php echo $u->rute_to ?></td>
			<td><?php echo $u->price ?></td>
			<td>
					<a style="cursor: pointer;" onclick="href='<?php echo base_url(('crud/edit_rute/'. $u->ruteid)); ?>'">Edit</a>
					<a style="cursor: pointer;" onclick="href='<?php echo base_url(('crud/hapus/'. $u->ruteid)); ?>'">Remove</a>
				</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>