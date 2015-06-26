<?php
set_time_limit(518400);
require_once 'pingsCounter.php';
date_default_timezone_set("Europe/Moscow");
$pdo = new PDO('pgsql:host=10.0.3.194;port=5432;dbname=kiosk_srv', 'kiosk_adm', '@gg3n1n');
sleep(5);

$handle = fopen("4.csv", "a") or die("oops");
$today = date('Y-m-d');
$stmt = $pdo->prepare("SELECT kiosk.id,region.id AS region_id,shop.work_start,shop.work_end
        FROM region
        LEFT JOIN city ON region.id=city.region_id
        INNER JOIN shop ON city.id=shop.city_id
        INNER JOIN kiosk ON shop.id=kiosk.shop_id

       WHERE kiosk.name NOT LIKE 'X-%'

 			");
$stmt->execute();
$shopWorkTimeById = $stmt->fetchAll(PDO::FETCH_ASSOC);

$kioskIdRegionId = array();
$pingsCreated = array();
$pingsCountDate = array();
foreach ($shopWorkTimeById as $key => $val) {

	list($hours, $minutes, $seconds) = explode(":", $val['work_start']);
	$workStartSec = mktime($hours, $minutes, $seconds);

	list($hours, $minutes, $seconds) = explode(":", $val['work_end']);
	$workEndSec = mktime($hours, $minutes, $seconds);

	$hoursPerDay = ($workEndSec - $workStartSec) / 3600;
	$hoursPerDay = (int) $hoursPerDay;
	if ($hoursPerDay == 0) {
		$hoursPerDay = 24;
	}
	if ($hoursPerDay == 23) {
		$hoursPerDay = 24;
	}
//все эк(1317) с регионом и временем работы в часах
	$kioskIdRegionId[] = array(
		'id' => $val['id'],
		'region_id' => $val['region_id'],
		'hoursPerDay' => $hoursPerDay,
	);
}
//print_r($kioskIdRegionId);echo "<br>";

foreach ($kioskIdRegionId as $reg) {

	if ($reg['region_id'] == '1') {
		$msk[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '2') {
		$spb[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '3') {
		$nn[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '4') {
		$kzn[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '5') {
		$ural[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '6') {
		$ug[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '7') {
		$sib[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '8') {
		$dv[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
	if ($reg['region_id'] == '11') {
		$cr[] = array(
			'id' => $reg['id'],
			'region_id' => $reg['region_id'],
			'hoursPerDay' => $reg['hoursPerDay'],
		);
	}
}

var_dump($spb);
//foreach($msk as $kiosk=>$v)
//{
//
//	$id = $v['id'];
//
//
//	$stmt = $pdo->prepare("SELECT pings_count, created, kiosk_id
//        FROM kiosk_day_log
//               WHERE created>date('2014-01-01')AND kiosk_day_log.created<date('2015-01-01') AND kiosk_id = $id
// 			");
//
//	$stmt->execute();
//	$pingsCountDate  = $stmt->fetchAll(PDO::FETCH_ASSOC);
//	foreach($pingsCountDate as $key2 => $val2)
//	{
//		$pingsCreated = array(
//			'id'=>$val2['kiosk_id'],
//			'pings_count'=>$val2['pings_count'],
//			'created'=>$val2['created']
//		);
//		fputcsv($handle, $pingsCreated,";");
//
//	}
//}
//	 print_r($pingsCountDate);echo "<br>";
//	 die();
//по айдишнику циклом = по каждому id кол во дней за год
//	die();
//	foreach($pingsCreated as $pings){
////			echo $pings['id'] ." ". $pings['pings_count']." ".$pings['created']." <br>";
//		fputcsv($handle, array($pings['id'],$pings['pings_count'],$pings['created']));
//
//	}
fclose($handle);









