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

 	$config = [

 		# Connection configuration table - start

 		'connection' => [ // Data for connection

 			'host' 	   => "164.132.145.6", // The IP address or hostname (ex. hostname: testonedwothree.com) or (ex. address: localhost / 127.0.0.1).
 			'ports'    => ['voice' => 9987, 'query' => 10011], // The UDP (voice port) of TS3 server and TCP (query port) of Guest Server Query.
 			'nickname' => "urApps @ Banner" // If the app connects, then we can make it easier by changing the nickname that the application is enabled. (ex. nickname: urApps @ Banner)

 		],

 		# Connection configuration table - end


 		# Banner configuration table - start

 		'banner' => [ // Configuration of banner

 			'bgPath'    => "assets/images/background.png", // The path of the background image.
 			'fontPath'  => "assets/fonts/uniSans_regular.ttf", // The path of the font.

 			'functions' => [ // The functions configuration.

 				'usersOnline' => [ // Server users counter.
 					'status' => true, // true - function is enabled, false - function is disabled. easy.
 					'countQueryClients' => false, // Adding the count of query clients, if you wanna a real users online count, disable it him (write false.)
 					'onImageSettings' => [ // On the image settings
 						'position' => ['x' => 67, 'y' => 140], // Position of counter
 						'rotation' => 0, // Rotation of counter
 						'fontSize' => 44 // The font size of users online counter.
 					]
 				],

 				'usersRecord' => [ // Server users record counter.
 					'status' => true, // true - function is enabled, false - function is disabled. easy.
  					'onImageSettings' => [ // On the image settings
 						'position' => ['x' => 895, 'y' => 140], // Position of counter
 						'rotation' => 0, // Rotation of counter
 						'fontSize' => 44 // The font size of users record online counter.
 					]
 				]

 			]

 		]

 		# Banner configuration table - end

 	];

?>