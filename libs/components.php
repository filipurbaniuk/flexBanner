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

 	# --- flexBanner's functions ---

 	function formatSeconds ($seconds) {

 		$formating = []; // Table here.

 		$formating['days'] = floor($seconds / 86400);
 		$formating['hours'] = floor(($seconds - ($formating['days'] * 86400)) / 3600);
 		$formating['minutes'] = floor(($seconds - (($formating['days'] * 86400) + ($formating['hours'] * 3600))) / 60);
 		$formating['seconds'] = floor(($seconds - (($formating['days'] * 86400) + ($formating['hours'] * 3600) + ($formating['minutes'] * 60))));

 		$formatingText = "";

 		if ($formating['days'] > 0) {

 			$formatingText .= $formating['days'] . " " . ($formating['days'] == 1 ? "dnia " : "dni ");

 		}

 		if ($formating['hours'] > 0) {

 			$formatingText .= $formating['hours'] . " " . ($formating['hours'] == 1 ? "godziny " : "godzin ");

 		}

		if ($formating['minutes'] > 0) {

 			$formatingText .= $formating['minutes'] . " " . ($formating['minutes'] == 1 ? "minuty " : "minut ");

 		}

 		if ($formatingText == "") {

 			$formatingText .= $formating['seconds'] . " sekund";

 		}

 		return $formatingText;

 	}

 	function centeredText (&$im, $size, $angle, $x, $y, $color, $fontfile, $text) {

		$bbox = imagettfbbox($size, $angle, $fontfile, $text);

		$dx = ($bbox[2] - $bbox[0]) / 2.0 - ($bbox[2] - $bbox[4]) / 2.0;
		$dy = ($bbox[3] - $bbox[1]) / 2.0 + ($bbox[7] - $bbox[1]) / 2.0;

		$px = $x - $dx;
		$py = $y - $dy;

		return imagettftext($im, $size, $angle, $px, $py, $color, $fontfile, $text);

 	}

 	# --- ts3admin's functions ---

 	function Data (array $ts3output) {

 		return $ts3output['data'];

 	}

 	function Success (array $ts3output) {

 		return $ts3output['success'];

 	}

 	function Failure (array $ts3output) {

 		return !($ts3output['success']);

 	}

?>