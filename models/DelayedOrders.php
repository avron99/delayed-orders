<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\mongodb\Query;
use yii\mongodb\Collection;

class DelayedOrders extends Model
{
	public $rows;
	public $collection;

	public function getOrders()
	{
		$query = new Query;

		$query->select([])
				->from('order');
		$rows = $query->all();
		return $rows;
	}

	public function updateOrders($array, $arr, $opt)
	{
		$collection = Yii::$app->mongodb->getCollection('order');
		$collection->update($array, $arr, $opt);
		
	}
	
}