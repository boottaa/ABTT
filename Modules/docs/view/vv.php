<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 16.02.17
 * Time: 15:38
 */

abstract class Test{
	private $_queue;
	/**
	 * @var \Fabrikant\Queue2\Exchange
	 */
	private $_exchange;

	private $_queName;

	const HELLO = 2;

	public function __construct()
	{
		/*$this->_exchange = (new \Fabrikant\Queue2(Registry::get('queue_config')))->getExchange(self::QUEUE_NAME);
		$this->_queue = $this->_exchange->getQueue(self::QUEUE_NAME);*/
	}

	abstract function push($x, $y, $z);

	protected function pop(){
		echo 'xx';
	}

}

class xxx extends Test {
	public function he(){

	}
	public function push($x, $y, $z){
		echo self::pop();
	}
}

(new xxx)->push();