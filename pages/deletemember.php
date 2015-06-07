<?php
	if(isset($_SESSION['logged'])) {
?>
<?php 
	if(isset($_POST['post2'])) {
		$firefighters->deleteYouthFirefighterMember($_POST['selectedid2']);
	}		
?>
<div class="page-header">
  <h1>Jugendmitglied löschen</h1>
</div>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Achtung!</strong> Achte auf die Groß- und Kleinschreibung.
</div>
	<form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-trash fa-fw"></i></span>
          <input type="text" name="selectedid2" class="form-control" placeholder="Name des zu löschenden Jugendmitgliedes">
        </div>
		<br /><br />
		<input type="submit" value="Löschen" class="btn btn-success" />
		<input type="hidden" name="post2" />
	</form>
	<br />
	<i class="fa fa-dashboard fa-1" style="padding-right: 3px;"></i> <a href="?site=admin&start">Zur&uuml;ck zum Dashboard</a>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
