<!DOCTYPE html>
<html>
<head>
<title>Input data</title>
</head>
<body>
<center>
<h1>input data</h1>
<h3>Tambah data baru</h3>
</center>
<form action="<?php echo base_url(). 'crud/tambah_aksi'; ?>" method="post">
<table style="margin:20px auto;">
<tr>
<td>costumer</td>
<td><input type="text" name="costumer"></td>
</tr>
<td>reservation</td>
<td><input type="text" name="reservation"></td>
</tr>
<tr>
<td>rute</td>
<td><input type="text" name="rute"></td>
</tr>
<tr>
<td>transportation</td>
<td><input type="text" name="transportation"></td>
</tr>
<tr>
<td>transport_type</td>
<td><input type="text" name="transport_type"></td>
</tr>
<td>user</td>
<td><input type="text" name="user"></td>
</tr>
<td></td>
<td><input type="submit" value="Tambah"></td>
</tr>
</table>
</form>	
</body>
</html>