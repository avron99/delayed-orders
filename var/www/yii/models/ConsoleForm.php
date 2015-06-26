<?php


	namespace app\models;

	use Yii;
	use yii\base\Model;

	class ConsoleForm extends Model{

		/**
		 * IpAdd
		 */

		public $ip;
		public $except_ip;
		public $port = '80';
		public $dir ='../';
		public $url;
		public $command;
		public $ip_list;
		const IP_ADDR_MASK = '/10\.\d{1,3}\.\d{1,3}\.\d{1,3}/';
		public $ipl;
		public $command_list;
		public $command_url;
		public $commands;

		public function getAttribute($name)
		{
			return $this->$name;
		}

	public function	clearIpList($ip)
	{

		preg_match_all(self::IP_ADDR_MASK, $ip, $matches);
		$ip = $matches[0];

		return $ip ;
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

		function getStringFromArray($ipl) {
		return $ipl= implode("  ", $ipl);
		}

		public function rules()
	{
		return [
			// are both required
			[['ip','port','dir','commands'], 'required'],
			[['url'], 'string'],
			[['except_ip'], 'string']


		];

	}


	}