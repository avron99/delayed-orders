<?php


	namespace app\models;

	use Yii;
	use yii\base\Model;

	class Mongo extends Model{
		public $connection;
		public $collection;
		public $query;
		public $rows;
		public function rules()
		{
			return [
				// are both required
				[
				'collection','query'
				]


			];

		}
	}
