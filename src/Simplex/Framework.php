<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6
 * Time: 14:43
 */

namespace Simplex;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class Framework {
	protected $matcher;
	protected $resolver;
	protected $dispatcher;

	public function __construct(UrlMatcherInterface $matcher,ControllerResolverInterface $resolver, EventDispatcher $dispatcher){
		$this->matcher = $matcher;
		$this->resolver = $resolver;
		$this->dispatcher = $dispatcher;
	}

	public function handle(Request $request){
		$this->matcher->getContext()->fromRequest($request);

		try{
			$request->attributes->add($this->matcher->match($request->getPathInfo()));

			$controller = $this->resolver->getController($request);
			$arguments = $this->resolver->getArguments($request,$controller);

			$response = call_user_func_array($controller,$arguments);

		}catch (ResourceNotFoundException $e) {
			$response = new Response('Not Found',404);

		}catch (\Exception $e) {
			$response = new Response('An error occurred '.$e->getMessage(),500);

		}
		$this->dispatcher->dispatch('response',new ResponseEvent($request,$response));

		return $response;
	}
}