<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/5
 * Time: 19:26
 */

use Symfony\Component\Routing;

function is_leap_year($year = null){
	if($year == null){
		$year = date('Y');
	}
	return 0 == $year%400 || (0 == $year%4 && 0 != $year%100) ;
}

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
	'_controller' => function($request){
		$year = $request->attributes->get('year');
		if(is_leap_year($year)){
			return new \Symfony\Component\HttpFoundation\Response($year.' is leap year');
		}
		return new \Symfony\Component\HttpFoundation\Response(' is not leap year');
	}
)));

return $routes;