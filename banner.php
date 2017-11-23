<?php

	/**
 	* flexBanner - innovative interactive banner for your TeamSpeak 3 server.
 	*
 	* 	  ---- [ABOUT THIS APPLICATION] ----
 	*
	* @author : urbanScripts <Filip Urbaniuk>
 	* @version: 1.0.0 beta standard (no paid)
 	* @license: The General Public License (GNU)
 	*
 	* 	  ---- [ABOUT THIS APPLICATION] ----
 	*
 	* Copyright © 2017 by urbansoftware.pl / urbanScripts
 	*/

 	require "libs/ts3admin.class.php"; // Library
 	require "libs/components.php"; // Components
 	require "configs/config.php"; // Configuration file

 	date_default_timezone_set("Europe/Warsaw");
 	ini_set("default_charset", "UTF-8");
 	setlocale(LC_ALL, "UTF-8");
 	error_reporting(E_ALL);

 	$image = imagecreatefrompng($config['banner']['bgPath']);

 	if (file_exists("assets/data/serverInfo.json")) {

 		$mTime = filemtime("assets/data/serverInfo.json");

 		if ($mTime < strtotime("-1 minute")) {

 			$flexTS3 = new ts3admin($config['connection']['host'], $config['connection']['ports']['query']);

 			if ($flexTS3->getElement("success", $flexTS3->connect())) {

 				$flexTS3->selectServer($config['connection']['ports']['voice']);
 				//$flexTS3->selectServer($config['connection']['serverID'], "serverId"); -- Will be functionaly! :)
 				$flexTS3->setName($config['connection']['nickname']);
 				$flexInfo = $flexTS3->serverInfo();

 				$fp = fopen("assets/data/serverInfo.json", "w+");
 				fwrite($fp, json_encode($flexInfo['data']));
 				fclose($fp);

 			}

 		}

 	}

 	$serverInfo = json_decode(file_get_contents("assets/data/serverInfo.json"), true);

 	imagealphablending($image, true);

 	$fonts = [];

 	$fonts['color'] = [

 		'white' => imagecolorallocate($image, 255, 255, 255),

 	];

 	$font = $config['banner']['fontPath'];

 	$usersOnline = $serverInfo['virtualserver_clientsonline'];

 	$usersWithoutQueries = $usersOnline - $serverInfo['virtualserver_queryclientsonline'];

 	$recordOnlineFile = fopen("assets/data/usersRecord.json", "r");
 	$recordNumber = fread($recordOnlineFile, 4);
 	$recordCount = (int)$recordNumber;

 	fclose($recordOnlineFile);

 	if ($recordCount < $usersWithoutQueries) {

 		$recordOnlineFile = fopen("assets/data/usersRecord.json", "w");
 		fputs($recordOnlineFile, $usersWithoutQueries);
 		fclose($recordOnlineFile);

 	}

 	if ($config['banner']['functions']['usersOnline']['status'] == true) {

 		$onlinewithoutQueries = $usersWithoutQueries;
 		$onlinewithQueries    = $usersOnline;

 		if ($config['banner']['functions']['usersOnline']['countQueryClients'] == true) {

 			centeredText($image, $config['banner']['functions']['usersOnline']['onImageSettings']['fontSize'], $config['banner']['functions']['usersOnline']['onImageSettings']['rotation'], $config['banner']['functions']['usersOnline']['onImageSettings']['position']['x'], $config['banner']['functions']['usersOnline']['onImageSettings']['position']['y'], $fonts['color']['white'], $font, $onlinewithQueries);

 		} else {

 			centeredText($image, $config['banner']['functions']['usersOnline']['onImageSettings']['fontSize'], $config['banner']['functions']['usersOnline']['onImageSettings']['rotation'], $config['banner']['functions']['usersOnline']['onImageSettings']['position']['x'], $config['banner']['functions']['usersOnline']['onImageSettings']['position']['y'], $fonts['color']['white'], $font, $onlinewithoutQueries);

 		}

 	} else {}

 	if ($config['banner']['functions']['usersRecord']['status'] == true) {

 		centeredText($image, $config['banner']['functions']['usersRecord']['onImageSettings']['fontSize'], $config['banner']['functions']['usersRecord']['onImageSettings']['rotation'], $config['banner']['functions']['usersRecord']['onImageSettings']['position']['x'], $config['banner']['functions']['usersRecord']['onImageSettings']['position']['y'], $fonts['color']['white'], $font, $recordCount);

 	} else {}

	header("Content-Type: image/png");
	imagepng($image);
	imagedestroy($image);

?>