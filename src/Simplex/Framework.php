<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6
 * Time: 14:43
 */

namespace Simplex;


use Symfony\Component\HttpKernel\HttpKernel;

class Framework extends HttpKernel {
	/*public function __construct($routes)
	{
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

		parent::__construct($dispatcher, $resolver);
	}*/
}