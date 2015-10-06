<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6
 * Time: 14:43
 */

namespace Simplex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Framework {
	protected $matcher;
	protected $resolver;

	public function __construct(UrlMatcher $matcher,ControllerResolver $resolver){
		$this->matcher = $matcher;
		$this->resolver = $resolver;
	}

	public function handle(Request $request){
		$this->matcher->getContext()->fromRequest($request);

		try{
			$request->attributes->add($this->matcher->match($request->getPathInfo()));

			$controller = $this->resolver->getController($request);
			$arguments = $this->resolver->getArguments($request,$controller);

			$response = call_user_func_array($controller,$arguments);
			return $response;

		}catch (ResourceNotFoundException $e) {
			$response = new Response('Not Found',404);
			return $response;

		}catch (\Exception $e) {
			$response = new Response('An error occurred '.$e->getMessage(),500);
			return $response;
		}
	}
}