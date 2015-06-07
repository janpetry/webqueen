<?php
/***********
 **** @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License (GPL)
 **** @author Jan Petry
 ***********/
//////////////////////////////////////////////////////////////////////////////////////////////////
/// PHP Einstellungen ////////////////////////////////////////////////////////////////////////////
	ini_set('display_errors', TRUE);
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	date_default_timezone_set('Europe/Berlin');
	setlocale (LC_ALL, 'de_utf8');

	$config = array();
//////////////////////////////////////////////////////////////////////////////////////////////////
/// Datenbank ////////////////////////////////////////////////////////////////////////////////////
	$config['db_authentication'] = array(
		'host' => '127.0.0.1',							// Host des Datenbankservers
		'user' => 'darkvisasql1',						// Username zum Login
		'pass' => 'bilsdorf123',							// Passwort zum Login
		'name' => 'darkvisasql1',						// Name der Datenbank selbst
	);
	
	try {
	    // Generate a database connection, using the PDO connector
	    // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
	    // Also important: We include the charset, as leaving it out seems to be a security issue:
	    // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
		$config['dbconnect'] = new PDO('mysql:host='.$config['db_authentication']['host'].';dbname='.$config['db_authentication']['name'].'', $config['db_authentication']['user'], $config['db_authentication']['pass'] );    
	} catch(PDOException $e) {
		echo 'Exception abgefangen: ', $e->getMessage(), "\n";
	}
//////////////////////////////////////////////////////////////////////////////////////////////////
/// Allgemeine Angaben ///////////////////////////////////////////////////////////////////////////
    $config['site']['title'] = "Jugendfeuerwehr Bilsdorf";								// Titel der Webseite
	$config['snow'] = FALSE;															// Schneefall auf der Seite? Wenn ja = true sonst false
//////////////////////////////////////////////////////////////////////////////////////////////////
/// Basic Page Needs //////////////////////////////////////////////////////////////////////////////
	$config['google'] = 'notranslate';
	$config['author'] = 'Jan Petry';
	$config['classification'] = 'HTML5';
	$config['copyright'] = '2013 -'. date('Y').' (c) Jan Petry';
	$config['downloadoptions'] = 'noopen';
	$config['generator'] = 'Sublime Text 2';
	$config['resource-type'] = 'document';
	$config['google-bot'] = '1 day';
	$config['robots'] = 'index, follow';
	$config['web_seo_description'] = 'Die Jugendfeuerwehr Bilsdorf - Gemeinde Nalbach. Die Lebensretter von morgen, sie werden 365 Tage im Jahr für sie da sein, um Ihnen bei Notlagen (fast) aller Art zu helfen.';
	$config['web_seo_tags'] = 'Feuerwehr, Jugendfeuerwehr, Nalbach, Bilsdorf, Notfallrettung, Rettung, Brandbekämpfung, Rettungsdienst, jfw-bilsdorf.de, jfwbilsdorf';
//////////////////////////////////////////////////////////////////////////////////////////////////
/// Verification /////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
/// Impressum ////////////////////////////////////////////////////////////////////////////////////
	$config['web_owner_name'] = 'Gemeinde Nalbach<br />Bürgermeister<br />Peter Lehnert';	// Vor- und Zuname
	$config['web_owner_street'] = 'Rathausplatz 1';											// Straße + Hausnummer
	$config['web_owner_residence'] = '66809 Nalbach';						// PLZ + Wohnort
	$config['web_owner_tel'] = '06838 / 9002-0';											// Telefonnummer
	$config['web_owner_fax'] = '06838 / 9002-700';											// Faxnummer
	$config['web_owner_mail'] = 'info@jfwbilsdorf.de';										// E-Mail des Besitzers
//////////////////////////////////////////////////////////////////////////////////////////////////
/// Credits //////////////////////////////////////////////////////////////////////////////////////
	$config['web_footer_credits'] = array(									
		'jp' => 'http://janpetry.com',												// Website / CMS Prototype Programmer Jan Petry
	);								
//////////////////////////////////////////////////////////////////////////////////////////////////
// Websitespezifisches ///////////////////////////////////////////////////////////////////////////
	$config['web_allowed_sites'] = array(
		#'SITE',
		#'ALIAS' => 'SITE',
		'admin',
			'acp' => 'admin',
			'my-accounts' => 'admin',
			'panel' => 'admin',
		'contact',
			'contactform' => 'contact',
			'kontakt' => 'contact',
			'contact' => 'contact',
		'disclaimer',
			'haftungsauschluss' => 'disclaimer',
			'disclaim' => 'disclaimer',
			'disclaimerjfw' => 'disclaimer',
		'login',
			'cp' => 'login',
			'control-panel' => 'login',
			'loggingin' => 'login',
		'news',
			'neuigkeiten' => 'news',
			'neues' => 'news',
			'neu' => 'news',
		'team',
			'staff' => 'team',
			'members' => 'team',
			'mitglieder' => 'team',
		'uebungen',
			'uebungsplan' => 'uebungen',
			'termine' => 'uebungen',
			'kalender' => 'uebungen',
		'imprint',
			'impressum' => 'imprint',
			'impress' => 'imprint',
			'besitzer' => 'imprint',
		'jobs',
			'wiewerdeichmitglied' => 'jobs',
			'mitgliedwerden' => 'jobs',
			'beitreten' => 'jobs',
		'weblinks',
			'links' => 'weblinks',
			'linked-sites' => 'weblinks',
			'andere' => 'weblinks',
		'phpinfo', 'disclaimer',
		
		# Adminpanel Sites
		'newarticle', 
		'deletearticle', 
		
		'newmember', 
		'deletemember', 
		
		'newbetreuer', 
		'deletebetreuer', 
		
		'newadmin', 
		'deleteadmin'
    );
