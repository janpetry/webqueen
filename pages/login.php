<div class="page-header">
  <h1>Admin Control Panel</h1>
</div>
    <?php
        if(isset($_POST['post'])) {
			
            if($_POST['username'] != "" && $_POST['password'] != "") {
                $system->Login($_POST['username'], hash('sha256', $_POST['password']));
            }
        }
    
    ?>
    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Achtung!</strong> Du benötigst einen Administrator Account um diesen Bereich zu betreten. Bitte melde dich an. <i class="fa fa-spinner fa-spin" style="padding-left: 3px;"></i>
    </div>
    <form method="post">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <br />
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
          <input class="form-control" name="password" type="password" placeholder="Password">
        </div>
        <br />
        <input type="submit" value="Anmelden" class="btn btn-success" />
        <input type="hidden" name="post" />
    </form>
