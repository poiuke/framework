<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/5
 * Time: 19:26
 */

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('hello',new Routing\Route('/hello/{name}',array(
	'name' => 'world',
	'_controller' => 'render_template',
)));
$routes->add('bye',new Routing\Route('/bye',array(
	'_controller' => function($request){
		return render_template($request);
	},
)));
$routes->add('leap_year',new Routing\Route('/is_leap_year/{year}',array(
	'year' => null,
	'_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));

return $routes;