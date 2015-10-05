<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/3
 * Time: 22:42
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$response = new Response();

$map = array(
	'/hello' => 'hello',
	'/bye' => 'bye',
);

$path = $request->getPathInfo();
if(isset($map[$path])){
	ob_start();
	extract($request->query->all(),EXTR_SKIP);
	//require sprintf(__DIR__.'/../src/pages/%s.php',$map[$path]);
	require __DIR__.'/../src/pages/'.$map[$path].'.php';
	$response->setContent(ob_get_clean());
} else {
	$response->setStatusCode(404);
	$response->setContent('Not Found!');
}

$response->send();