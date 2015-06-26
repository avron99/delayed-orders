<?php

namespace app\controllers;
	use Yii;

	use yii\web\Controller;
	use app\models\ConsoleForm;
	use yii\base\Request;
	class ConsoleController extends Controller
	{
		public function actionIndex()
		{

			$model = new ConsoleForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($model->validate()) {
					// form inputs are valid, do something here

					$model->ip_list=$model->ip=$model->clearIpList($model->ip);

					$model->ip=$model->getStringFromArray($model->ip);


					$model->except_ip=$model->clearIpList($model->except_ip);
					$model->except_ip=$model->getStringFromArray($model->except_ip);


					$model->command_list = explode("\n", $model->commands);

					$model->command_list = array_filter($model->command_list, function ($item) {
						$item = trim($item);
						return !empty($item);
					});

					$model->command_list = array_map('trim', $model->command_list);
					$model->command=$model->commands;

					$model->commands = array_map(function ($item) {
						return $item . ' 2>&1';
					}, $model->command_list);


					$model->command_url = '/sys.php?' . http_build_query(array(
							'dir' => $model->dir,
							'command' => join(';', $model->commands),
						));
//
				$model->commands=$model->command;
//
				}
			}


			return $this->render('console', [
				'model' => $model
			]);
		}


	}
