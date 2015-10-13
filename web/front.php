<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/3
 * Time: 22:42
 */

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = include __DIR__.'/../src/app.php';
$sc = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

$response = $sc->get('framework')->handle($request);

$response->send();

