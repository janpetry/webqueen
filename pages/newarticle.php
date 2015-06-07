<?php
	if(isset($_SESSION['logged'])) {
?>
<?php 
	if(isset($_POST['post6'])) {
		$system->addArticle($_POST['title'], $_POST['text'], $_POST['date']);
	}
?>
<div class="page-header">
  <h1>Artikel verfassen</h1>
</div>
	<form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-bullhorn fa-fw"></i></span>
          <input type="text" name="title" class="form-control" placeholder="Überschrift">
        </div>
		<br />
			<textarea name="text" id="writenews" style="width: 500px; height: 300px;"></textarea>
		<br />
		<br />
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
			<input type="date" name="date" class="date" class="form-control" placeholder=" Datum" />
		</div>
		<br />
		<input type="submit" value="Absenden" class="btn btn-success" />
		<input type="hidden" name="post6" />
		<br />
		<br />
	</form>
	<br />
	<i class="fa fa-dashboard fa-1" style="padding-right: 3px;"></i> <a href="?site=admin&start">Zur&uuml;ck zum Dashboard</a>
<?php
	} else {
		echo $system->errors[] = ERROR_ACCESS_DENIED;
		print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
	}
?>
