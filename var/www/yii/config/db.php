
	<?php


		return [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=yii',
			'username' => 'yii',
			'password' => '',
			'charset' => 'utf8',

					'db' => [
						'class' => '\yii\mongodb\Connection',
						'dsn' => 'mongodb://127.0.0.1:27017/test',
						'defaultDatabaseName'=>'test',
						'options'=>['socketTimeoutMS' => 1000000]
					],



		];