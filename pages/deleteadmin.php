<?php
	if(isset($_SESSION['logged'])) {
?>
<?php 
	if(isset($_POST['post_8'])) {
		  $system->deleteUser($_POST['selecteduser']);
	}
?>
<div class="page-header">
  <h1>Login Administratoren löschen</h1>
</div>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Achtung!</strong> Achte auf die Groß- und Kleinschreibung. Wurde ein Account einmal gelöscht so kann er nicht wiederhergestellt werden!
</div>
	<form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
          <input type="text" name="selecteduser" class="form-control" placeholder="Nutzername des zu löschenden Administratoren">
        </div>
		<br>
		<input type="submit" value="Löschen" class="btn btn-warning" />
		<input type="hidden" name="post8" />
	</form>
	<br />
	<i class="fa fa-dashboard fa-1" style="padding-right: 3px;"></i> <a href="?site=admin&start">Zur&uuml;ck zum Dashboard</a>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
