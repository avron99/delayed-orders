<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ConsoleForm;
use GuzzleHttp\Client;

class ConsoleController extends Controller
{

	public function actionIndex()
	{

		$model = new ConsoleForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				// form inputs are valid, do something here

				$model->ip_list = $model->ip = $model->clearIpList($model->ip);
				$model->ip = $model->getStringFromArray($model->ip);

				$model->except_ip = $model->clearIpList($model->except_ip);
				$model->except_ip = $model->getStringFromArray($model->except_ip);


				$model->command_list = explode("\n", $model->commands);

				$model->command_list = array_filter($model->command_list, function ($item) {
					$item = trim($item);
					return !empty($item);
				});

				$model->command_list = array_map('trim', $model->command_list);
				$model->command = $model->commands;

				$model->commands = array_map(function ($item) {
					return $item . ' 2>&1';
				}, $model->command_list);


				$model->command_url = '/sys.php?' . http_build_query(array(
							'dir' => $model->dir,
							'command' => join(';', $model->commands),
				));
//
				$model->commands = $model->command;
//
			}
		}


		return $this->render('console', [
					'model' => $model
		]);
	}

	public function actionDelayed()
	{
		$delayed = new \app\models\DelayedOrders();
		$delayed->collection = $delayed->getOrders();

		return $this->render('delayed', ['delayed' => $delayed]);
	}

	public function actionRecalc()
	{
		$today = date("H:i:s");

		$model = new ConsoleForm();
		$model->login();
		$delayed = new \app\models\DelayedOrders();
		$model->mon_page = $model->auth();
		//var_dump($model->mon_page);
		//die();
		$model->parsed_page = $model->clearIpList($model->mon_page);
		$res = array_unique($model->parsed_page);
		//var_dump($res);



		foreach ($res as $key => $ip) {
			$url = "http://" . trim($ip) . "/info/order";

			$data = json_decode($model->GetData($url), true);

			$delayed->updateOrders(
					array('ip' => $ip), array('$set' =>
				array('last check' => $today,
					'total' => $data['total'],
					'exported' => $data['exported'],
					'delayed' => $data['delayed'])), array('upsert' => true)
			);
		}
	}
	//var_dump($model->parsed_page);
	//$parsed_page = $model->clearIpList($model->auth());
	//var_dump($model->parsed_page);
//		$client = new Client();
//		$headers = [
//			'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
//			'X-Requested-With' => 'XMLHttpRequest'
//		];
//
////$cookiePlugin = new FileCookieJar(cook);
////$client->addSubscriber($cookiePlugin);
//
//		$auth = $client->post('http://10.2.18.7/admin.php/', [
//			'form_params' => [
//				'signin[username]' => 'aborisov',
//				'signin[password]' => 'iowa4502'
//			],
//			'headers' => $headers,
//			
//		]);
//		$status = $auth->json()['code']['_name'];
//		var_dump($status);
}