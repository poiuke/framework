<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/11
 * Time: 17:19
 */

namespace Calendar\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\FlattenException;

class ErrorController {
	public function errorAction(FlattenException $exception)
	{
		$msg = "something went wrong! (".$exception->getMessage().')';

		return new Response($msg, $exception->getStatusCode());
	}
}