<?php
	if(isset($_SESSION['logged'])) {
?>
<div class="page-header">
  <h1>Backend <small><i class="fa fa-dashboard fa-1" style="padding-right: 3px; padding-left: 3px;"></i> Dashboard</small></h1>
</div>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Acess granted to jfw-bilsdorf.de's Admin Control Panel
</div>
<ul class="nav nav-pills nav-stacked">
	<li><a href="index.php?site=newmember"><i class="fa fa-user-plus fa-1" style="padding-right: 3px;"></i> Neues Jugendfeuerwehr Mitglied hinzuf&uuml;gen</a></li>
	<li><a href="index.php?site=deletemember"><i class="fa fa-user-times fa-1" style="padding-right: 3px;"></i> Jugendfeuerwehr Mitglied entfernen</a></li>
	<li><a href="index.php?site=newbetreuer"><i class="fa fa-user-plus fa-1" style="padding-right: 3px;"></i> Neuen Jugendfeuerwehr Betreuer hinzuf&uuml;gen</a></li>
	<li><a href="index.php?site=deletebetreuer"><i class="fa fa-user-times fa-1" style="padding-right: 3px;"></i> Jugendfeuerwehr Betreuer entfernen</a></li>
	<li><a href="index.php?site=newadmin"><i class="fa fa-eye fa-1" style="padding-right: 3px;"></i> Neuen Login Administrator registrieren</a></li>
	<li><a href="index.php?site=deleteadmin"><i class="fa fa-eye-slash fa-1" style="padding-right: 3px;"></i> Login Administrator l&ouml;schen</a></li>
	<li><a href="index.php?site=newarticle"><i class="fa fa-bullhorn fa-1" style="padding-right: 3px;"></i> Neuigkeitenartikel verfassen</a></li>
	<li><a href="index.php?site=deletearticle"><i class="fa fa-trash fa-1" style="padding-right: 3px;"></i> Neuigkeitenartikel entfernen</a></li>
	<li><a href="https://web1.php-friends.de/"><i class="fa fa-database fa-1" style="padding-right: 3px;"></i> Datenbankverwaltung mit PhpMyAdmin</a></li>
	<li><a href="https://pf-control.de/froxlor/"><i class="fa fa-cog fa-spin" style="padding-right: 3px;"></i> Pf-Control Froxlor Panel</a></li>
</ul>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
