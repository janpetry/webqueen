<?php
	if(isset($_GET['lang'])) {
	    $lang = $_GET['changeLanguage'];
	    $_SESSION['lang'] = $lang;

	    setcookie('lang', $lang, time() + (3600 * 24 * 30),"/"); 
	} elseif(isset($_SESSION['lang'])) {
	    $lang = $_SESSION['lang'];
	} elseif(isset($_COOKIE['lang'])) {
	    $lang = $_COOKIE['lang'];
	} else {
	    $lang = 'de';
	}

	
	switch($lang) {
	    case 'en':
	        $file = 'en.php';
	    break;
	    case 'de':
	        $file = 'de.php';
	    break;
	    default:
	        $file = '';
	}

	require_once 'lang/'.$file;
