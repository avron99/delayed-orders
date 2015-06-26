<?php
	require_once 'rb.php';
	date_default_timezone_set("Europe/Moscow");
	R::setup( 'pgsql:host=10.0.3.194;dbname=kiosk_srv',
		'kiosk_adm', '@gg3n1n' );
	$connection = pg_connect("host=10.0.3.194 dbname=kiosk_srv user=kiosk_adm password=@gg3n1n");

	if (!$connection)
	{
		echo "Couldn't make a connection!";
	}


	$a=R::getAll( 'SELECT * FROM kiosk_day_log WHERE kiosk_day_log=288' );
	$b=R::find( 'kiosk_day_log', ' kiosk_day_log =288 ' );
	$ppd= 288;

	echo "asdasd";