<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/7
 * Time: 12:41
 */

namespace Simplex;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseEvent extends Event{
	private $request;
	private $response;

	public function __construct(Request $request,Response $response){
		$this->request = $request;
		$this->response = $response;
	}

	public function getRequest(){
		return $this->request;
	}

	public function getResponse(){
		return $this->response;
	}
}