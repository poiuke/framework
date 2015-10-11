<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/3
 * Time: 22:42
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

/*function render_template($request){
	extract($request->attributes->all(),EXTR_SKIP);
	ob_start();
	//require sprintf(__DIR__.'/../src/pages/%s.php',$_route);
	require __DIR__.'/../src/pages/'.$_route.'.php';
	return new Response(ob_get_clean());
}*/

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes,$context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));
$listener = new HttpKernel\EventListener\ExceptionListener('Canlendar\\Controller\\ErrorController::errorAction');
$dispatcher->addSubscriber($listener);
$dispatcher->addSubscriber(new \Simplex\StringResponseListener());
$dispatcher->addSubscriber(new \Simplex\GoogleListener());
$dispatcher->addSubscriber(new \Simplex\ContentLengthListener());

$framework = new Simplex\Framework($dispatcher,$resolver);

$response = $framework->handle($request);

$response->send();

