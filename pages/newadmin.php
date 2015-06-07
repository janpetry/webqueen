<?php
	if(isset($_SESSION['logged'])) {
?>
<?php 
	if(isset($_POST['post5'])) {
		$system->addUser($_POST['username'], hash('sha256', $_POST['pw']));
	}
?>
<div class="page-header">
  <h1>Systemadministrator registrieren</h1>
</div>
	<form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
		<br />
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
          <input class="form-control" name="pw" type="password" placeholder="Password">
        </div>
		<br />
		<input type="submit" value="Registrieren" class="btn btn-success" />
		<input type="hidden" name="post5" />
	</form>
	<br />
	<i class="fa fa-dashboard fa-1" style="padding-right: 3px;"></i> <a href="?site=admin&start">Zur&uuml;ck zum Dashboard</a>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
