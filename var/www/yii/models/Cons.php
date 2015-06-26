<?php


	namespace app\models;

	use yii\base\Model;

	class Cons extends Model{

		public $ip;
		public $except_ip;
		public $port;
		public $dir;
		public $url;
		public $command;


	public function rules()
	{
		return [
			// username and password are both required
			[['ip', 'except_ip'], 'required']

		];

	}
	}