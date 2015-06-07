<div class="page-header">
  <h1>Kontaktformular</h1>
</div>
<?php
    $form = array();
    $form['recipient'] = 'darkvisa@janpetry.com';
    $form['footer'] = 'Diese Nachricht wurde Ihnen via des Kontaktformulares auf der Jugendfeuerwehr Webseite zugestellt. Powered by a <a href="http://janpetry.com" target="_blank">Dark Visa System</a>';

    if(empty($_POST['contact_firstname']) && empty($_POST['contact_name']) && empty($_POST['contact_email']) && empty($_POST['contact_subject']) && empty($_POST['contact_message'])) {

    } elseif(empty($_POST['contact_firstname']) || empty($_POST['contact_name']) || empty($_POST['contact_email']) || !preg_match('/^[\w][\w-.]+@[\w-.]+\.[a-z]{2,4}$/U', $_POST['contact_email']) || empty($_POST['contact_subject']) || empty($_POST['contact_message'])) {
        echo '<div class="error">Die Nachricht konnte nicht verschickt werden, da ungültige oder unvollständige Daten bereitgestellt wurden.</div>';
    }
    else {
        $header = 'From: '.$_POST['name'] . '<' . $_POST['email'] . '>' . "\n"
        . 'Content-Type: text/html' . "\n"
        . 'Content-Transfer-Encoding: 8bit' . "\n";

        mail($form['recipient'], $_POST['contact_subject'], htmlentities($_POST['contact_message']) . '<hr>' . $form['footer'], $header);
        echo '<div class="success">Die Nachricht wurde erfolgreich versandt.</div>';
    }
?>
<div class="alert alert-info">Gegen die Verwendung der Daten steht Ihnen ein Widerspruchsrecht zu, das Sie gegenüber uns jederzeit durch Erklärung/Sendung einer E-Mail an uns ausüben können.

Wir erteilen Ihnen unentgeltlich Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten. Sie können uns jederzeit um die Berichtigung, Löschung und Sperrung Ihrer bei uns gespeicherten personenbezogenen Daten ersuchen. Mehr dazu: <a href="index.php?site=disclaimer">Haftungsausschluss</a><br><br><i>Jugendfeuerwehr Bilsdorf Webmaster Team</i></div>
<br>
<form method="POST" id="form">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Vorname</span>
      <input type="text" class="form-control" placeholder="Max" aria-describedby="sizing-addon2" name="contact_firstname">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Nachname</span>
      <input type="text" class="form-control" placeholder="Mustermann" aria-describedby="sizing-addon2" name="contact_name">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Email</span>
      <input type="text" class="form-control" placeholder="maxmustermann@example.com" aria-describedby="sizing-addon2" name="contact_email">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Betreff</span>
      <input type="text" class="form-control" placeholder="Mein Anliegen" aria-describedby="sizing-addon2" name="contact_name">
    </div>
    <br>
    <textarea class="form-control" name="contact_message" placeholder="Meine Nachricht..."></textarea>
    <br>
    <input type="submit" class="btn btn-success" name="contact_submit" value="Absenden">
</form>
