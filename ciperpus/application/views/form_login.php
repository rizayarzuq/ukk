<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assetgua/bstrp/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assetgua/bstrp/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assetgua/bstrp/css/bootstrap-theme.css') ?>" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login ciperpus</title>
</head>
<body>
<center><h1>Selamat Datang di Website "ciperpus" <br>
            Silahkan masuk atau mendaftar terlebih dahulu</h1></center>
<div class="container"  style="margin-top:50px;">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-body">
<?php echo form_open("login/login_process"); ?>
	<?php echo $error; ?>
    <h2><center>Login Disini</center></h2>
	<div class="form-group">
        <?php
        echo form_label('Username','username');
        echo form_input('username','','class="form-control" id="username" placeholder="Nama Pengguna" required')
        ?>
        </div>
        <div class="form-group">
        <?php
        echo form_label('Password','password');
        echo form_password('password','','class="form-control" id="password" placeholder="Kata Sandi" required')
        ?>
        </div>
       	<?php echo form_submit('login', 'Login', 'class="btn btn-primary"') ?>
       	<a href="<?php echo site_url('login/register') ?>" class="btn btn-link">Sign Up</a>
        <?php echo form_close() ?>
	<?php echo form_close(); ?>
	</div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>

    </div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('assetgua/bstrp/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assetgua/bstrp/js/jquery.js') ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assetgua/bstrp/js/bootstrap.min.js') ?>"></script>
</body>
</html>