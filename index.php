<?php
    session_start();
    require_once('inc/config.php');
    require_once("lang/de.php");
    require_once("inc/classes/system.php");
    $system = new System($config);
    require_once("inc/classes/firefighters.php");
    $firefighters = new FireFighters($config);
    require_once("inc/classes/navigation.php");
    $nav = new Navigation;
?>
<!DOCTYPE html>
                    <html lang="DE-de">
                        <head>
                            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

                            <meta name="keywords" content="<?php echo $config['web_seo_tags']; ?>"/>
                            <meta name="google" content="<?php echo $config['google']; ?>" />
                            <meta name="author" content="<?php echo $config['author']; ?>" />
                            <meta name="classification" content="<?php echo $config['classification']; ?>" />
                            <meta name="copyright" content="<?php echo $config['copyright']; ?>" />
                            <meta name="description" content="<?php echo $config['web_seo_description']; ?>"/>
                            <meta name="DownloadOptions" content="<?php echo $config['downloadoptions']; ?>" />
                            <meta name="generator" content="<?php echo $config['generator']; ?>" />
                            <meta name="resource-type" content="<?php echo $config['resource-type']; ?>" />
                            <meta name="revisit-after" content="<?php echo $config['google-bot']; ?>" />
                            <meta name="robots" content="<?php echo $config['robots']; ?>" />
                            
                            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                            
                            <link rel="shortcut icon" href="img/favicon.png" type="image/png" />

                            <!-- Latest compiled and minified CSS -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
                            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

                            <!-- Optional theme -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

                            <!-- Latest compiled and minified JavaScript -->
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                            <script src="js/functions.js" type="application/javascript"></script>              
                            <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
                            <script>
                                tinymce.init({selector:'textarea#writenews'});

                                $(function () {
                                  $('[data-toggle="tooltip"]').tooltip()
                                })
                            </script>
                            
                            <!--[if lt IE 9]>
                                <script src="js/html5shiv.js"></script>
                            <![endif]-->

                            <style>
                            /* Bootstrap Skeleton Edits */
                                a {
                                    color: #d9534f;
                                }
                                a:hover {
                                    color: #922121;
                                }
                            </style>
        
                            <title><?php echo $config['site']['title']; ?></title>
                        </head>
                        <body>       
                            <div class="container">
                                <div class="header">
                                    <a href="index.php"><img src="img/logo.png" alt="Jugendfeuerwehr Bilsdorf" /></a>
                                </div>

                                <ul class="nav nav-tabs">
                                    <?php 
                                        $nav->link('news', '','Gehe auf unsere Startseite', 'Startseite', 0);
                                        $nav->link('uebungen', '','Hier findest du unseren Übungsplan', '&Uuml;bungsplan', 0);
                                        $nav->link('team', '','Unser Team', 'Mannschaft', 0);
                                        $nav->link('jobs', '','Werde Mitglied der Jugendfeuerwehr Bilsdorf', 'Werde Mitglied!', 0);
                                        $nav->link('weblinks', '','Weblinks zu anderen wichtigen Seiten', 'Weblinks', 0);
                                        $nav->link('imprint', '','Angaben gemäß §5 TMG', 'Impressum', 0);
                                        if(isset($_SESSION['logged'])) {
                                            $nav->link('admin', 'start','Hier gelangst du ins Backend', 'Backend', 0);
                                            $nav->link('admin', 'logout','Hier kannst du dich ausloggen', '<i class="fa fa-sign-out" style="padding-right: 3px;"></i> Sign Out', 0);
                                        } else {
                                            $nav->link('login', '','Hier kannst du dich einloggen', '<i class="fa fa-sign-in" style="padding-right: 3px;"></i> Sign In', 0);
                                        }
                                    ?>
                                </ul>              

                                <hr class="featurette-divider">

                                <ol class="breadcrumb">
                                  <li class="active"><?php echo $system->breadcrumbs(); ?></li>
                                </ol>
                                
                                <hr class="featurette-divider">

                                <div class="panel panel-default">
                                  <div class="panel-body">
                                        <?php
                                            if(!empty($_GET['site'])) {
                                                $_GET['site'] = preg_replace('/[^A-Za-z0-9\-äöüß]/', '', $_GET['site']);
                                                if(
                                                    // Direkter Aufruf durch SITE-Parameters
                                                    in_array($_GET['site'], $config['web_allowed_sites']) &&
                                                    file_exists('pages/' . $_GET['site'] . '.php')
                                                    OR
                                                    in_array($_SESSION['logged']) &&
                                                    file_exists('pages/' . $_GET['site'] . '.php')
                                                ) {
                                                    require_once('pages/' . $_GET['site'] . '.php');
                                                }
                                                elseif(
                                                    // Indirekter Aufruf einer Seite über einen Alias
                                                    array_key_exists($_GET['site'], $config['web_allowed_sites']) &&
                                                    file_exists('pages/' . $config['web_allowed_sites'][$_GET['site']] . '.php')
                                                    OR
                                                    in_array($_SESSION['logged']) &&
                                                    file_exists('pages/' . $config['web_allowed_sites'][$_GET['site']] . '.php')
                                                ) {
                                                    require_once('pages/' . $config['web_allowed_sites'][$_GET['site']] . '.php');
                                                }
                                                else {
                                                    require_once('pages/news.php');
                                                }
                                            }
                                            else {
                                                require_once('pages/news.php');
                                            }
                                        ?>
                                  </div>
                                  <div class="panel-footer">&copy; 2013 - <?php echo date('Y'); ?> by Jugendfeuerwehr Bilsdorf.<br/>
                                        Handcrafted with love in Germany by <?php echo '<a href="' . $config['web_footer_credits']['jp'] .'">Dark Visa Studios</a>'; ?><br>
                                  </div>
                                </div>
                            </div>
                        </body>
                    </html>
