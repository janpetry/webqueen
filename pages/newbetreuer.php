<?php
	if(isset($_SESSION['logged'])) {
?>
<?php 
	if(isset($_POST['post3'])) {
		$firefighters->addYouthLeader($_POST['username'], $_POST['rang']);
	}
?>
<div class="page-header">
  <h1>Betreuer hinzufügen</h1>
</div>
	<form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Name">
        </div>
		<br />
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-bookmark fa-fw"></i></span>
			<input type="text" name="rang" class="form-control" placeholder="Dienstgrad" />
        </div>
		<br /><br />
<?php

	$i = 1;
	
	foreach($firefighters->getAllBadges2() as $badge) {
		echo '<input type="checkbox" name="badge_check_'.$i.'" />
			  <img src="'.$badge['link'].'" alt="'.$badge['name'].'" />
			 <input type="hidden" name="sum" readonly="readonly" value="'.$i++.'" /> ';
	}
?>
		<br /><br />
		<input type="submit" value="Speichern" class="btn btn-success" />
		<input type="hidden" name="post3" />
	</form>
	<br />
	<i class="fa fa-dashboard fa-1" style="padding-right: 3px;"></i> <a href="?site=admin&start">Zur&uuml;ck zum Dashboard</a>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
