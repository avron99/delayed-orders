
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this yii\web\View */
$this->title = 'DELAYED ORDERS';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>


</div>
<?php
echo "<table id='tab' class='tablesorter' border='1' width='60%'>";
echo "<thead><tr><th><h3> №  </h3></th><th><h3>ip</h3></th><th><h3>last checked</h3></th><th><h3> total orders </h3></th><th><h3>exported</h3></th><th><h3>delayed orders</h3></th></tr></thead>";
echo "<tbody>";
$i = 1;

foreach ($delayed->collection as $row => $value) {

	echo "<TR>";

	echo "<TD>" . $i++ . "</TD><TD>" . "<a href ='http://support:tErm1n4L@" . $value["ip"] . "/lz.php'>" . $value["ip"] . "</a>" . "</TD><TD>" . $value["last check"] . "</TD> <TD>" . $value['total'] . "</TD><TD>" . $value['exported'] . "</TD><TD>" . $value['delayed'] . "</TD>";
}
echo "</TR>";
echo "</tbody>";
echo "</table>";

?>

