<?php

namespace app\models;

use Yii;
use yii\base\Model;
use linslin\yii2\curl;

class ConsoleForm extends Model
{
	/**
	 * IpAdd
	 */
	public $ip;
	public $big;
	public $part;
	public $except_ip;
	public $port = '80';
	public $dir = '../';
	public $url;
	public $command;
	public $ip_list;
	public $mon_page;
	public $parsed_page;

	const IP_ADDR_MASK = '/10\.\d{1,3}\.\d{1,3}\.\d{1,3}/';

	public $ipl;
	public $command_list;
	public $command_url;
	public $commands;

	public function getAttribute($name)
	{
		return $this->$name;
	}

	public function clearIpList($ip)
	{

		preg_match_all(self::IP_ADDR_MASK, $ip, $matches);
		$ip = $matches[0];

		return $ip;
	}

//		function getStringFromArray() {
//			$ip_list = array();
//
//			foreach ($this->ip_list as $ip)
//				{$ip_list[] = $ip;}
//
//			$this->ip_list = implode(', ', $ip_list);
//
//			return $this->ip_list;
//		}

	function getStringFromArray($ipl)
	{
		return $ipl = implode("  ", $ipl);
	}

	public function rules()
	{
		return [
			// are both required
			[['ip', 'port', 'dir', 'commands'], 'required'],
			[['url'], 'string'],
			[['except_ip'], 'string']
		];
	}

	public function login()
	{
		$ch = curl_init();
		$url = 'http://10.2.18.7/admin.php/kiosk';
		curl_setopt($ch, CURLOPT_URL, $url); // отправляем на
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // таймаут4
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // просто отключаем проверку сертификата
		curl_setopt($ch, CURLOPT_POST, 1); // использовать данные в post
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			'signin[username]' => 'aborisov',
			'signin[password]' => 'iowa4502'
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); // сохранять куки в файл
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
		curl_exec($ch);
		curl_close($ch);
	}

	public function auth()
	{
		$ch = curl_init();
		$url = 'http://10.2.18.7/admin.php/kiosk';
		curl_setopt($ch, CURLOPT_URL, $url); // отправляем на
//		curl_setopt($ch, CURLOPT_HEADER, 0);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
		$data = curl_exec($ch);
		curl_close($ch);
		if ($data !== NULL) {
			return $data;
		}
	}

	public function GetData($url)
	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		$data = curl_exec($ch);
		curl_close($ch);
		if ($data !== NULL) {
			return $data;
		}
	}
	}
	